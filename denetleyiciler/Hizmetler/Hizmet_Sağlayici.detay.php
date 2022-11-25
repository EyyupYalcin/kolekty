<?php include('Servisler/Hizmet_saglayicilar.php'); ?>
<?php include_once('Servisler/Hizmetler.php'); ?>
<?php include_once('Servisler/Portfolyo.php'); ?>
<?php include_once('Servisler/Egitim.php'); ?>
<?php include "Servisler/Uzmanlik_alani.php"; ?>
<?php include "Servisler/Yorumlar.php"; ?>
<?php
    $hizmet_saglayici_id = $_GET['hizmet_saglayici_id'];
    $hizmet_saglayici = get_hizmet_saglayicilar_where(" hizmet_saglayicilar.id = " . $hizmet_saglayici_id)[0];
    $aciklama = str_limit($hizmet_saglayici['tanitim'], 160);
    $kendi_sayfam = false;
    if($hizmet_saglayici['hizmet_id'] == null){ // Buna neden baktık hatırlamıyorum ama dokunmadım.
        $sayfa = "404";
        $baslik = "Hizmet Sağlayıcı Bulunamadı";
    }else{
        $hizmet = get_Hizmetler_where(" id = " . $hizmet_saglayici['hizmet_id'])[0];
        $baslik = $hizmet_saglayici['adi'] . " Hizmeti";
        $portfolyolar = get_portfolyo_where(" hizmet_saglayici_id = " . $hizmet_saglayici_id);
        $egitimler = get_egitim_where(" kullanici_id = " . $hizmet_saglayici['kullanici_id'] . " AND onay = 1");
        $uzmanlik_alanlari = get_uzmanlik_alani_where(" hizmet_saglayici_id = " . $hizmet_saglayici_id);
        $yorumlar = get_yorumlar_By_hizmet_saglayici_id($hizmet_saglayici_id);
        $uzmanlik_alanlari_liste = get_uzmanlik_alani_By_hizmet_id($hizmet_saglayici['hizmet_id']);
        if($hizmet_saglayici['kullanici_id'] != $kullanici['id']){ // Hizmet ziyaretçinin kendi hizmeti değilse
            if($hizmet_saglayici['onaylayan_kullanici'] == 0 && getAktifRol() != "Destek"){
                $sayfa = "404";
                $baslik = "Hizmet Sağlayıcı Bulunamadı";
            }
        }else{
            $kendi_sayfam = true; // kendi sayfam değişkeni true atanır. Sayfada bunu kullanarak editable alanlar oluşturulacak
            $egitimler = get_egitim_where(" kullanici_id = " . $hizmet_saglayici['kullanici_id'] . "");
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
        $sayfa = 'Hizmetler/Hizmet_Saglayici.popup';
    } else {
        $sablon = "GostergePaneli";
    }
?>