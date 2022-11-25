<?php include "../Servisler/Teklif.php"; ?>
<?php
$teklif_id = gerekli("POST", "teklif_id");

if(TeklifIptal($teklif_id)){
    api_yanit([
        "durum" => "success",
        "mesaj" => "Teklif iptal edildi",
    ]);
    die;
}

api_yanit([
    "durum" => "error",
    "mesaj" => "Teklif iptal edilemedi.",
]);

