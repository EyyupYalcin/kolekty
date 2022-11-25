<select id="rolSecici" class="form-control "> <!-- 'selectpicker' böyle bir class vardı silince tek select oldu. Bunu neden ekledik bilmiyorum bir yan etki olmazsa bu yorumu silin gitsin. -Yasir -->
    <?php
        $aktifRol = getAktifRol($kullanici['id']);
        $roller = getKullaniciRolleri($kullanici['id']);
        foreach($roller as $rol){
            if($aktifRol == $rol){
                ?>
                    <option value="<?= $rol ?>" selected><?= $rol ?></option>
                <?php
            }else{
                ?>
                    <option value="<?= $rol ?>"><?= $rol ?></option>
                <?php
            }
        }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('#rolSecici').on('change', (event) => {
            var rol_adi = event.target.value;

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