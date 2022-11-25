<?php
$sehir = gerekli("POST", "sehir");
$ilce = gerekli("POST", "ilce");
$mahalle = gerekli("POST", "mahalle");
$sokak = gerekli("POST", "sokak");
$adres_ek = gerekli("POST", "adres_ek");

api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "API Oluşturuldu Ancak Henüz Hazır Değil!"
]);