<?php

function get_hizmet_saglayicilar_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT kullanici.*, hizmet_saglayicilar.* FROM hizmet_saglayicilar JOIN kullanici ON kullanici_id = kullanici.id
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

// function get_hizmet_saglayicilar_where($raw_where){
//     GLOBAL $db;
//     $sorgu_dizgesi = "
//         SELECT kullanici.*, hizmet_saglayicilar.* FROM hizmet_saglayicilar JOIN kullanici ON kullanici_id = kullanici.id WHERE
//     " . $raw_where;
//     $sorgu = $db->prepare($sorgu_dizgesi);
//     $sorgu->execute();
//     $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
//     return $sonuclar;
// }

function get_hizmet_saglayicilar_where($raw_where){
    GLOBAL $db;
    // onaylayan kullanici as onaylayan_kullanici
    $sorgu_dizgesi = "
        SELECT 
            kullanici.*,
            hizmet_saglayicilar.*,
            onaylayan_kullanici.id as onaylayan_kullanici_id,
            onaylayan_kullanici.isim as onaylayan_kullanici_isim,
            onaylayan_kullanici.soyisim as onaylayan_kullanici_soyisim
        FROM 
            hizmet_saglayicilar 
        JOIN kullanici ON kullanici_id = kullanici.id
        LEFT JOIN kullanici AS onaylayan_kullanici ON hizmet_saglayicilar.onaylayan_kullanici = onaylayan_kullanici.id
        
        WHERE 
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_hizmet_saglayicilar($hizmet_saglayicilar){
    GLOBAL $db;
    $kolonlar = array_keys($hizmet_saglayicilar);
    $sorgu_dizgesi = "INSERT INTO hizmet_saglayicilar (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($hizmet_saglayicilar));
    return $sonuc; // bool
}

function update_hizmet_saglayici($hizmet_saglayici){
    GLOBAL $db;
    $sorgu_dizgesi = "UPDATE hizmet_saglayicilar SET ";
    $kolonlar = array_keys($hizmet_saglayici);
    foreach($kolonlar as $kolon){
        if($kolon != 'id'){
            $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ? ": $kolon . " = ? , ";
        }
    }
    $sorgu_dizgesi .= " WHERE id = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $degerler = array();
    foreach(array_values($hizmet_saglayici) as $deger){
        if($deger != $hizmet_saglayici['id']){
            array_push($degerler, $deger);
        }
    }
    array_push($degerler, $hizmet_saglayici['id']);
    $sonuc = $sorgu->execute($degerler);
    return $sonuc;
}

function get_hizmet_saglayicilar_By_uzmanliklar($uzmanliklar, $onayli_mi){
    GLOBAL $db;
    $sorgu_dizgesi = "
    SELECT 
        kullanici.*,
        GROUP_CONCAT(uzmanlik_alani.adi) as uzmanlik_alanlari,
        hizmet_saglayicilar.* 
    FROM 
        hizmet_saglayicilar 
        JOIN kullanici ON kullanici_id = kullanici.id
        LEFT JOIN uzmanlik_alani ON hizmet_saglayicilar.id = uzmanlik_alani.hizmet_saglayici_id
    ";

    if($onayli_mi){
        $sorgu_dizgesi .= "
        WHERE hizmet_saglayicilar.onaylayan_kullanici != 0
        ";
    }
    $sorgu_dizgesi .= "        
    GROUP BY hizmet_saglayicilar.id Having 
    ";
    foreach ($uzmanliklar as $index => $uzmanlik) {
        if($index != (count($uzmanliklar) - 1)){
            $sorgu_dizgesi .= " FIND_IN_SET(? ,uzmanlik_alanlari) > 0 AND ";
        }else{
            $sorgu_dizgesi .= " FIND_IN_SET(? ,uzmanlik_alanlari) > 0";
        }
    }
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute($uzmanliklar);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}