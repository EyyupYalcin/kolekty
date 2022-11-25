<?php include '../Servisler/Adres_mahalle.php'; ?>
<?php
$ilce_id = gerekli("POST", "ilce_id");

api_yanit(get_adres_mahalle_where("ilce_id = $ilce_id"));