<?php
function form_file($parametreler){
    ?>
    <div class="form-group">
        <label for="<?= $parametreler['id'] ?>"><?= $parametreler['etiket'] ?></label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" value="<?= $parametreler['deger'] ?>" id="<?= $parametreler['id'] ?>">
                <label class="custom-file-label" for="<?= $parametreler['id'] ?>">Dosya Seç</label>
            </div>
            <!-- <div id="<?= $parametreler['id'] ?>-info" class="input-group-append">
                <span class="input-group-text">Yükle</span>
            </div> -->
        </div>
    </div>
    <script>
        $('#<?= $parametreler['id'] ?>').change(function(e){
            var fileName = e.target.files[0].name;
            e.target.nextElementSibling.innerText = '"' + fileName + '" seçildi';
            
        });
    </script>
    <?php
}
?>