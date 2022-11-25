<?php include '../Servisler/Adres_ilce.php'; ?>
<?php
$il_id = gerekli("POST", "il_id");

api_yanit(get_adres_ilce_where("il_id = $il_id"));