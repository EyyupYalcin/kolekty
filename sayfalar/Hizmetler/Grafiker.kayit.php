<?php include_once bilesen('Form/Form') ?>

<div class="card card-custom gutter-b mt-8">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                <?= $secili_hizmet[0]['hizmet_adi'] ?> Hizmet Sağlayıcı Başvuru Formu
                <small></small>
            </h3>
        </div>
    </div>
    <div class="card-body">
        <?php
            Form::render('form_text', [
                "id" => "diyetisten_adi",
                "etiket" => "Freelancer Adı"
            ]);
        ?>

        <?php
            Form::render('form_file', [
                "id" => "profil_photo",
                "etiket" => "Profil fotoğrafı"
            ]);
        ?>

        <?php
            Form::render('form_file', [
                "id" => "cover_photo",
                "etiket" => "Hizmetinizi açıklayan bir kapak fotoğrafı yükleyin"
            ]);
        ?>

        <?php
            Form::render('tinymce_editor', [
                "id" => "biyografi",
                "name" => "biyografi",
                "etiket" => "Müşterileriniz İçin Kendinizi Tanıtın",
            ])
        ?>

        <?php
            // Form::render('form_file', [
            //     "id" => "diplomaniz",
            //     "etiket" => "Diplomanızı Yükleyin"
            // ]);
        ?>

        <?php
            Form::render('form_money', [
                "id" => "ucret",
                "etiket" => "Saatlik Ücret"
            ]);
        ?>
    </div>
    <div class="card-footer">
        <?php 
            Form::render('AjaxPostButton', [
                "id" => "kayit_gonder",
                "metin" => "Kaydet",
                "API" => "API/Grafiker_Kayit",
            ]);
        ?>
    </div>
</div>