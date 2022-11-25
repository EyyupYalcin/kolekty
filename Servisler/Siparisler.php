<?php

function get_siparisler_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM siparisler
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_siparisler_By_Hizmet_ID($hizmet_saglayici_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM siparisler WHERE hizmet_saglayici_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$hizmet_saglayici_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_musteri_siparisleri($musteri_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM siparisler WHERE musteri_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$musteri_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_hizmet_siparisleri($hizmet_saglayici_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM siparisler WHERE hizmet_saglayici_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$hizmet_saglayici_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_siparis($siparis){
    GLOBAL $db;
    $kolonlar = array_keys($siparis);
    $sorgu_dizgesi = "INSERT INTO siparisler (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($siparis));
    return $sonuc; // bool
}

function get_musteri_aktif_siparisleri($musteri_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT
            siparisler.*,
            musteri.id AS musteri_id,
            musteri.isim AS musteri_isim,
            musteri.soyisim AS musteri_soyisim,
            musteri.telefon AS musteri_telefon,
            musteri.email AS musteri_email,
  
            hizmet_saglayici.id AS hizmet_saglayici_id,
            hizmet_saglayici.isim AS hizmet_saglayici_isim,
            hizmet_saglayici.soyisim AS hizmet_saglayici_soyisim,
            hizmet_saglayici.telefon AS hizmet_saglayici_telefon,
            hizmet_saglayici.email AS hizmet_saglayici_email,
            
            hizmet.id AS hizmet_id,
            hizmet.adi AS hizmet_adi,
            hizmet.saatlik_ucret AS hizmet_fiyat,
            hizmet.tanitim AS hizmet_tanitim,
            hizmet.hizmet_id as hizmet_turu_id,

            hizmet.kapak_fotografi AS hizmet_kapak_fotografi,
            hizmet_turu.hizmet_adi AS hizmet_turu_adi
        FROM siparisler
            JOIN kullanici as musteri 
                ON siparisler.musteri_id = musteri.id
            JOIN hizmet_saglayicilar as hizmet 
                ON hizmet_saglayici_id = hizmet.id
            JOIN kullanici as hizmet_saglayici 
                ON hizmet.kullanici_id = hizmet_saglayici.id
            JOIN hizmetler as hizmet_turu
                ON hizmet.hizmet_id = hizmet_turu.id
        WHERE 
            musteri_id = ? AND
            teslim_tarihi > NOW() 
            ORDER BY teslim_tarihi ASC
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$musteri_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_musteri_tum_siparisleri($musteri_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT
            siparisler.*,
            musteri.id AS musteri_id,
            musteri.isim AS musteri_isim,
            musteri.soyisim AS musteri_soyisim,
            musteri.telefon AS musteri_telefon,
            musteri.email AS musteri_email,
  
            hizmet_saglayici.id AS hizmet_saglayici_id,
            hizmet_saglayici.isim AS hizmet_saglayici_isim,
            hizmet_saglayici.soyisim AS hizmet_saglayici_soyisim,
            hizmet_saglayici.telefon AS hizmet_saglayici_telefon,
            hizmet_saglayici.email AS hizmet_saglayici_email,
            
            hizmet.id AS hizmet_id,
            hizmet.adi AS hizmet_adi,
            hizmet.saatlik_ucret AS hizmet_fiyat,
            hizmet.tanitim AS hizmet_tanitim,
            hizmet.hizmet_id as hizmet_turu_id,

            hizmet.kapak_fotografi AS hizmet_kapak_fotografi,
            hizmet_turu.hizmet_adi AS hizmet_turu_adi
        FROM siparisler
            JOIN kullanici as musteri 
                ON siparisler.musteri_id = musteri.id
            JOIN hizmet_saglayicilar as hizmet 
                ON hizmet_saglayici_id = hizmet.id
            JOIN kullanici as hizmet_saglayici 
                ON hizmet.kullanici_id = hizmet_saglayici.id
            JOIN hizmetler as hizmet_turu
                ON hizmet.hizmet_id = hizmet_turu.id
        WHERE 
            musteri_id = ? AND
            teslim_tarihi < NOW() 
            ORDER BY teslim_tarihi ASC
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$musteri_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_hizmet_saglayici_aktif_siparisleri($kullanici_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT
            siparisler.*,
            musteri.id AS musteri_id,
            musteri.isim AS musteri_isim,
            musteri.soyisim AS musteri_soyisim,
            musteri.telefon AS musteri_telefon,
            musteri.email AS musteri_email,
  
            hizmet_saglayici.id AS hizmet_saglayici_id,
            hizmet_saglayici.isim AS hizmet_saglayici_isim,
            hizmet_saglayici.soyisim AS hizmet_saglayici_soyisim,
            hizmet_saglayici.telefon AS hizmet_saglayici_telefon,
            hizmet_saglayici.email AS hizmet_saglayici_email,
            
            hizmet.id AS hizmet_id,
            hizmet.adi AS hizmet_adi,
            hizmet.saatlik_ucret AS hizmet_fiyat,
            hizmet.tanitim AS hizmet_tanitim,
            hizmet.hizmet_id as hizmet_turu_id,

            hizmet.kapak_fotografi AS hizmet_kapak_fotografi,
            hizmet_turu.hizmet_adi AS hizmet_turu_adi
        FROM siparisler
            JOIN kullanici as musteri 
                ON siparisler.musteri_id = musteri.id
            JOIN hizmet_saglayicilar as hizmet 
                ON hizmet_saglayici_id = hizmet.id
            JOIN kullanici as hizmet_saglayici 
                ON hizmet.kullanici_id = hizmet_saglayici.id
            JOIN hizmetler as hizmet_turu
                ON hizmet.hizmet_id = hizmet_turu.id
        WHERE 
            hizmet_saglayici_id = ? AND
            teslim_tarihi > NOW() 
            ORDER BY teslim_tarihi ASC
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$kullanici_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}