<?php

function get_hizmet_talebi_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT kullanici.*, hizmet_talebi.* FROM hizmet_talebi JOIN kullanici ON musteri_id = kullanici.id
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_hizmet_talebi_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT kullanici.*, hizmet_talebi.* FROM hizmet_talebi JOIN kullanici ON musteri_id = kullanici.id WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_hizmet_talebi($hizmet_talebi){
    GLOBAL $db;
    $kolonlar = array_keys($hizmet_talebi);
    $sorgu_dizgesi = "INSERT INTO hizmet_talebi (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($hizmet_talebi));
    return $sonuc; // bool
}

function update_hizmet_talebi($hizmet_talebi){
    GLOBAL $db;
    $sorgu_dizgesi = "UPDATE hizmet_talebi SET ";
    $kolonlar = array_keys($hizmet_talebi);
    foreach($kolonlar as $kolon){
        if($kolon != 'id'){
            $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ? ": $kolon . " = ? , ";
        }
    }
    $sorgu_dizgesi .= " WHERE id = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $degerler = array();
    foreach(array_values($hizmet_talebi) as $deger){
        if($deger != $hizmet_talebi['id']){
            array_push($degerler, $deger);
        }
    }
    array_push($degerler, $hizmet_talebi['id']);
    $sonuc = $sorgu->execute($degerler);
    return $sonuc;
}

/**
 * Parametreler
 * $altAralik => tarih saat (String) 
 * $ustAralik => tarih saat (String) 
 **/
function get_hizmet_talebi_By_olusturma_zamani($altAralik, $ustAralik){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM hizmet_talebi WHERE olusturma_zamani BETWEEN CAST('?' AS datetime) AND CAST('?' AS datetime)
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$altAralik, $ustAralik]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

/**
 * Parametreler
 * $altAralik => tarih saat (String) 
 * $ustAralik => tarih saat (String) 
 **/
function get_hizmet_talebi_By_son_teklif_zamani($altAralik, $ustAralik){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM hizmet_talebi WHERE son_teklif_zamani BETWEEN CAST('?' AS datetime) AND CAST('?' AS datetime)
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$altAralik, $ustAralik]);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_hizmet_talebi_By_uzmanliklar($uzmanliklar, $onayli_mi){
    GLOBAL $db;
    $sorgu_dizgesi = "
    SELECT 
        kullanici.*,
        GROUP_CONCAT(uzmanlik_alani.adi) as uzmanlik_alanlari,
        hizmet_talebi.* 
    FROM 
        hizmet_talebi 
        JOIN kullanici ON musteri_id = kullanici.id
        LEFT JOIN uzmanlik_alani ON hizmet_talebi.id = uzmanlik_alani.hizmet_talebi_id
    ";

    if($onayli_mi){
        $sorgu_dizgesi .= "
        WHERE hizmet_talebi.onaylayan_kullanici != 0
        ";
    }
    $sorgu_dizgesi .= "        
    GROUP BY hizmet_talebi.id Having 
    ";
    foreach ($uzmanliklar as $index => $uzmanlik) {
        if($index != (count($uzmanliklar) - 1)){
            $sorgu_dizgesi .= " FIND_IN_SET(? ,uzmanlik_alanlari) > 0 AND ";
        }else{
            $sorgu_dizgesi .= " FIND_IN_SET(? ,uzmanlik_alanlari) > 0";
        }
    }
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute($uzmanliklar);
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}