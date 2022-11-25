<?php
function okunmamisMesajSayisi($kullanici_id){
    oturumGerekli();
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT 
            count(*) as sayi
        FROM mesaj
        WHERE alici_id = ? AND mesaj.okunma_zamani IS NULL";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$kullanici_id]);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
    return $sonuc['sayi'];
}

function MesajGonder($gonderici_id, $alici_id, $mesaj){
    oturumGerekli();
    global $db;
    $sorgu_dizgesi = "
        INSERT INTO mesaj
            (metin, gonderici_id, alici_id) 
        VALUES 
            (?, ?, ?);
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(
        array(
            $mesaj,
            $gonderici_id,
            $alici_id
        )
    );
    $mesaj_id = $db->lastInsertId();

    return getMesajById($mesaj_id);
}

function TeklifGonder($gonderici_id, $alici_id, $teklif_metni, $teklif_tutari, $hizmet_id){
    oturumGerekli();
    global $db;
    
    include 'Teklif.php';
    $teklif = insert_teklif($hizmet_id,$teklif_metni,$teklif_tutari);
    
    $sorgu_dizgesi = "
        INSERT INTO mesaj
            (metin, gonderici_id, alici_id) 
        VALUES 
            (?, ?, ?);
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(
        array(
            strval($teklif['id']),
            $gonderici_id,
            $alici_id
        )
    );
    $mesaj_id = $db->lastInsertId();
    
    $sorgu_dizgesi = "
        INSERT INTO mesaj_ek
            (mesaj_id, ek_turu_id) 
        VALUES 
            (?, ?);
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(
        array(
            $mesaj_id,
            1 // Teklif
        )
    );

    return getMesajById($mesaj_id);
}

function RandevuGonder($gonderici_id, $alici_id, $zaman, $konu, $aciklama){
    oturumGerekli();
    global $db;
    
    include 'Randevu.php';

    $randevu = insert_randevu([
        "kullanici_1" => $gonderici_id,
        "kullanici_2" => $alici_id,
        "randevu_zamani" =>  $zaman,
        "konu" => $konu,
        "aciklama" => $aciklama
    ]);
    $randevu_id = $db->lastInsertId();

    $sorgu_dizgesi = "
        INSERT INTO mesaj
            (metin, gonderici_id, alici_id) 
        VALUES 
            (?, ?, ?);
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(
        array(
            strval($randevu_id),
            $gonderici_id,
            $alici_id
        )
    );
    $mesaj_id = $db->lastInsertId();
    
    $sorgu_dizgesi = "
        INSERT INTO mesaj_ek
            (mesaj_id, ek_turu_id) 
        VALUES 
            (?, ?);
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(
        array(
            $mesaj_id,
            2 // Teklif
        )
    );

    $tarih_str = date("d.m.Y H:i", strtotime($zaman));

    $randevu_link = "https://".$_SERVER[HTTP_HOST]."/Randevu/" . $randevu_id; 

    $alici_mesaj = [
        "subject" => "Yeni bir randevu aldınız",
        "body" => "<h3>Yeni bir randevu aldınız.</h3>
        Randevu saati: " . $tarih_str . "<br>
        Randevu konusu: " . $konu . "<br>
        Randevu açıklaması: " . $aciklama . "<br>
        Randevu sahibi: " . getKullaniciByID($gonderici_id)['isim'] . " " . getKullaniciByID($gonderici_id)['soyisim'] . "
        <br><br>
        Randevuyu görüntülemek için <a href='" . $randevu_link . "'>Randevu Bağlantısı</a>",
        "alt_body" => "Yeni bir randevu aldınız.\n
        Randevu saati: " . $tarih_str . "\n
        Randevu konusu: " . $konu . "\n
        Randevu açıklaması: " . $aciklama . "\n
        Randevu sahibi: " . getKullaniciByID($gonderici_id)['isim'] . " " . getKullaniciByID($gonderici_id)['soyisim'] . "
        \n\n
        Randevu Bağlantısı: " . $randevu_link,
    ];

    $gonderici_mesaj = [
        "subject" => "Randevu talebiniz gönderildi",
        "body" => "<h3>Randevu talebiniz gönderildi.</h3>
        Randevu saati: " . $tarih_str . "<br>
        Randevu konusu: " . $konu . "<br>
        Randevu açıklaması: " . $aciklama . "<br>
        Randevu sahibi: " . getKullaniciByID($alici_id)['isim'] . " " . getKullaniciByID($alici_id)['soyisim'] . "
        <br><br>
        Randevuyu görüntülemek için <a href='" . $randevu_link . "'>Randevu Bağlantısı</a>",
        "alt_body" => "Randevu talebiniz gönderildi.\n
        Randevu saati: " . $tarih_str . "\n
        Randevu konusu: " . $konu . "\n
        Randevu açıklaması: " . $aciklama . "\n
        Randevu sahibi: " . getKullaniciByID($alici_id)['isim'] . " " . getKullaniciByID($alici_id)['soyisim'] . "
        \n\n
        Randevu Bağlantısı: " . $randevu_link,
    ];

    $gonderici_mail = getKullaniciByID($gonderici_id)['email'];
    $alici_mail = getKullaniciByID($alici_id)['email'];

    mail_gonder($gonderici_mail, $gonderici_mesaj);
    mail_gonder($alici_mail, $alici_mesaj);

    return getMesajById($mesaj_id);
}


