<?php include bilesen('Form/Form'); ?>

<div class="card card-custom gutter-b mt-8">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                <?= $rol['rol_adi'] ?> Kayıt Formu
                <small></small>
            </h3>
        </div>
    </div>
    <div class="card-body">

            <?php include bilesen('adres_sec'); ?>

            
    </div>
    <div class="card-footer">
        <?php 
            Form::render('AjaxPostButton', [
                "id" => "KayitTamamla",
                "metin" => "Kaydet",
                "API" => "API/MusteriKayit",
            ]);
        ?>
    </div>
</div>