<?php
$sorgulanacak_kullanici_id = gerekli("POST", "sorgulanacak_kullanici_id");

$sorgulanan_kullanici = getKullaniciByID($sorgulanacak_kullanici_id);

api_yanit([
    "durum" => "Bilgi",
    "sorgulanan_kullanici" => $sorgulanan_kullanici
]);