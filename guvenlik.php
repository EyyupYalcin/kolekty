<?php
    /* Yasir 
    * LFI güvenlik açığı ../../ şeklinde bir girdi ile linux error 
    * sayfalarının include edilmesi şeklinde istismar edilen bir güvenlik açığı.
    * Bu nedenle include işlemlerinden önce güvenlik kontrolü yapıyoruz.
    */
    function lfi_guvenli_mi($konum){
        if(strpos($konum, "..") !== false){
            return false;
        }else{
            return true;
        }
    }

    /* Yasir
    * Eyyüp'ün ayarlar dosyasına yazdığı güvenlik fonksiyonu.
    * güvenlik ile ilgili bu dosyaya taşıdım. 
    * Adını işlevini belirtecek şekilde güncelledim. 
    * girdileri bu yöntem ile temizlemek 
    */
    function guvenli_girdi($q) {
        $q = htmlentities(trim($q));
        $q = str_replace("script", "blocked", $q);
        $q = str_replace("`", "", $q);
        $q = str_replace("'", "'", $q); // <-- Bu satırların amacını anlayamadım
        $q = str_replace("-", "-", $q); // <-- Bu satırların amacını anlayamadım
        $q = str_replace("&", "", $q);
        $q = str_replace("%", "", $q);
        $q = str_replace("<", "", $q);
        $q = str_replace(">", "", $q);
        $q = trim($q);
        return $q;
    }

    function seoURL($url) {
        $url = mb_strtolower($url, 'UTF-8');
        $turkce = [
            "ç" => "c",
            "ı" => "i",
            "ğ" => "g",
            "ü"=> "u",
            "ö" => "o",
            "ş" => "s",
            " " => "-",
            "&" => "-ve-",
            "|" => "-veya-",
            "--" => "-"
        ];
        $url = str_replace(array_keys($turkce), array_values($turkce), $url);
        //$url = preg_replace("@[^A-Za-z0-9\-_]+@i", "", $url);
        return $url;
    }

    function oturumGerekli(){
        if(!oturumAcikMi()){ header('Location: /Giris'); }
    }

    function oturumAcikMi(){
        return isset($_SESSION['kullanici']);
    }
    
    function getAktifRol(){
        if(oturumAcikMi()){
            return $_SESSION['AktifRol'];
        }else{
            return '';
        }
    }

    function setAktifRol($RolAdi){
        return $_SESSION['AktifRol'] = $RolAdi;
    }

    function str_limit($text, $limit = 100, $end = '...') {
    if (mb_strlen($text) <= $limit) {
        return $text;
    }
    return mb_substr($text, 0, $limit) . $end;
    }
?>