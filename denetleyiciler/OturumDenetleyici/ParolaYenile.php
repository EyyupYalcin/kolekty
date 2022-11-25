<?php
$baslik = "Parola Yenile";
$sablon_bilesenleri = ['AnasayfaArama', 'MobilUst', 'KategoriMenu', 'SayfaAlt', 'SayfaUst', 'Scripts'];
$sablon = "GostergePaneli";

$token = $_GET['parola_yenileme_kodu'];

$_kullanici = getKullaniciByParolaYenilemeKodu($token);

if($_kullanici){
  $simdi = date_create(date('Y-m-d H:i:s'));
  $son_kullanim = date_create(date($_kullanici['parola_yenileme_kodu_son_kullanim']));
  if($simdi > $son_kullanim){
    $token_dogru = false;
  }else{
    $token_dogru = true;
  }
}else{
  $token_dogru = false;
}

