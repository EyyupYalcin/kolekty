<?php
    $baslik = "Gizlilik Politikası";
    if(oturumAcikMi()){
        $sablon_bilesenleri = ['AnasayfaArama',  'KategoriMenu', 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
    }else{
        $sablon_bilesenleri = ['AnasayfaArama', 'MobilUst', 'KategoriMenu', 'SayfaAlt', 'SayfaUst', 'Scripts'];
    }
    $sablon = "GostergePaneli";
?>