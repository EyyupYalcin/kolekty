<?php
    function form_single_select_api($parametreler){
        ?>

    <div class="form-group">
        <label for="<?= $parametreler['id'] ?>"><?= $parametreler['etiket'] ?></label>
        <div class="input-group">
            <select id="<?= $parametreler['id'] ?>" class="form-control" onchange="<?= $parametreler['onchange'] ?>">
            </select>
            <script>
                function <?= $parametreler['id'] ?>Load(form_data = new FormData()){
                    $.ajax({
                        type: "POST",
                        url: "API/<?= $parametreler['API'] ?>",
                        data: form_data,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $('#<?= $parametreler['id'] ?>').html('');
                            data.forEach(row => {
                                $('#<?= $parametreler['id'] ?>').append(`<option value="${row.<?= $parametreler['ayristir']['value'] ?>}">${row.<?= $parametreler['ayristir']['text'] ?>}</option>`);
                            });
                            //$('#<?= $parametreler['id'] ?>').selectpicker();
                        }
                    });
                }
            </script>
        </div>
    </div>



        <?php
    }