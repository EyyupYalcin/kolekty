<?php include bilesen('Form/Form'); ?>

<div class="card card-custom gutter-b mt-8">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                Hesabınızı Aktifleştirin
                <small></small>
            </h3>
        </div>
    </div>
    <div class="card-body">

        <?php
            Form::render('form_text', [
                "id" => "DogrulamaKodu",
                "etiket" => "Doğrulama Kodu"
            ]);
        ?>

    </div>
    <div class="card-footer">
        <?= AjaxPostButton([
            "id" => "dogrula",
            "metin" => "Doğrula",
            "API" => "/API/EpostaDoğrula",
        ]) ?>
    </div>
</div>