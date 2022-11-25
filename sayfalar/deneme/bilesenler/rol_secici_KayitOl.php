<select id="rolSecici" class="form-control selectpicker">
    <option value="">Kullanıcı Türü Seçin</option>
    <?php
        $roller = getRoller();
        foreach($roller as $rol){
            {
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
                    location.href = location.href;
                }else{
                    swal.fire("Bir hata meydana geldi")
                }
                console.log(data);
            }
            });
        })
    });
</script>