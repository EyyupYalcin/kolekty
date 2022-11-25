<?php include_once '../Servisler/Kullanici.php'; ?>
<?php 

$baslik = "Kaydınızı Tamamlayın";
$sablon = "GostergePaneli";
$sablon_bilesenleri = ['MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'KullaniciPaneli'];
$kullanicilar = getKullanicilar();
var_dump($kullanicilar);die;
