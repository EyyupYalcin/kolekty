<?php
function form_money($parametreler)
{
    ?>
        <!-- money -->
        <div class="form-group">
            <label for="<?= $parametreler['id'] ?>"><?= $parametreler['etiket'] ?></label>
            <input type="text" id="<?= $parametreler['id'] ?>" class="form-control" value="<?= $parametreler['deger'] ?>" data-inputmask="'mask': '9{1,7}[.99]₺'" data-mask>
        </div>
        <script>
            $('#<?= $parametreler['id'] ?>').inputmask();
        </script>
    <?php
}