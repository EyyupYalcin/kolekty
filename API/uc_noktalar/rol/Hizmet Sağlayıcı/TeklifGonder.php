<?php include "../Servisler/Mesaj_Bildirim.php"; ?>
<?php
$hizmet_id = gerekli("POST", "hizmet_id");
$teklif_metni = gerekli("POST", "teklif_metni");
$teklif_tutari = gerekli("POST", "teklif_tutari");
$alici_id = gerekli("POST", "alici_id");

try {
    $gonderilen_teklif = TeklifGonder($kullanici['id'], $alici_id, $teklif_metni, $teklif_tutari, $hizmet_id);
} catch (\Throwable $th) {
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Teklif Gönderilemedi"
    ]);
    die;
}

api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Teklif Gönderildi",
    "gonderilen_teklif" => $gonderilen_teklif
]);