<?php
$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");

api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "API Oluşturuldu Ancak Henüz Hazır Değil!"
]);