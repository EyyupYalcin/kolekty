<?php

function get_yorumlar_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM yorumlar
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_yorumlar_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM 
            yorumlar
        WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_yorumlar($yorumlar){
    GLOBAL $db;
    $kolonlar = array_keys($yorumlar);
    $sorgu_dizgesi = "INSERT INTO yorumlar (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($yorumlar));
    return $sonuc; // bool
}

function get_yorumlar_By_id($id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM yorumlar WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}


function get_yorumlar_By_hizmet_saglayici_id($hizmet_saglayici_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT 
            kullanici.*,
            hizmet_saglayicilar.*,
            yorumlar.*
        FROM 
            yorumlar 
        JOIN hizmet_saglayicilar ON 
            yorumlar.hizmet_saglayici_id = hizmet_saglayicilar.id 
        JOIN kullanici ON 
            yorumlar.kullanici_id = kullanici.id 
        WHERE yorumlar.hizmet_saglayici_id = ?
        ORDER BY yorumlar.olusturma_zamani DESC
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$hizmet_saglayici_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}