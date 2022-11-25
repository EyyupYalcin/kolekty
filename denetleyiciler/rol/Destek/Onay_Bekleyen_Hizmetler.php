<?php include_once('Servisler/Hizmet_saglayicilar.php'); ?>
<?php 

$baslik = "Onay Bekleyen Hizmetler";
$sablon = "GostergePaneli";
$sablon_bilesenleri = ['Sohbet','MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'KullaniciPaneli'];

$onay_bekleyen_hizmetler = get_hizmet_saglayicilar_where(" durum = 2");
$onaylanan_hizmetler = get_hizmet_saglayicilar_where(" durum = 3");
