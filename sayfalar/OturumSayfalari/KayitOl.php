<!DOCTYPE html>
<html lang="tr">
<!--begin::Head-->
<head>

    <base href="<?= $kok_url ?>">
    <meta charset="utf-8" />
    <title><?= $baslik ?> | Kolekty</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/dashboard/css/pages/login/login-3.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/dashboard/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/dashboard/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/dashboard/media/logos/favicon.ico" />
    <script src="assets/lib/jquery/dist/jquery.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto">
                <!--begin::Aside Top-->
                <!-- <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">

                    <div>
                 
                        <a href="/">
                            <div class="textLogo max-h-30px text-center font-size-h1 text-warning"><b>K</b><i>olekty</i></div>
                            <?php /* <img alt="Logo" src="assets/dashboard/media/logos/logo-letter-9.png" class="max-h-30px" /> */ ?>
                        </a>
      
                    </div>
                </div> -->
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(100% + 5rem); background-image: url(assets/dashboard/media/svg/giris_gorsel.svg)"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="login-content flex-column-fluid d-flex flex-column p-10">
                <!--begin::Top-->
                <div class="text-right d-flex justify-content-center">
                    <div class="top-signup text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                        <span class="font-weight-bold text-muted font-size-h4">Bir Sorun Mu Var?</span>
                        <a href="javascript:;" class="font-weight-bolder text-primary font-size-h4 ml-2" id="kt_login_signup">Yardım Alın</a>
                    </div>
                </div>
                <!--end::Top-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-row-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-form-signup">
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_login_signup_form" method="post">
                            <!--begin: Wizard Step 1-->
                           
                                <!--begin::Title-->
                                <div class="pb-10 pb-lg-15">
                                    <h3 class="font-weight-bolder text-dark display5"></h3>
                                    <div class="text-muted font-weight-bold font-size-h4">
                                        Zaten hesabınız var mı ?
                                        <a href="/Giris" class="text-primary font-weight-bolder">Giriş Yap</a>
                                    </div>
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form Group-->
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Adınız</label>
                                            <input id="name" type="text" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="fname" placeholder="Adınız" value="" />
                                        </div>
                                    </div>
                                    <!--end::Form Group-->
                                    <!--begin::Form Group--><div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Soyadınız</label>
                                            <input id="surname" type="text" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="lname" placeholder="Soyadınız" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Telefon</label>
                                            <input id="phone" onfocus="this.value = '+90 '; this.onclick = () => {}" type="text" pattern="^[0-9]{3}[ |][0-9]{3}[ |][0-9]{2}[ |][0-9]{2}$" data-fv-regexp___message="Lütfen uygun bir numara girin" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="phone" placeholder="+90 999 999 99 99" value="" />
                                        </div>
                                    </div><div class="col-xl-6">
                                        <!--end::Form Group-->
                                        <!--begin::Form Group-->
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                            <input id="email" type="email" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="email" placeholder="Email" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Şehir</label>
                                            <select id="city" name="city" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6">
                                                <option value="">Seçiniz</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <!--end::Form Group-->
                                        <!--begin::Form Group-->
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Doğum Tarihi</label>
                                            <input id="birthday" type="date" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="birthday" placeholder="" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Şifre</label>
                                            <input id="password" type="password" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="password" placeholder="Şifre" value="" />
                                        </div>
                                    </div>
                                    <!--end::Form Group-->
                                    <!--begin::Form Group-->
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Şifre Tekrar</label>
                                            <input id="repassword" type="password" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" name="repassword" placeholder="Şifre Tekrar" value="" />
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="pb-lg-0 pb-5">
                                    <button type="button" id="kt_login_signup_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Kayıt Ol</button>
                                </div>

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/dashboard/plugins/global/plugins.bundle.js"></script>
    <script src="assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/dashboard/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/dashboard/js/pages/custom/login/login-3.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
    <script>
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "API/Sehir",
                dataType: "json",
                success: function (data) {
                    var cities = data;
                    cities.forEach(city => {
                        $('#city').append(`<option value="${city.il_id}">${city.il_adi}</option>`);
                    });
                }
            });

            $('#email').on('focusout', (e) => {
                var email = $('#email').val();
                var form_data = new FormData();
                form_data.append('email', email);
                $.ajax({
                    type: "POST",
                    url: "API/mailKontrol",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.durum == "Hata"){
                            swal({
                                title: "Hata!",
                                text: data.mesaj,
                                icon: "error",
                                button: "Tamam",
                            });
                        }

                    }
                });
            });

            $('#phone').on('focusout', (e) => {
                var phone = $('#phone').val();
                var form_data = new FormData();
                form_data.append('phone', phone);

                $.ajax({
                    type: "POST",
                    url: "API/telefonKontrol",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.durum == "Hata"){
                            swal({
                                title: "Hata!",
                                text: data.mesaj,
                                icon: "error",
                                button: "Tamam",
                            });
                        }

                    }
                });
            });

            $('#kt_login_signup_form_submit_button').on('click', () => {
                var isim = $('#name').val();
                var soyisim = $('#surname').val();
                var email = $('#email').val();
                var telefon = $('#phone').val();
                var sehir = $('#city').val();
                var dogum_tarihi = $('#birthday').val();
                var parola = $('#password').val();
                var parola_tekrar = $('#repassword').val();

                var form_data = new FormData();    
                form_data.append('isim', isim);
                form_data.append('soyisim', soyisim);
                form_data.append('email', email);
                form_data.append('telefon', telefon);
                form_data.append('sehir', sehir);
                form_data.append('dogum_tarihi', dogum_tarihi);
                form_data.append('parola', parola);
                form_data.append('parola_tekrar', parola_tekrar);
                $.ajax({
                    type: "POST",
                    url: "API/Hesap_Olustur",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                    if(data.durum == "Hata"){
                        swal({
                            title: "Hata!",
                            text: data.mesaj,
                            icon: "error",
                            timer: 1337
                        });
                    }else if(data.durum == "Başarılı"){
                        swal({
                            title: "Başarılı!",
                            text: data.mesaj,
                            icon: "success",
                            timer: 1337
                        }).then(function() {
                            swal({
                                text: 'Doğrulama Kodu:',
                                content: "input",
                                button: {
                                    text: "Aktifleştir!",
                                    closeModal: false,
                                },
                            })
                            .then(DogrulamaKodu => {
                                if (!DogrulamaKodu) throw null;
                                var form_data = new FormData();    
                                form_data.append('DogrulamaKodu', DogrulamaKodu);
                                return $.ajax({
                                    type: "POST",
                                    url: "API/EpostaDoğrula",
                                    data: form_data,
                                    processData: false,
                                    contentType: false,
                                    success: function (data) {
                                        if(data.durum == "Hata"){
                                            swal({
                                                title: "Hata!",
                                                text: data.mesaj,
                                                icon: "error",
                                                timer: 1337
                                            });
                                        }else if(data.durum == "Başarılı"){
                                            swal({
                                                title: "Başarılı!",
                                                text: data.mesaj,
                                                icon: "success",
                                                timer: 1337
                                            }).then(function() {
                                                if ('yonlendirme' in data) location.href = data.yonlendirme;
                                            });
                                        }
                                    }
                                });
                            })
                        });
                    }
                    }
                });
            })
        });
    </script>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>