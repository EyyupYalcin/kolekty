<?php

function get_uzmanlik_alani_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM uzmanlik_alani
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_uzmanlik_alani_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM uzmanlik_alani WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_uzmanlik_alani($uzmanlik_alani){
    GLOBAL $db;
    $kolonlar = array_keys($uzmanlik_alani);
    $sorgu_dizgesi = "INSERT INTO uzmanlik_alani (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($uzmanlik_alani));
    return $sonuc; // bool
}

function get_uzmanlik_alani_By_id($id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM uzmanlik_alani WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function delete_uzmanlik_alani($uzmanlik_id){
    GLOBAL $db;
    $sorgu_dizgesi = "DELETE FROM uzmanlik_alani WHERE id = ? ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute([$uzmanlik_id]);
    return $sonuc;
}

function get_uzmanlik_alani_By_hizmet_id($hizmet_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT 
            uzmanlik_alani.*
        FROM 
            uzmanlik_alani 
        JOIN hizmet_saglayicilar ON 
            uzmanlik_alani.hizmet_saglayici_id = hizmet_saglayicilar.id 
        WHERE hizmet_saglayicilar.hizmet_id = ?
        GROUP BY uzmanlik_alani.adi
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$hizmet_id]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}