<?php include "../Servisler/Teklif.php"; ?>
<?php
$mesaj_id = gerekli("POST", "mesaj_id");

try {
    $teklif = get_teklif_mesaj($mesaj_id);
} catch (\Throwable $th) {
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Teklif Getirilemedi"
    ]);
    die;
}

api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Teklif Bilgileri Getirildi",
    "teklif" => $teklif
]);