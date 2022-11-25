<?php 

/*
Blog {
    blog_id: int
    blog_baslik: string
    blog_icerik: string
    blog_resim: string
    blog_tarih: datetime
    blog_yazar: int
    blog_kategori: int
}

Blog_kategori {
    blog_kategori_id: int
    blog_kategori_adi: string
}
*/

function get_Blog_List(){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Blog
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function get_Blog_where($raw_where){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Blog WHERE
    " . $raw_where;
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function insert_Blog($Blog){
    GLOBAL $db;
    $kolonlar = array_keys($Blog);
    $sorgu_dizgesi = "INSERT INTO Blog (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon : $kolon . ", ";
    }
    $sorgu_dizgesi .= ") VALUES (";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? "?" : "?, ";
    }
    $sorgu_dizgesi .= ")";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($Blog));
    return $sonuc; // bool
}

function get_Blog_By_blog_id($blog_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT * FROM Blog WHERE blog_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$blog_id]);
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    return $sonuclar;
}

function update_Blog($Blog){
    GLOBAL $db;
    $kolonlar = array_keys($Blog);
    $sorgu_dizgesi = "UPDATE Blog SET ";
    foreach($kolonlar as $kolon){
        $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ?" : $kolon . " = ?, ";
    }
    $sorgu_dizgesi .= " WHERE blog_id = ?";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute(array_values($Blog));
    return $sonuc; // bool
}

function delete_Blog($blog_id){
    GLOBAL $db;
    $sorgu_dizgesi = "
        DELETE FROM Blog WHERE blog_id = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sonuc = $sorgu->execute([$blog_id]);
    return $sonuc; // bool
}

?>