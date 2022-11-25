        <?php
            Form::render('form_text', [
                "id" => "egitim_adi",
                "etiket" => "Eğitim Adı"
            ]);
        ?>

        <?= Form::render('tinymce_editor', [
                "id" => "hakkinda",
                "name" => "hakkinda",
                "etiket" => "Eğitim Hakkında",
            ])
        ?>

        <?php
            Form::render('form_datetime', [
                "id" => "baslangic_tarihi",
                "etiket" => "Eğitim Başlangıç Tarihi"
            ]);
        ?>

        <?php
            Form::render('form_file', [
                "id" => "afis_gorseli",
                "etiket" => "Afiş Görseli"
            ]);
        ?>

        <?php
            Form::render('form_text', [
                "id" => "web_sayfasi",
                "etiket" => "Web Sayfası"
            ]);
        ?>

        <?php
            Form::render('form_money', [
                "id" => "ucret",
                "etiket" => "Ücret"
            ]);
        ?>

        <?php
            Form::render('form_single_select_db', [
                "id" => "belge_id",
                "etiket" => "Verilecek Belge",
                "varsayilan" => "Belge Verilmeyecek",
                "veritabani" => [
                    "tablo" => "egitim_belge",
                    "value_kolon" => "id",
                    "text_kolon" => "belge_adi"
                ],
            ]);
        ?>