<?php include_once bilesen('Form/Form') ?>
<?=
    Form::render('form_single_select_api', [
        "id" => "sehir",
        "etiket" => "Şehir Seç",
        "API" => "Sehir",
        "ayristir" => [
            "value" => "il_id",
            "text" => "il_adi",
        ],
        "onchange" => "sehir_degisti(this)",
    ]);
?>
<script>
    sehirLoad();
    function sehir_degisti(elem){
        let secili_metin = [...elem.children].find((x)=>x.value == elem.value).innerText;
        let secili_id = elem.value;
        var il_id = secili_id;
        var form_data = new FormData();    
        form_data.append('il_id', il_id);
        ilceLoad(form_data);
        document.getElementById('ilce').parentNode.parentNode.style.display = 'block';
    }
</script>

<?=
    Form::render('form_single_select_api', [
        "id" => "ilce",
        "etiket" => "İlçe Seç",
        "API" => "ilce",
        "ayristir" => [
            "value" => "ilce_id",
            "text" => "ilce_adi",
        ],
        "onchange" => "ilce_degisti(this)",
    ]);
?>
<script>
    document.getElementById('ilce').parentNode.parentNode.style.display = 'none';
    function ilce_degisti(elem){
        let secili_metin = [...elem.children].find((x)=>x.value == elem.value).innerText;
        let secili_id = elem.value;
        var ilce_id = secili_id;
        var form_data = new FormData();    
        form_data.append('ilce_id', ilce_id);
        mahalleLoad(form_data);
        document.getElementById('mahalle').parentNode.parentNode.style.display = 'block';
    }
</script>

<?=
    Form::render('form_single_select_api', [
        "id" => "mahalle",
        "etiket" => "Mahalle Seç",
        "API" => "mahalle",
        "ayristir" => [
            "value" => "mahalle_id",
            "text" => "mahalle_adi",
        ],
        "onchange" => "mahalle_degisti(this)",
    ]);
?>
<script>
    document.getElementById('mahalle').parentNode.parentNode.style.display = 'none';
    function mahalle_degisti(elem){
        let secili_metin = [...elem.children].find((x)=>x.value == elem.value).innerText;
        let secili_id = elem.value;
        var mahalle_id = secili_id;
        var form_data = new FormData();    
        form_data.append('mahalle_id', mahalle_id);
        sokakLoad(form_data);
        document.getElementById('sokak').parentNode.parentNode.style.display = 'block';
    }
</script>

<?=
    Form::render('form_single_select_api', [
        "id" => "sokak",
        "etiket" => "Sokak Seç",
        "API" => "sokak",
        "ayristir" => [
            "value" => "sokak_id",
            "text" => "sokak_adi",
        ],
        "onchange" => "sokak_degisti(this)",
    ]);
?>
<script>
    document.getElementById('sokak').parentNode.parentNode.style.display = 'none';
    function sokak_degisti(elem){
        document.getElementById('adres_ek').parentNode.style.display = 'block';
    }
</script>

<?=
    Form::render('form_text', [
        "id" => "adres_ek",
        "etiket" => "Bina No / Kapı No"
    ]);
?>
<script>
    document.getElementById('adres_ek').parentNode.style.display = 'none';
</script>