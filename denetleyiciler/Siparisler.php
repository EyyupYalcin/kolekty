<?php include_once 'Servisler/Siparisler.php'; ?>
<?php include_once 'Servisler/Hizmetler.php'; ?>
<?php include_once 'Servisler/Hizmet_saglayicilar.php'; ?>
<?php
    $baslik = "Siparisler";
    if(oturumAcikMi()){
        $profil_rol = getAktifRol();
        if($_GET['kullanici_id'] == $kullanici['id']){
            $baslik = "Siparisler";
            $sayfa = "Profilim/Siparisler";        
            
        }
        $sablon_bilesenleri = ['AnasayfaArama',  'KategoriMenu', 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
    }else{
        $sablon_bilesenleri = ['AnasayfaArama', 'MobilUst', 'KategoriMenu', 'SayfaAlt', 'SayfaUst', 'Scripts'];
    }
    $sablon = "GostergePaneli";
    

    $hizmet_bilgileri = get_hizmet_saglayicilar_where(" kullanici_id = $kullanici[id]");
    if(count($hizmet_bilgileri) != 0){
        $profil_rol = get_Hizmetler_where(" id = " . $hizmet_bilgileri[0]['hizmet_id'])[0]['hizmet_adi'];
    }

    if(getAktifRol() == "Müşteri"){
        $aktif_siparisler = get_musteri_aktif_siparisleri($kullanici['id']);
        $tum_siparisler = get_musteri_tum_siparisleri($kullanici['id']);
    }else if(getAktifRol() == "Hizmet Sağlayıcı"){
        $aktif_siparisler = get_hizmet_saglayici_aktif_siparisleri($kullanici['id']);
        $tum_siparisler = get_hizmet_saglayici_tum_siparisleri($kullanici['id']);
    }
?>