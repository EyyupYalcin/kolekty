<?php

function get_Adres_mahalle_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Adres_mahalle
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_Adres_mahalle_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Adres_mahalle WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_Adres_mahalle($Adres_mahalle){
    GLOBAL $db;
    $kolonlar = array_keys($Adres_mahalle);
    $sorgu_dizgesi = "INSERT INTO Adres_mahalle (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($Adres_mahalle));
    return $sonuc; // bool
}

function get_Adres_mahalle_By_mahalle_id($mahalle_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Adres_mahalle WHERE mahalle_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$mahalle_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}