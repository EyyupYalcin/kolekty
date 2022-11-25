<?php

function get_adres_ilce_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM adres_ilce
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_adres_ilce_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM adres_ilce WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_adres_ilce($adres_ilce){
    GLOBAL $db;
    $kolonlar = array_keys($adres_ilce);
    $sorgu_dizgesi = "INSERT INTO adres_ilce (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($adres_ilce));
    return $sonuc; // bool
}

function get_adres_ilce_By_ilce_id($ilce_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM adres_ilce WHERE ilce_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$ilce_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}