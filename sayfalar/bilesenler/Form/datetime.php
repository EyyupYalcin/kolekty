<?php
function form_datetime($parametreler)
{
    ?>
        <!-- Date and time -->
        <div class="form-group">
            <label><?=$parametreler['etiket']?>:</label>
            <div class="input-group date" id="<?=$parametreler['id']?>-datetimepicker" data-target-input="nearest">
                <div class="input-group-append" data-target="#<?=$parametreler['id']?>-datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input id="<?=$parametreler['id']?>" type="text" class="form-control datetimepicker-input" data-target="#<?=$parametreler['id']?>-datetimepicker"
                    data-toggle="datetimepicker" value="<?= $parametreler['deger'] ?>" />

            </div>
        </div>
        <script>
        $('#<?=$parametreler['id']?>-datetimepicker').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            locale: moment.locale('tr'),
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        </script>
    <?php
}