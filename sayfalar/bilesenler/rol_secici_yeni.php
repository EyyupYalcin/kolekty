<div class="radio-list">
    <?php
        $aktifRol = getAktifRol($kullanici['id']);
        $roller = getKullaniciRolleri($kullanici['id']);
        foreach($roller as $rol){
            if($aktifRol == $rol){
                ?>
                    <label data-rol="<?= $rol ?>" class="radio radio-success rol_degistirici">
                        <input data-rol="<?= $rol ?>" type="radio" name="userrole" checked>
                        <span data-rol="<?= $rol ?>"></span><?= $rol ?>
                    </label>  
                    <!-- <button data-rol="<?= $rol ?>" class="btn btn-sm btn-light-secondary text-dark py-2 px-5 w-100 mb-2"><?= $rol ?></button> -->
                <?php
            }else{
                ?>
                    <label data-rol="<?= $rol ?>" class="radio radio-success rol_degistirici">
                        <input data-rol="<?= $rol ?>" type="radio" name="userrole">
                        <span data-rol="<?= $rol ?>"></span><?= $rol ?>
                    </label>
                    <!-- <button data-rol="<?= $rol ?>" class="rol_degistirici btn btn-sm btn-light-primary font-weight-bolder py-2 px-5 w-100 mb-2"><?= $rol ?></button> -->
                <?php
            }
        }
    ?>
</div>

<script>
    $(document).ready(function () {
        $('.rol_degistirici').on('click', (event) => {
            var rol_adi = event.target.dataset.rol;

            var form_data = new FormData();    
            form_data.append('rol_adi', rol_adi);

            $.ajax({
            url: 'API/RolDegistir',
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                if(data.durum == "Başarılı"){
                    location.reload();
                }else{
                    alert("Bir hata meydana geldi")
                }
                console.log(data);
            }
            });
        })
    });
</script>