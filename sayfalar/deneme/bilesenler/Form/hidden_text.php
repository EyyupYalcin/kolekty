<?php
function form_hidden_text($parametreler)
{
    ?>
        <!-- Text -->
        <div class="form-group" style="display: none;">
            <label for="<?= $parametreler['id'] ?>"><?= $parametreler['etiket'] ?></label>
            <input type="text" id="<?= $parametreler['id'] ?>" value="<?= $parametreler['deger'] ?>" class="form-control">
        </div>
    <?php
}