<?php include_once 'Servisler/Hizmetler.php'; ?>
<?php include_once 'Servisler/Hizmet_saglayicilar.php'; ?>
<?php
    $baslik = "Profil";
    if(oturumAcikMi()){
        $profil_rol = getAktifRol();
        if($_GET['kullanici_id'] == $kullanici['id']){
            $baslik = "Profilim";

            if($profil_rol == "Müşteri"){
                $sayfa = "Profilim/Müşteri";
            }else if($profil_rol == "Hizmet Sağlayıcı"){
                $sayfa = "Profilim/Hizmet_Sağlayıcı";
            }else{
                $sayfa = "Profilim/Profilim";
            }

            $hizmet_bilgileri = get_hizmet_saglayicilar_where(" kullanici_id = $kullanici[id]");
            if(count($hizmet_bilgileri) != 0){
                $profil_rol = get_Hizmetler_where(" id = " . $hizmet_bilgileri[0]['hizmet_id'])[0]['hizmet_adi'];
            }
        }
        $sablon_bilesenleri = ['AnasayfaArama',  'KategoriMenu', 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
    }else{
        $sablon_bilesenleri = ['AnasayfaArama', 'MobilUst', 'KategoriMenu', 'SayfaAlt', 'SayfaUst', 'Scripts'];
    }
    $sablon = "GostergePaneli";
    


?>