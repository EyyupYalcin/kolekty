<?php

function get_egitim_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM egitim
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_egitim_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM egitim WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_egitim($egitim){
    GLOBAL $db;
    $kolonlar = array_keys($egitim);
    $sorgu_dizgesi = "INSERT INTO egitim (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($egitim));
    return $sonuc; // bool
}

function get_egitim_By_id($id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM egitim WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}


function update_egitim($egitim){
    GLOBAL $db;
    $sorgu_dizgesi = "UPDATE egitim SET ";
    $kolonlar = array_keys($egitim);
    foreach($kolonlar as $kolon){
        if($kolon != 'id'){
            $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ? ": $kolon . " = ? , ";
        }
    }
    $sorgu_dizgesi .= " WHERE id = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $degerler = array();
    foreach(array_values($egitim) as $deger){
        if($deger != $egitim['id']){
            array_push($degerler, $deger);
        }
    }
    array_push($degerler, $egitim['id']);
    $sonuc = $sorgu->execute($degerler);
    return $sonuc;
}

function delete_egitim($egitim_id){
    GLOBAL $db;
    $sorgu_dizgesi = "DELETE FROM egitim WHERE id = ? ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute([$egitim_id]);
    return $sonuc;
}