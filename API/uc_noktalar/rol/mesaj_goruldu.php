<?php include "../Servisler/Mesaj_Bildirim.php"; ?>
<?php
$mesaj_id = gerekli("POST", "mesaj_id");

MesajGoruldu($mesaj_id);

api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "Mesaj Görüldü",
]);