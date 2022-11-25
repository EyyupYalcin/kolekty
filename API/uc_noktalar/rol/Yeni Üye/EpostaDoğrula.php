<?php
$DogrulamaKodu = gerekli("POST", "DogrulamaKodu");

api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "API Oluşturuldu Ancak Henüz Hazır Değil!"
]);