<?php
function form_time($parametreler)
{
    ?>
        <!-- Time -->
        <div class="form-group">
            <label><?=$parametreler['etiket']?>:</label>
            <div class="input-group date" id="<?= $parametreler['id'] ?>-datetimepicker" data-target-input="nearest">

                <div class="input-group-append" data-target="#<?= $parametreler['id'] ?>-datetimepicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                </div>
                <input id="<?= $parametreler['id'] ?>" type="text" class="form-control datetimepicker-input" data-target="#<?= $parametreler['id'] ?>-datetimepicker"
                    data-toggle="datetimepicker"  value="<?= $parametreler['deger'] ?>"/>
            </div>
        </div>

        <script>
        $('#<?=$parametreler['id']?>-datetimepicker').datetimepicker({
            format: 'H:m',
            locale: moment.locale('tr'),
        });
        </script>
    <?php
}