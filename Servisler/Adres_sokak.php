<?php

function get_Adres_sokak_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Adres_sokak
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_Adres_sokak_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Adres_sokak WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_Adres_sokak($Adres_sokak){
    GLOBAL $db;
    $kolonlar = array_keys($Adres_sokak);
    $sorgu_dizgesi = "INSERT INTO Adres_sokak (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($Adres_sokak));
    return $sonuc; // bool
}

function get_Adres_sokak_By_sokak_id($sokak_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Adres_sokak WHERE sokak_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$sokak_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}