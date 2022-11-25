<?php

function get_adres_sehir_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM adres_sehir
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_adres_sehir_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM adres_sehir WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_adres_sehir($adres_sehir){
    GLOBAL $db;
    $kolonlar = array_keys($adres_sehir);
    $sorgu_dizgesi = "INSERT INTO adres_sehir (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($adres_sehir));
    return $sonuc; // bool
}

function get_adres_sehir_By_il_id($il_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM adres_sehir WHERE il_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$il_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}