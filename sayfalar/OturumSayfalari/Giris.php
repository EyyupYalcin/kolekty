<!DOCTYPE html>
<html lang="tr">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title><?php echo $baslik; ?> | Kolekty</title>
    <meta name="description" content="Kolekty Giriş Sayfası" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/dashboard/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15" style="display: none !important;">
                    <!--begin::Aside header-->
                    <div>
                        <!--begin::Logo-->
                        <a href="/">
                            <div class="textLogo max-h-30px text-center font-size-h1 text-warning"><b>K</b><i>olekty</i></div>
                            <?php /* <img alt="Logo" src="assets/dashboard/media/logos/logo-letter-9.png" class="max-h-30px" /> */ ?>
                        </a>
                        <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">
                            Slogan
                        </h3>
                        <!--end::Logo-->
                    </div>

                    <!--end::Aside header-->
                    <!--begin::Aside Title-->
                    
                    <!--end::Aside Title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(100% + 5rem); background-image: url(assets/dashboard/media/svg/giris_gorsel.svg); min-height: 425px !important; background-size: 100%;"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="login-content flex-row-fluid d-flex flex-column p-10">
                <!--begin::Top-->
                <div class="text-right d-flex justify-content-center">
                    <div class="top-signin text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                        <span class="font-weight-bold text-muted font-size-h6">Bir Sorun Mu Var?</span>
                        <a href="javascript:;" class="font-weight-bold text-primary font-size-h6 ml-2" id="kt_login_signup">Yardım Alın</a>
                    </div>
                </div>
                <!--end::Top-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-row-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form">
                        <!--begin::Form-->
                        <form class="form" id="kt_login_singin_form">
                            <!--begin::Title-->
                            <div class="pb-5 pb-lg-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Giriş Yap</h3>
                                <div class="text-muted font-weight-bold font-size-h4">
                                    Hâlâ Üye Değil misin?
                                    <a href="KayitOl" class="text-primary font-weight-bolder">Hesap Oluştur</a>
                                </div>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">E-posta</label>
                                <input id="email" class="form-control h-auto py-7 px-6 rounded-lg border-0" type="email" name="email" autocomplete="off" />
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Parola</label>
                                    <a id="sifremi_unuttum" href="#sifremi_unuttum" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Şifremi unuttum</a>
                                </div>
                                <input id="password" class="form-control h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" autocomplete="off" />
                            </div>
                            <!--end::Form group-->
                            <!--begin::Action-->
                            <div class="pb-lg-0 pb-5">
                                <button type="button" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Giriş Yap</button>
                                <!--
                                <button type="button" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
    <span class="svg-icon svg-icon-md">
        <!--begin::Svg Icon | path:assets/dashboard/media/svg/social-icons/google.svg ->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M19.9895 10.1871C19.9895 9.36767 19.9214 8.76973 19.7742 8.14966H10.1992V11.848H15.8195C15.7062 12.7671 15.0943 14.1512 13.7346 15.0813L13.7155 15.2051L16.7429 17.4969L16.9527 17.5174C18.879 15.7789 19.9895 13.221 19.9895 10.1871Z" fill="#4285F4" />
                                <path d="M10.1993 19.9313C12.9527 19.9313 15.2643 19.0454 16.9527 17.5174L13.7346 15.0813C12.8734 15.6682 11.7176 16.0779 10.1993 16.0779C7.50243 16.0779 5.21352 14.3395 4.39759 11.9366L4.27799 11.9466L1.13003 14.3273L1.08887 14.4391C2.76588 17.6945 6.21061 19.9313 10.1993 19.9313Z" fill="#34A853" />
                                <path d="M4.39748 11.9366C4.18219 11.3166 4.05759 10.6521 4.05759 9.96565C4.05759 9.27909 4.18219 8.61473 4.38615 7.99466L4.38045 7.8626L1.19304 5.44366L1.08875 5.49214C0.397576 6.84305 0.000976562 8.36008 0.000976562 9.96565C0.000976562 11.5712 0.397576 13.0882 1.08875 14.4391L4.39748 11.9366Z" fill="#FBBC05" />
                                <path d="M10.1993 3.85336C12.1142 3.85336 13.406 4.66168 14.1425 5.33717L17.0207 2.59107C15.253 0.985496 12.9527 0 10.1993 0C6.2106 0 2.76588 2.23672 1.08887 5.49214L4.38626 7.99466C5.21352 5.59183 7.50242 3.85336 10.1993 3.85336Z" fill="#EB4335" />
                            </svg>
                                    </span>Sign in with Google
                            </button>
                            <!--end::Svg Icon->
                                -->
                            </div>
                            <!--end::Action-->
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
    <!--end::Page Scripts-->
    <script>
        $(document).ready(function () {
            $('#kt_login_singin_form_submit_button').on('click', () => {
                var email = $('#email').val();
                var parola = $('#password').val();

                var form_data = new FormData();    
                form_data.append('email', email);
                form_data.append('parola', parola);

                $.ajax({
                url: 'API/Giris',
                data: form_data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    console.log(data);
                    if(data.durum == "Hata"){
                        swal.fire({
                            title: "Hata!",
                            text: data.mesaj,
                            icon: "error",
                            timer: 1337
                        });
                    }else if(data.durum == "Başarılı"){
                        swal.fire({
                            title: "Başarılı!",
                            text: data.mesaj,
                            icon: "success",
                            timer: 1337
                        }).then(function() {
                            window.location = "Anasayfa";
                        });
                    }
                }
                });
            })
        });

        $('#sifremi_unuttum').on('click', function(e){
            swal.fire({
                title: "Şifreni mi unuttun?",
                text: "Email adresini hatırlıyorsan sana bir parola yenileme bağlantısı göndereceğim",
                input: 'email',
                inputAttributes: {
                    autocapitalize: 'off',
                    placeholder: 'Email'
                },
                confirmButtonText: 'Gönder',
                preConfirm: (email) => {
                    var form_data = new FormData();    
                    form_data.append('email', email);
                    return $.ajax({
                        url: 'API/ParolamıUnuttum',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(data){
                            console.log(data);
                            if(data.durum == "Hata"){
                                swal.fire({
                                    title: "Hata!",
                                    text: data.mesaj,
                                    icon: "error",
                                    timer: 1337
                                });
                            }else if(data.durum == "Başarılı"){
                                swal.fire({
                                    title: "Başarılı!",
                                    text: data.mesaj,
                                    icon: "success",
                                    timer: 1337
                                })
                            }
                        }
                    });
                },
            })
        })
    </script>
</body>
<!--end::Body-->
</html>