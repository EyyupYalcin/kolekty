<?php include '../Servisler/Adres_sokak.php' ?>
<?php
$mahalle_id = gerekli("POST", "mahalle_id");

api_yanit(get_adres_sokak_where("mahalle_id = $mahalle_id"));