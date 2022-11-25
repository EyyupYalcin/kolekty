<?php include "../Servisler/Mesaj_Bildirim.php"; ?>
<?php
$mesajlasilan_kullanici_id = gerekli("POST", "kullanici_id");

$sohbet = getSohbet($kullanici['id'], $mesajlasilan_kullanici_id);
$mesajlasilan_kullanici = getKullaniciByID($mesajlasilan_kullanici_id);

foreach ($sohbet as $mesaj) {
    if($mesaj['alici_id'] == $kullanici['id']){
        MesajGoruldu($mesaj['id']);
    }
}

api_yanit([
    "durum" => "Bilgi",
    "sohbet" => $sohbet,
    "mesajlasilan_kullanici" => $mesajlasilan_kullanici
]);