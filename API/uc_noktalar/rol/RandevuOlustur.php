<?php include "../Servisler/Mesaj_Bildirim.php"; ?>
<?php
$zaman = gerekli("POST", "zaman");
$konu = gerekli("POST", "konu");
$aciklama = gerekli("POST", "aciklama");
$alici_id = gerekli("POST", "alici_id");


try {
    $gonderilen_randevu = RandevuGonder($kullanici['id'], $alici_id, $zaman, $konu, $aciklama);
} catch (\Throwable $th) {
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Randevu Gönderilemedi"
    ]);
    die;
}

api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Randevu Gönderildi",
    "gonderilen_randevu" => $gonderilen_randevu
]);