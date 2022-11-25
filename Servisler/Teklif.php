<?php

function get_teklif_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM teklif
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_teklif_mesaj($mesaj_id){
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
        teklif.id as teklif_id,
        teklif.teklif_metni,
        teklif.teklif_tutari,
        teklif.hizmet_id,
        teklif.durum as teklif_durumu,
        hizmet_saglayicilar.adi as hizmet_adi,
        hizmet_saglayicilar.kapak_fotografi as hizmet_kapak_fotografi,
        hizmetler.hizmet_adi as hizmet_kategori_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
        LEFT JOIN teklif 
            ON CAST(mesaj.metin AS SIGNED) =  teklif.id
        LEFT JOIN hizmet_saglayicilar
            ON teklif.hizmet_id = hizmet_saglayicilar.id
        LEFT JOIN hizmetler
        	ON hizmet_saglayicilar.hizmet_id = hizmetler.id
    Where mesaj.id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$mesaj_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar[0];
}

function get_teklif_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM teklif WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_teklif_mesaj_by_teklif_id($teklif_id){
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
        teklif.id as teklif_id,
        teklif.teklif_metni,
        teklif.teklif_tutari,
        teklif.hizmet_id,
        teklif.durum as teklif_durumu,
        teklif.observer_id,
        hizmet_saglayicilar.adi as hizmet_adi,
        hizmet_saglayicilar.kapak_fotografi as hizmet_kapak_fotografi,
        hizmetler.hizmet_adi as hizmet_kategori_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
        LEFT JOIN teklif 
            ON CAST(mesaj.metin AS SIGNED) =  teklif.id
        LEFT JOIN hizmet_saglayicilar
            ON teklif.hizmet_id = hizmet_saglayicilar.id
        LEFT JOIN hizmetler
        	ON hizmet_saglayicilar.hizmet_id = hizmetler.id
    Where teklif.id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$teklif_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar[0];
}

function TeklifObserved($teklif_list){
    GLOBAL $db;
    foreach ($teklif_list as $teklif) {
        $sorgu_dizgesi = "
            UPDATE teklif SET
                observer_id = 0
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$teklif['teklif_id']]);
    }
    return 1;
}

function TeklifObserver($kullanici_id){
    GLOBAL $db;
    $sql_degiskenleri_sorgu="SET @ben = ?;";
    $sql_degiskenleri_sorgu = $db->prepare($sql_degiskenleri_sorgu);
    $sql_degiskenleri_sorgu->execute([$kullanici_id]);
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
        teklif.id as teklif_id,
        teklif.teklif_metni,
        teklif.teklif_tutari,
        teklif.hizmet_id,
        teklif.durum as teklif_durumu,
        teklif.observer_id,
        hizmet_saglayicilar.adi as hizmet_adi,
        hizmet_saglayicilar.kapak_fotografi as hizmet_kapak_fotografi,
        hizmetler.hizmet_adi as hizmet_kategori_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
        LEFT JOIN teklif 
            ON CAST(mesaj.metin AS SIGNED) =  teklif.id
        LEFT JOIN hizmet_saglayicilar
            ON teklif.hizmet_id = hizmet_saglayicilar.id
        LEFT JOIN hizmetler
        	ON hizmet_saglayicilar.hizmet_id = hizmetler.id
    Where teklif.observer_id = @ben
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    TeklifObserved($sonuclar);
    return $sonuclar;
}

function insert_teklif($hizmet_id, $teklif_metni, $teklif_tutari){
    GLOBAL $db;
    $sorgu_dizgesi = "
        INSERT INTO teklif
            (hizmet_id, teklif_metni, teklif_tutari) 
        VALUES 
            (?, ?, ?);
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(
        array(
            $hizmet_id,
            $teklif_metni,
            $teklif_tutari
        )
    );
    $teklif_id = $db->lastInsertId();
    return get_teklif_where(" id = " . $teklif_id)[0];
}

function TeklifIptal($teklif_id){
    GLOBAL $db;
    $teklif = get_teklif_mesaj_by_teklif_id($teklif_id);
    if($teklif['teklif_durumu'] == 1){
        $sorgu_dizgesi = "
            UPDATE teklif SET
                durum = 4,
                observer_id = ?
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$teklif['alici_id'], $teklif_id]);
        return $sonuc;
    }
    return 0;
}

function TeklifRed($teklif_id){
    GLOBAL $db;
    $teklif = get_teklif_mesaj_by_teklif_id($teklif_id);
    if($teklif['teklif_durumu'] == 1){
        $sorgu_dizgesi = "
            UPDATE teklif SET
                durum = 3,
                observer_id = ?
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$teklif['gonderici_id'], $teklif_id]);
        return $sonuc;
    }
    return 0;
}

function TeklifKabul($teklif_id){
    GLOBAL $db;
    $teklif = get_teklif_mesaj_by_teklif_id($teklif_id);
    if($teklif['teklif_durumu'] == 1){
        $sorgu_dizgesi = "
            UPDATE teklif SET
                durum = 2,
                observer_id = ?
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$teklif['gonderici_id'], $teklif_id]);
        return $sonuc;
    }
    return 0;
}