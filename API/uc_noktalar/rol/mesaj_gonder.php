<?php include "../Servisler/Mesaj_Bildirim.php"; ?>
<?php
$mesaj = gerekli("POST", "mesaj");
$alici_id = gerekli("POST", "alici_id");

try {
    $gonderilen_mesaj = MesajGonder($kullanici['id'], $alici_id, $mesaj);
} catch (\Throwable $th) {
    api_yanit([
        "durum" => "Bilgi",
        "mesaj" => "Mesaj Gönderilemedi"
    ]);
}


api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "Mesaj Gönderildi",
    "gonderilen_mesaj" => $gonderilen_mesaj
]);