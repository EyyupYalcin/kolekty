<?php include('../guvenlik.php'); ?>
<?php include('../veritabani.php'); ?>
<?php include('../Servisler/Mail/load.php'); ?>
<?php include('../Servisler/Kullanici.php'); ?>
<?php if(oturumAcikMi()) $kullanici = $_SESSION['kullanici']; ?>
<?php
    header('Content-Type: application/json; charset=utf-8');

    function api_yanit($yanit){
        echo json_encode($yanit);
    }

    function gerekli($method,$parametre){
        switch($method){
            case "POST":
                if(!isset($_POST[$parametre])){
                    api_yanit(["bilgi" => "'" . $parametre . "' POST parametresi bulunamadı"]);
                    die;
                }else{
                    return $_POST[$parametre];
                }
                break;
            case "GET":
                if(!isset($_GET[$parametre])){
                    api_yanit(["bilgi" => "'" . $parametre . "' GET parametresi bulunamadı"]);
                    die;
                }else{
                    return $_GET[$parametre];
                }
                break;
            case "FILES":
                if(!isset($_FILES[$parametre])){
                    api_yanit(["bilgi" => "'" . $parametre . "' FILES parametresi bulunamadı"]);
                    die;
                }else{
                    return $_FILES[$parametre];
                }
                break;
        }
    }

    function getir($method,$parametre){
        switch($method){
            case "POST":
                if(isset($_POST[$parametre])){
                    return $_POST[$parametre];
                }else{
                    return false;
                }
                break;
            case "GET":
                if(isset($_GET[$parametre])){
                    return $_GET[$parametre];
                }else{
                    return false;
                }
                break;
            case "FILES":
                if(!isset($_FILES[$parametre])){
                    return $_FILES[$parametre];
                }else{
                    return false;
                }
                break;
        }
    }

    function var_mi($method,$parametre){
        switch($method){
            case "POST":
                return isset($_POST[$parametre]);
                break;
            case "GET":
                return isset($_GET[$parametre]);
                break;
            case "FILES":
                return isset($_FILES[$parametre]);
                break;
        }
    }

    function son_eklenen_id(){
        global $db;
        return $db->lastInsertId();
    }

    function dosyaYukle($dosya, $dizin){
        $dosyaAdi = $dosya['name'];
        $izin_verilen_uzantilar = array('png','jpeg','jpg', 'svg', 'docx', 'doc', 'pdf');

        if (!file_exists("../assets/uploads/". $dizin . "/")) mkdir("../assets/uploads/". $dizin . "/", 0777);

        $yukleme_dizini = "../assets/uploads/". $dizin . "/" . $dosyaAdi;
        $dosya_uzantisi = pathinfo($yukleme_dizini, PATHINFO_EXTENSION);
        $dosya_uzantisi = strtolower($dosya_uzantisi);
        if(in_array($dosya_uzantisi, $izin_verilen_uzantilar)){
            if(move_uploaded_file($dosya['tmp_name'],$yukleme_dizini)){ 
                return "/assets/uploads/". $dizin . "/" . $dosyaAdi;
            }
        }
    }

    function uc_nokta_olustur($dosya_konumu){
        $sablon = fopen("API_sablon.codegen.php", "r") or die("Şablon Açılamıyor!");
        $sablon_kod = fread($sablon,filesize("API_sablon.codegen.php"));
        fclose($sablon);

        $dosya = fopen($dosya_konumu, "w") or die("Dosya Açılamadı!");
        fwrite($dosya, $sablon_kod);
        fclose($dosya);
    }
?>