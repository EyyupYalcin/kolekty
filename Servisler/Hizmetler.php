<?php

function get_Hizmetler_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Hizmetler
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_Hizmetler_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Hizmetler WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_Hizmetler($Hizmetler){
    GLOBAL $db;
    $kolonlar = array_keys($Hizmetler);
    $sorgu_dizgesi = "INSERT INTO Hizmetler (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($Hizmetler));
    return $sonuc; // bool
}

function update_Hizmetler($Hizmetler){
    GLOBAL $db;
    $sorgu_dizgesi = "UPDATE Hizmetler SET ";
    $kolonlar = array_keys($Hizmetler);
    foreach($kolonlar as $kolon){
        if($kolon != 'id'){
            $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ? ": $kolon . " = ? , ";
        }
    }
    $sorgu_dizgesi .= " WHERE id = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $degerler = array();
    foreach(array_values($Hizmetler) as $deger){
        if($deger != $Hizmetler['id']){
            array_push($degerler, $deger);
        }
    }
    array_push($degerler, $Hizmetler['id']);
    $sonuc = $sorgu->execute($degerler);
    return $sonuc;
}