<?php include "../Servisler/Randevu.php"; ?>
<?php
$mesaj_id = gerekli("POST", "mesaj_id");

try {
    $randevu = get_randevu_mesaj($mesaj_id);
} catch (\Throwable $th) {
    print_r($th);
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Randevu Getirilemedi"
    ]);
    die;
}

api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Randevu Bilgileri Getirildi",
    "randevu" => $randevu
]);