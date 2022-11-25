<?php
    $sablon = 'bos';

    // Eğer sunucu adı localhost ise kök url olarak http://localhost/kolekty/ kullanacak
    if($_SERVER['SERVER_NAME'] == 'localhost'){
        $kok_url = 'http://localhost/kolekty/';
    }else{ // Değilse sunucu alan adını kullanacak
        if($_SERVER['HTTPS']){
            $kok_url = 'https://'.$_SERVER['SERVER_NAME'].'/'; // https://kolekty.com/
        }else{
            $kok_url = 'http://'.$_SERVER['SERVER_NAME'].'/'; // http://kolekty.com/
        }
    }

    function bilesenVarMi($bilesen){
        global $sablon_bilesenleri;
        return in_array($bilesen, $sablon_bilesenleri);
    }

    function sayfa($sayfa_konumu, $cagri_konumu='./'){
        if(file_exists($cagri_konumu . 'sayfalar/' . $sayfa_konumu . '.php') &&
        lfi_guvenli_mi($cagri_konumu . 'sayfalar/' . $sayfa_konumu . '.php')){
            return $cagri_konumu . 'sayfalar/' . $sayfa_konumu . '.php';
            echo "1";
        }
        return 'bos.php';
    }

    function sablonBileseni($bilesen_konumu, $cagri_konumu='./'){
        global $sablon_bilesenleri, $sablon;
        if(in_array($bilesen_konumu, $sablon_bilesenleri) &&
        file_exists($cagri_konumu . 'sablonlar/' . $sablon . '/' . $bilesen_konumu . '.php') &&
        lfi_guvenli_mi($cagri_konumu . 'sablonlar/' . $sablon . '/' . $bilesen_konumu . '.php')){
            return $cagri_konumu . 'sablonlar/' . $sablon . '/' . $bilesen_konumu . '.php';
        }
        return 'bos.php';
    }

    function bilesen($bilesen_konumu, $cagri_konumu='./'){
        if(file_exists($cagri_konumu . 'sayfalar/bilesenler/' . $bilesen_konumu . '.php') &&
        lfi_guvenli_mi($cagri_konumu . 'sayfalar/bilesenler/' . $bilesen_konumu . '.php')){
            return $cagri_konumu . 'sayfalar/bilesenler/' . $bilesen_konumu . '.php';
        }
        return 'bos.php';
    }

    function denetleyici($denetleyici_konumu, $cagri_konumu='./'){
        if(file_exists($cagri_konumu . 'denetleyiciler/' . $denetleyici_konumu . '.php') &&
        lfi_guvenli_mi($cagri_konumu . 'denetleyiciler/' . $denetleyici_konumu . '.php')){
            return $cagri_konumu . 'denetleyiciler/' . $denetleyici_konumu . '.php';
        }
        return 'bos.php';
    }

    function parametreleri_temizle($url){
        $baslangic = strpos($url, "{");
        if($baslangic === false){
            return 0;
        }else{
            $bitis = strpos($url, "}");
        }
        $uzunluk = $bitis - $baslangic;
        echo substr($url, $baslangic, $uzunluk);
        die;
    }

    function parametre_isimlerini_getir($sonuc){
        $parametreler = []; 
        foreach(array_keys($sonuc) as $parametreAdayi){
            if(gettype($parametreAdayi) == "string"){
                array_push($parametreler, $parametreAdayi);
            }
        }
        return $parametreler;
    }

    function parametreliYonlendirmeler(){
        global $parametreli_yonlendirmeler, $sayfa_adi, $sayfa, $denetleyici;
        $istek = $sayfa_adi;

        foreach($parametreli_yonlendirmeler as $yonlendirme){
            $yonlendirme['tanimlayici'] = str_replace('/', '\/', $yonlendirme['tanimlayici']);
            preg_match("/$yonlendirme[tanimlayici]/", $istek, $sonuc);
            if(count($sonuc) != 0){
                foreach(parametre_isimlerini_getir($sonuc) as $parametre){
                    $_GET[$parametre] = $sonuc[$parametre];
                }
                $denetleyici = file_exists('denetleyiciler/' . $yonlendirme['denetleyici'] . '.php') ? $yonlendirme['denetleyici'] : '404';
                $sayfa = file_exists('sayfalar/' . $yonlendirme['sayfa'] . '.php') ? $yonlendirme['sayfa'] : '404';
                if(isset($_SESSION['AktifRol'])){
                    $rol = $_SESSION['AktifRol'];
                    if(file_exists('sayfalar/rol/' . $rol . '/' . $yonlendirme['sayfa'] . '.php')){
                        $sayfa = 'rol/' . $rol.'/' . $yonlendirme['sayfa'];
                    }
                    if(file_exists('denetleyiciler/rol/' . $rol . '/' . $yonlendirme['denetleyici'] . '.php')){
                        $denetleyici = 'rol/' . $rol . '/' . $yonlendirme['denetleyici'];
                    }
                }
                return true;
            }
        }


        return false;
    }

    $sayfa_adi = isset($_GET['sayfa']) ? $_GET['sayfa'] : 'Anasayfa';
    if(!parametreliYonlendirmeler($sayfa_adi)){
        if(oturumAcikMi()){
            if(isset($_SESSION['AktifRol'])){
                $rol = $_SESSION['AktifRol'];
    
                if(isset($yonlendirmeler[$sayfa_adi])){
                    $denetleyici = file_exists('denetleyiciler/' . $yonlendirmeler[$sayfa_adi][0] . '.php') ? $yonlendirmeler[$sayfa_adi][0] : '404';
                    $sayfa = file_exists('sayfalar/' . $yonlendirmeler[$sayfa_adi][1] . '.php') ? $yonlendirmeler[$sayfa_adi][1] : '404';
                }else{
                    $denetleyici = file_exists('denetleyiciler/' . $sayfa_adi . '.php') ? $sayfa_adi : '404';
                    $sayfa = file_exists('sayfalar/' . $sayfa_adi . '.php') ? $sayfa_adi : '404';
                }
                if(file_exists('sayfalar/rol/' . $rol . '/' . $sayfa_adi . '.php')){
                    $sayfa = 'rol/' . $rol.'/' . $sayfa_adi;
                }
                if(file_exists('denetleyiciler/rol/' . $rol . '/' . $sayfa_adi . '.php')){
                    $denetleyici = 'rol/' . $rol . '/' . $sayfa_adi;
                }
            }else{
                $denetleyici = 'KayitTamamla';
                $sayfa = 'KayitTamamla';
            }
        }else{
            if(isset($yonlendirmeler[$sayfa_adi])){
                $denetleyici = file_exists('denetleyiciler/' . $yonlendirmeler[$sayfa_adi][0] . '.php') ? $yonlendirmeler[$sayfa_adi][0] : '404';
                $sayfa = file_exists('sayfalar/' . $yonlendirmeler[$sayfa_adi][1] . '.php') ? $yonlendirmeler[$sayfa_adi][1] : '404';
            }else{
                $denetleyici = file_exists('denetleyiciler/' . $sayfa_adi . '.php') ? $sayfa_adi : '404';
                $sayfa = file_exists('sayfalar/' . $sayfa_adi . '.php') ? $sayfa_adi : '404';
            }
        }
    }

    if(oturumAcikMi()){
        if(file_exists("denetleyiciler/Menu/" . getAktifRol() . ".php")){
            include "denetleyiciler/Menu/" . getAktifRol() . ".php";
        }else{
            include "denetleyiciler/Menu/Menu.php";
        }
    }else{
        include "denetleyiciler/Menu/Menu.php";
    }

    if(isset($_GET['parametreler'])){
        $parametreler = $_GET['parametreler'];
        $parametreler = explode('/', $parametreler);
        foreach ($parametreler as $index => $parametre) {
            if($index % 2 == 0){
                $_GET[$parametre] = $parametreler[$index + 1];
            }
        }
    }
?>