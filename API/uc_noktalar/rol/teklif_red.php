<?php include "../Servisler/Teklif.php"; ?>
<?php
$teklif_id = gerekli("POST", "teklif_id");

if(TeklifRed($teklif_id)){
    api_yanit([
        "durum" => "success",
        "mesaj" => "Teklif red edildi",
    ]);
    die;
}

api_yanit([
    "durum" => "error",
    "mesaj" => "Teklif red edilemedi.",
]);
