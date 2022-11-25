<?php
    $Form_Eleman_ID_Listesi = [];
    function AjaxPostButton($parametreler){
        global $Form_Eleman_ID_Listesi;
        // echo "<pre>";
        // print_r($Form_Eleman_ID_Listesi);
        // echo "</pre>";
        ?>
            <button id="<?= $parametreler['id'] ?>" type="button" class="btn btn-block btn-success"><?= $parametreler['metin'] ?></button>
            <script>
                $(document).ready(function() {
                    $('#<?= $parametreler['id'] ?>').on('click', () => {
                        
                        var form_data = new FormData();
                        <?php 
                        $eleman_turu_listesi = array_keys($Form_Eleman_ID_Listesi);
                        foreach($eleman_turu_listesi as $eleman_turu){
                            foreach($Form_Eleman_ID_Listesi[$eleman_turu] as $eleman_id){
                                if($eleman_turu == "file"){
                                    ?>
                                    var <?= $eleman_id ?> = $('#<?= $eleman_id ?>')[0].files[0];
                                    form_data.append('<?= $eleman_id ?>', <?= $eleman_id ?>);
                                    <?php
                                }else if($eleman_turu == "money"){
                                    ?>
                                    var <?= $eleman_id ?> = $('#<?= $eleman_id ?>')[0].value.split('₺')[0];
                                    form_data.append('<?= $eleman_id ?>', <?= $eleman_id ?>);
                                    <?php
                                }else{
                                    ?>
                                    var <?= $eleman_id ?> = $('#<?= $eleman_id ?>').val();
                                    form_data.append('<?= $eleman_id ?>', <?= $eleman_id ?>);
                                    <?php
                                }
                            }
                        } ?>

                        $.ajax({
                            url: '<?= $parametreler['API'] ?>',
                            data: form_data,
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            success: function(data) {
                                if(data.durum == "Hata"){
                                    swal.fire({
                                        title: "Hata!",
                                        text: data.mesaj,
                                        icon: "error",
                                        timer: 1337
                                    });
                                }else if(data.durum == "Başarılı"){
                                    swal.fire({
                                        title: data.durum,
                                        text: data.mesaj,
                                        icon: "success",
                                        timer: 1337
                                    })
                                    .then(function() {
                                        if ('yonlendirme' in data) location.href = data.yonlendirme;
                                    });
                                }

                                console.log(data);
                            }
                        });
                    })
                });
            </script>
        <?php
    }
?>