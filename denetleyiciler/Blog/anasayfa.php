<?php include_once('Servisler/Blog.php'); ?>
<?php
    $sablon = "GostergePaneli";
    $baslik = "Kolekty Blog - Anasayfa";
    if(oturumAcikMi()){
        $sablon_bilesenleri = [ 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
    }else{
        $sablon_bilesenleri = [ 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts'];
    }

    
?>
