<?php include_once('Servisler/Hizmet_saglayicilar.php'); ?>
<?php include_once('Servisler/Hizmetler.php'); ?>
<?php include "Servisler/Uzmanlik_alani.php"; ?>
<?php
    $hizmet = get_Hizmetler_where(" hizmet_adi = \"" . $_GET['hizmet_adi']  . "\"")[0];

    $baslik = $_GET['hizmet_adi'] . " Servis Sağlayıcılar";
    $aciklama = $hizmet['hizmet_aciklaması'];
    
    if(oturumAcikMi()){
        $sablon_bilesenleri = ['AnasayfaArama',  'KategoriMenu', 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
    }else{
        $sablon_bilesenleri = ['AnasayfaArama', 'MobilUst', 'KategoriMenu', 'SayfaAlt', 'SayfaUst', 'Scripts'];
    }
    
    define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if(IS_AJAX_REQUEST) {
        $sablon = "bos";
    }
    else {
        $sablon = "GostergePaneli";
    }

    $uzmanlik_alanlari_liste = get_uzmanlik_alani_By_hizmet_id($hizmet['id']);

    $aranan_uzmanliklar = [];
    if(getAktifRol() == "Destek"){ // istek gönderen destek rolünde ise görünürlük önemsizdir
        if(isset($_GET['filtrele'])){
            $aranan_uzmanliklar = explode('-ve-', $_GET['filtrele']);
            $hizmet_saglayicilar = get_hizmet_saglayicilar_By_uzmanliklar($aranan_uzmanliklar, false);
        }else{
            $hizmet_saglayicilar = get_hizmet_saglayicilar_where(" hizmet_id = '" . $hizmet['id'] . "'");
        }
    }else{ // değilse sadece onaylayan_kullanici != 0 olanları görebilir.
        if(isset($_GET['filtrele'])){
            $aranan_uzmanliklar = explode('-ve-', $_GET['filtrele']);
            $hizmet_saglayicilar = get_hizmet_saglayicilar_By_uzmanliklar($aranan_uzmanliklar, true);
        }else{
            $hizmet_saglayicilar = get_hizmet_saglayicilar_where(" hizmet_id = '" . $hizmet['id'] . "' AND onaylayan_kullanici != 0");
        }
    }
    

?>