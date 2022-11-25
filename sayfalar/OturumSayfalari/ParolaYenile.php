<?php if($token_dogru){
  ?>
    <div class="card">
      <form class="form">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label text-alert">Yeni Parola</label>
            <div class="col-xl">
              <input id="password" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Yeni Parola" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label text-alert">Parolayı Doğrulayınız!</label>
            <div class="col-xl">
              <input id="repassword" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Parolayı Doğrulayınız!" />
            </div>
          </div>
        </div>
        <button id="parola_guncelle" type="button" class="swal-button swal-button--confirm float-right mr-2 mb-2">Kaydet</button>
        <script>
            $("#parola_guncelle").on('click', function (e) {
              var form_data = new FormData();
              var password_token = "<?= $_GET['parola_yenileme_kodu'] ?>"
              var password = $('#password').val()
              var repassword = $('#repassword').val()
              if(password != repassword){
                  swal.fire({
                    title: "Hata!",
                    text: "Girdiğiniz Parolalar Eşleşmemektedir.",
                    icon: "error",
                    timer: 1337,
                  });
                  return false;
              }
              form_data.append("password_token", password_token);
              form_data.append("password", password);
              form_data.append("repassword", repassword);

              $.ajax({
                url: "API/ParolaYenile",
                data: form_data,
                processData: false,
                contentType: false,
                type: "POST",
                success: function (data) {
                  if (data.durum == "Hata") {
                    swal({
                      title: "Hata!",
                      text: data.mesaj,
                      icon: "error",
                      timer: 1337,
                    });
                  } else if (data.durum == "Başarılı") {
                    swal({
                      title: "Başarılı!",
                      text: data.mesaj,
                      icon: "success",
                      timer: 1337,
                    }).then(function () {
                      window.location.href = "Giris";
                    });
                  }

                  console.log(data);
                },
              });
            });
        </script>
      </form>
    </div>
  <?php
}else{
  ?>
    <div class="card">
        <div class="card-body">
          Parola Yenileme Bağlantınızın Son Kullanım Tarihi Geçmiş
        </div>
    </div>
  <?php
} ?>