function getMesajById($mesajID){
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
        ek_turu.tablo_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
    Where mesaj.id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$mesajID]);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
    return $sonuc;
}

function getKisiler($kullanici_id){
    GLOBAL $db;
    // $sorgu_dizgesi = "
    // SELECT 
    //     DISTINCT kullanici.id,
    //     kullanici.isim as isim,
    //     kullanici.soyisim as soyisim,
    //     kullanici.profil_resmi as profil_resmi,
    //     (SELECT Count(m.id) FROM mesaj as m WHERE (m.gonderici_id = kullanici.id OR m.alici_id = kullanici.id) AND m.okunma_zamani IS NULL) as okunmamis_mesaj_sayisi
    // FROM kullanici 
    //     RIGHT JOIN mesaj
    //         ON mesaj.gonderici_id = kullanici.id OR mesaj.alici_id = kullanici.id
    // Where (mesaj.alici_id = ? OR mesaj.gonderici_id = ?) AND kullanici.id != ?
    // ";
    $sql_degiskenleri_sorgu="SET @ben = ?;";
    $sql_degiskenleri_sorgu = $db->prepare($sql_degiskenleri_sorgu);
    $sql_degiskenleri_sorgu->execute([$kullanici_id]);
    $sorgu_dizgesi = "
    SELECT 
        DISTINCT kullanici.id,
        kullanici.isim as isim,
        kullanici.soyisim as soyisim,
        kullanici.profil_resmi as profil_resmi,
        (SELECT Count(m.id) FROM mesaj as m WHERE (m.gonderici_id = kullanici.id AND m.alici_id = @ben) AND m.okunma_zamani IS NULL) as okunmamis_mesaj_sayisi
    FROM kullanici 
        RIGHT JOIN mesaj
            ON mesaj.gonderici_id = kullanici.id OR mesaj.alici_id = kullanici.id
    Where (mesaj.alici_id = @ben OR mesaj.gonderici_id = @ben) AND kullanici.id != @ben;
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuc;
}

function getSohbet($kullanici_id, $mesajlasilan_kullanici_id){
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
        ek_turu.tablo_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
    Where (mesaj.alici_id = ? AND mesaj.gonderici_id = ?) OR (mesaj.alici_id = ? AND mesaj.gonderici_id = ?)
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$kullanici_id, $mesajlasilan_kullanici_id, $mesajlasilan_kullanici_id, $kullanici_id]);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuc;
}

function getMesajByAliciID($aliciID){
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
        ek_turu.tablo_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
    Where mesaj.alici_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$aliciID]);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuc;
}

function getYeniMesajByAliciID($aliciID){
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
        ek_turu.tablo_adi
    FROM `mesaj` 
        LEFT JOIN kullanici AS gonderici 
            ON mesaj.gonderici_id = gonderici.id
        LEFT JOIN kullanici AS alici 
            ON mesaj.alici_id = alici.id
        LEFT JOIN mesaj_ek AS ek 
            ON mesaj.id = ek.mesaj_id
        LEFT JOIN mesaj_ek_turu AS ek_turu 
            ON ek.ek_turu_id = ek_turu.id
    Where mesaj.alici_id = ? AND mesaj.iletilme_zamani IS NULL
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$aliciID]);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuc;
}

function MesajGoruldu($mesajID){
    GLOBAL $db;
    $sorgu_dizgesi = "
        UPDATE mesaj SET
            okunma_zamani = NOW()
        WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute([$mesajID]);
    return $sonuc;
}

function MesajIletildi($mesajID){
    GLOBAL $db;
    $sorgu_dizgesi = "
        UPDATE mesaj SET
            iletilme_zamani = NOW()
        WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute([$mesajID]);
    return $sonuc;
}

function gorulmemisBildirimSayisi($kullanici_id){
    oturumGerekli();
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT 
            count(*) as sayi
        FROM bildirim
        WHERE kullanici = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$kullanici_id]);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
    return $sonuc['sayi'];
}
