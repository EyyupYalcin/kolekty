<?php

function get_portfolyo_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM portfolyo
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_portfolyo_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM portfolyo WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_portfolyo($portfolyo){
    GLOBAL $db;
    $kolonlar = array_keys($portfolyo);
    $sorgu_dizgesi = "INSERT INTO portfolyo (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($portfolyo));
    return $sonuc; // bool
}

function get_portfolyo_By_id($id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM portfolyo WHERE id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function update_portfolyo($portfolyo){
    GLOBAL $db;
    $sorgu_dizgesi = "UPDATE portfolyo SET ";
    $kolonlar = array_keys($portfolyo);
    foreach($kolonlar as $kolon){
        if($kolon != 'id'){
            $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ? ": $kolon . " = ? , ";
        }
    }
    $sorgu_dizgesi .= " WHERE id = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $degerler = array();
    foreach(array_values($portfolyo) as $deger){
        if($deger != $portfolyo['id']){
            array_push($degerler, $deger);
        }
    }
    array_push($degerler, $portfolyo['id']);
    $sonuc = $sorgu->execute($degerler);
    return $sonuc;
}

function delete_portfolyo($portfolyo_id){
    GLOBAL $db;
    $sorgu_dizgesi = "DELETE FROM portfolyo WHERE id = ? ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute([$portfolyo_id]);
    return $sonuc;
}