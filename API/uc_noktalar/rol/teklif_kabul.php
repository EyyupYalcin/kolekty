<?php include "../Servisler/Teklif.php"; ?>
<?php
$teklif_id = gerekli("POST", "teklif_id");

if(TeklifKabul($teklif_id)){
    api_yanit([
        "durum" => "success",
        "mesaj" => "Teklif kabul edildi",
    ]);
    die;
}

api_yanit([
    "durum" => "error",
    "mesaj" => "Teklif kabul edilemedi.",
]);
