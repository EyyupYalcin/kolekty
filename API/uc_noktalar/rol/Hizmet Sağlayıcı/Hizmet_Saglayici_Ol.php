<?php
$hizmet_saglayici_adi = gerekli("POST", "hizmet_saglayici_adi");
$hizmet_id = gerekli("POST", "hizmet_id");

api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "API Oluşturuldu Ancak Henüz Hazır Değil!"
]);