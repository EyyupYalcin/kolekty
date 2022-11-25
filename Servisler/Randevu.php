<?php 

function get_randevu_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM randevu
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_randevu($randevu){
    GLOBAL $db;
    $kolonlar = array_keys($randevu);
    $sorgu_dizgesi = "INSERT INTO randevu (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($randevu));
    return $sonuc;
}

function get_randevu_By_ID($randevu_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM randevu WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$randevu_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_randevu_By_Musteri_ID($musteri_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM randevu WHERE kullanici_2 = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$musteri_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_randevu_By_Hizmet_Saglayici_ID($hizmet_saglayici_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM randevu WHERE kullanici_1 = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$hizmet_saglayici_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_randevu_where($kosul){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM randevu WHERE $kosul
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_randevu_mesaj($mesaj_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
    SELECT 
        mesaj.id, 
        mesaj.metin,
        mesaj.gonderici_id,
        mesaj.alici_id,
        mesaj.iletilme_zamani,
        mesaj.okunma_zamani,
        mesaj.olusturma_zamani,
        gonderici.isim as gonderici_isim,
        gonderici.soyisim as gonderici_soyisim,
        gonderici.profil_resmi as gonderici_profil_resmi,
        alici.isim as alici_isim,
        alici.soyisim as alici_soyisim,
        alici.profil_resmi as alici_profil_resmi,
        ek_turu.ek_turu_adi,
        ek_turu.tablo_adi,
        randevu.id as randevu_id,
        randevu.konu,
        randevu.aciklama,
        randevu.randevu_zamani
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
        LEFT JOIN randevu 
            ON CAST(mesaj.metin AS SIGNED) =  randevu.id
    Where mesaj.id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$mesaj_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar[0];
}