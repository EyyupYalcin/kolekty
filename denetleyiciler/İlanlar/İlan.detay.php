<?php include('Servisler/Hizmet_talebi.php'); ?>
<?php include_once('Servisler/Hizmetler.php'); ?>
<?php include_once('Servisler/Portfolyo.php'); ?>
<?php include_once('Servisler/Egitim.php'); ?>
<?php include "Servisler/Uzmanlik_alani.php"; ?>
<?php include "Servisler/Yorumlar.php"; ?>
<?php

    $ilan_id = $_GET['ilan_id'];
    $ilan = get_hizmet_talebi_where(" hizmet_talebi.id = " . $ilan_id)[0];
    $kendi_sayfam = false;

    if($ilan['hizmet_id'] == null){ // Buna neden baktık hatırlamıyorum ama dokunmadım.
        $sayfa = "404";
        $baslik = "İlan Bulunamadı";
    }else{
        $hizmet = get_Hizmetler_where(" id = " . $ilan['hizmet_id'])[0];
        $baslik = $ilan['baslik'] . " İlanı";
        if($ilan['musteri_id'] != $kullanici['id']){ // ilan ziyaretçinin kendi ilanı değilse
            if($ilan['onaylayan_kullanici'] == 0 && getAktifRol() != "Destek"){
                $sayfa = "404";
                $baslik = "İlan Bulunamadı";
            }
        }else{
            $kendi_sayfam = true; // kendi sayfam değişkeni true atanır. Sayfada bunu kullanarak editable alanlar oluşturulacak
        }
    }

    if(oturumAcikMi()){
        $sablon_bilesenleri = ['AnasayfaArama',  'KategoriMenu', 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
    }else{
        $sablon_bilesenleri = ['AnasayfaArama', 'MobilUst', 'KategoriMenu', 'SayfaAlt', 'SayfaUst', 'Scripts'];
    }

    define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if(IS_AJAX_REQUEST) {
        $sablon = "bos";
        $sayfa = 'İlanlar/İlan.popup';
    } else {
        $sablon = "GostergePaneli";
    }
?>