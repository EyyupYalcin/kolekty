<?php
include bilesen('SembolLink');
$roller = get_rol_where("ekleyen_rol = 0 ORDER BY id");
?>

<div class="w-100 h-100 fixed-top bg-dark text-center text-white">
    <h1 style="font-size: 3rem;" class="mt-10">Üyelik Türünüzü Seçin</h1>
    <div class="d-flex justify-content-center flex-wrap">
    <?php 
    $icons = [
        "Müşteri" => "fas fa-user",
        "Hizmet Sağlayıcı" => "fas fa-briefcase",
    ];
    foreach ($roller as $rol) {
            ?>
                <?= SembolLink([
                    "SembolSınıf" => isset($icons[$rol['rol_adi']]) ? $icons[$rol['rol_adi']] : "",
                    "link" => "KayitTamamla/". seoURL($rol['rol_adi']) . '/' . $rol['id'],
                    "etiket" =>  $rol['rol_adi'],
                ]) ?>  
            <?php
        } ?>
    </div>
</div>