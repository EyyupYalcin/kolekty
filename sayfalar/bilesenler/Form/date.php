<?php
function form_date($parametreler)
{
    ?>
        <!-- Date -->
        <div class="form-group">
            <label><?=$parametreler['etiket']?>:</label>
            <div class="input-group date" id="<?= $parametreler['id'] ?>-datetimepicker" data-target-input="nearest">

                <div class="input-group-append" data-target="#<?= $parametreler['id'] ?>-datetimepicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input id="<?= $parametreler['id'] ?>" type="text" class="form-control datetimepicker-input" data-target="#<?= $parametreler['id'] ?>-datetimepicker"
                    data-toggle="datetimepicker" value="<?= $parametreler['deger'] ?>" />
            </div>
        </div>

        <script>
        $('#<?=$parametreler['id']?>-datetimepicker').datetimepicker({
            format: 'L',
            locale: moment.locale('tr'),
        });
        </script>
    <?php
}