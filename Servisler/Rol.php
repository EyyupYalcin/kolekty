<?php

function get_rol_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM rol
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_rol_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM rol WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_rol($rol){
    GLOBAL $db;
    $kolonlar = array_keys($rol);
    $sorgu_dizgesi = "INSERT INTO rol (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($rol));
    return $sonuc; // bool
}

function get_rol_By_id($id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM rol WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}