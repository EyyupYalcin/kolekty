<?php include_once bilesen('basil_icon') ?>
<!DOCTYPE html>
<!--

Author: ??? , Ilknur & Eyyup
License: Kolekty

-->
<html dir="ltr" lang="tr"><!-- Soldan Sağa (left-to-right) > türkçe -->
<!--begin::Head-->
<head>
    <base href="<?= $kok_url ?>">
    <meta charset="utf-8" />
    <title><?php echo $baslik; ?> | Kolekty Apps</title>
    <meta name="description" content="<?= $aciklama ?>" />
    <!-- 
        Burada sayfa açıklaması bulunmalı 130- 160 karakter arasında olmalı içeriğe ilgi çekecek nitelik olmalıdır. 
        İçerik ile çelişmemesi önemlidir.
        
        Tekrarlayan açıklamalardan kaçının.
        Özgün açıklama metinleri yazın.
        Her sayfaya açıklma yazın
         -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <link rel="canonical" href="https://kolekty.com/" /> -->
    <!-- https://yoast.com/rel-canonical/#canonical-link-element Bu eleman yalnızca aynı içeriğe sahip iki farklı link olduğunda
    ve arama motouna birini tercih etmesi gerektiğini söylememiz gerektiğinde kullanılmalıdır. Amacı tekrarlayan içeriğin bir şekilde
    tıpkı makale yazarlarının diğerlerine atıfta bulunması gibi yasal bir yolunu oluşturmaktır. -->
    <!-- https://www.freecodecamp.org/news/what-is-open-graph-and-how-can-i-use-it-for-my-website/#what-is-open-graph -->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/dashboard/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all sayfalar)-->
    <link href="assets/dashboard/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/dashboard/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <link href="assets/dashboard/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all sayfalar)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/favicon.png" />
    <!--  -->
<script src="assets/dashboard/plugins/global/plugins.bundle.js"></script> <!-- head'e taşındı -->
<script src="assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="assets/dashboard/js/scripts.bundle.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- TinyMCE -->
    <script src="assets/lib/tinymce/tinymce.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->
<style>
    <?php //Chat modal açılıp kapandıkça script ile padding right değişiyor ve sayfayı bozuyordu böyle çözüm uydurdum ?>
    body{
        padding-right: 0px !important;
        background-color: #f2f2f2 !important;
    }

    .text-navbar-color {
        color:#2B3F87;
    }

    i.icon-36 svg{
        width: 36px;
        height: 36px;
    }

    .swal-button--confirm {
        background-color: #2B3F87;
    }

    .swal-button--confirm:hover {
        background-color: #3C53A7 !important;
    }
    /* .swal-wide{
        width: 600px !important;
    } */
</style>
<script>
    var calendar, randevun = null;
    var istemci_durumu = {
        "oturum_acik_mi": <?= oturumAcikMi() ? "true" : "false" ?>
    }

    function oturum_popup(){
        var OturumAcPopup = $('#OturumAcPopupTemplate').prop('content').firstElementChild.cloneNode(true);
        swal({
            content: OturumAcPopup,
            button: {
                text: "Oturum Aç!",
                closeModal: false,
            },
        }).then(swal_data => {
            if (!swal_data) throw null;
            var email = $('#email_popup').val();
            var parola = $('#password_popup').val();

            var form_data = new FormData();    
            form_data.append('email', email);
            form_data.append('parola', parola);

            return $.ajax({
                url: 'API/Giris',
                data: form_data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
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
                            window.location = window.location ;
                        });
                    }
                }
            });

        })
    }
    
    function hizmet_al_popup(elem){
        var HizmetAlPopup = $('#HizmetAlModal')[0] //$('#HizmetAlPopupTemplate').prop('content').firstElementChild.cloneNode(true);
        $('#HizmetAlModal').on('shown.bs.modal', function () {
            $('#HizmetAlModal .modal-content').hide()
            $('#HizmetAlModal .modal-content.step-1').show()
            $('#HizmetAlModal > script').each(function(index, item){
                eval($(item).text());
            });
        })
        var data_obj = {
            "HizmetID": $(elem).data('hizmet_id'),
            "HizmetAl_HizmetAdi": elem.dataset.hizmet_adi,
            "HizmetAl_HizmetSaglayiciAdi": elem.dataset.hizmet_saglayici_adi,
            "HizmetAl_HizmetAdi": elem.dataset.hizmet_adi,
            "HizmetAl_Tanitim": elem.dataset.hizmet_tanitim,
            "HizmetAl_HizmetSaglayiciKapatFotografi": elem.dataset.hizmet_saglayici_kapak_fotografi,
            "HizmetAl_Ucret": elem.dataset.ucret,
        }
        Object.keys(data_obj).forEach((key) => {
            HizmetAlPopup.innerHTML = HizmetAlPopup.innerHTML.replaceAll("--[" + key + "]--", data_obj[key]);
        });
        $('#HizmetAlModal').modal('show');
        // swal({
        //     content: HizmetAlPopup,
        //     button: {
        //         text: "Devam Et",
        //         closeModal: false,
        //     },
        // }).then(swal_data => {
        //     if (!swal_data) throw null;
        //     var email = $('#email_popup').val();
        //     var parola = $('#password_popup').val();

        //     var form_data = new FormData();    
        //     form_data.append('email', email);
        //     form_data.append('parola', parola);

        //     var HizmetAlPopup2 = $('#HizmetAlPopupTemplate2').prop('content').firstElementChild.cloneNode(true);

        //     swal({
        //         content: HizmetAlPopup2,
        //         button: {
        //             text: "Devam Et",
        //             closeModal: false,
        //         },
        //         className: "swal-wide",
        //     }).then(swal_data => {
        //         if (!swal_data) throw null;
        //         var randevun = null;
        //         calendar.getEvents().forEach(event => {
        //             if(event._def.title == "Randevun"){
        //                 randevun = event;
        //             }
        //         })
        //         console.log('randevun');
        //         console.log(randevun.start);
        //         var HizmetAlPopup3 = $('#HizmetAlPopupTemplate3').prop('content').firstElementChild.cloneNode(true);
        //         console.log(data_obj)
        //         data_obj["Randevu_Tarihi"] = moment(randevun.start).locale('tr').format("D.MM.YYYY");
        //         if(randevun.end == null){
        //             var enddate = randevun.start
        //             enddate.setHours( enddate.getHours() + 1 );
        //         }else{
        //             enddate = randevun.end
        //         }
        //         data_obj["Randevu_Saat_Araligi"] = moment(randevun.start).locale('tr').format("HH:mm") + "-" +moment(enddate).locale('tr').format("HH:mm");
        //         Object.keys(data_obj).forEach((key) => {
        //             HizmetAlPopup3.innerHTML = HizmetAlPopup3.innerHTML.replaceAll("--[" + key + "]--", data_obj[key]);
        //         });
      
            
        //         swal({
        //             content: HizmetAlPopup3,
        //             button: {
        //                 text: "Devam Et",
        //                 closeModal: false,
        //             },
        //         })
        //     })

        // })
    }

    function hizmet_saglayici_ol_popup(){
        var HizmetSaglayiciOlPopup = $('#HizmetSaglayiciOlTemplate').prop('content').firstElementChild.cloneNode(true);
        swal({
            content: HizmetSaglayiciOlPopup,
            button: {
                text: "Yeni Hizmet Oluştur!",
                closeModal: false,
            },
        }).then(swal_data => {
            if (!swal_data) throw null;
            var hizmet_saglayici_adi = $('#hizmet_saglayici_adi').val();
            var hizmet_id = $('#hizmet_id').val();

            var form_data = new FormData();    
            form_data.append('hizmet_saglayici_adi', hizmet_saglayici_adi);
            form_data.append('hizmet_id', hizmet_id);

            return $.ajax({
                url: 'API/Hizmet_Saglayici_Ol',
                data: form_data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
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
                            window.location = data.yonlendirme ;
                        });
                    }
                }
            });
        })
    }
</script>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    <div id="gorunmez_alan" style="display: none;"></div>

    <template id="OturumAcPopupTemplate" style="display: none;">
        <div style="padding: 5% 10%;">
            <div class="pb-5 pb-lg-15">
                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Giriş Yap</h3>
                <div class="text-muted font-weight-bold font-size-h4">
                    Hâlâ Üye Değil misin?
                    <a href="KayitOl" class="text-primary font-weight-bolder">Hesap Oluştur</a>
                </div>
            </div>
  
            <div class="form-group" style="text-align: left;">
                <label class="font-size-h6 font-weight-bolder text-dark">E-posta</label>
                <input id="email_popup" type="email" name="email" autocomplete="off" class="form-control h-auto py-4 px-2">
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-between mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Parola</label>
                    <a href="/Giris" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Şifremi unuttum</a>
                </div>
                <input id="password_popup" type="password" name="password" autocomplete="off" class="form-control h-auto py-4 px-2">
            </div>
        </div>
    </template>

    <!--begin::Modal-->
    <div class="modal fade" id="HizmetAlModal" tabindex="-1" role="dialog" aria-labelledby="HizmetAlModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <!-- Modal content as step by step like tabs -->
            <div class="modal-content step-1">
                <!-- <div class="modal-header">
                    <h4 class="modal-title">Randevu Al</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="padding: 1vw;">
                                    <div class="pb-5 pb-lg-15">
                                        <h3 class="font-weight-bolder text-navbar-color font-size-h2 font-size-h1-lg">Randevu Al</h3>
                                        <div class="text-muted font-weight-bold font-size-h4 text-left">
                                            Görüntülü konuşma hakkında bilgilendirme metni.
                                        </div>
                                    </div>
                        
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                            <div class="symbol symbol-50 symbol-lg-120">
                                                <img src="--[HizmetAl_HizmetSaglayiciKapatFotografi]--" alt="image">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-left">
                                            <div class="d-flex justify-content-between flex-wrap mt-1">
                                                <div class="d-flex mr-3">
                                                    <a class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">--[HizmetAl_HizmetAdi]--</a>
                                                    <!-- <a href="#">
                                                        <i class="flaticon2-correct text-success font-size-h5"></i>
                                                    </a> -->
                                                </div>
                                            </div>

                                            <div class="d-flex flex-wrap justify-content-between mt-1">
                                                <div class="d-flex flex-column flex-grow-1 pr-8">
                                                    <div class="d-flex flex-wrap mb-4">
                                                        <a href="/Profil/1" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>--[HizmetAl_HizmetSaglayiciAdi]--</a>
                                                        <a href="/Profil/1" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                        <i class="mr-2 font-size-lg"></i><span id="ucret">--[HizmetAl_Ucret]--</span>₺</a>
                                                    </div>
               
                                                    
                                                    <!-- <span class="font-weight-bold text-dark-50 kisa_metin"><p>--[HizmetAl_Tanitim]--</p></span> -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: -2rem;" id="next-btn" data-to="step-2">Devam Et</button>
                    </div>
                </div>
            </div>
            <div class="modal-content step-2" style="display: none;">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="padding: 1vw;">
                                    <div class="pb-5 pb-lg-15">
                                        <h3 class="font-weight-bolder text-navbar-color font-size-h2 font-size-h1-lg">Randevu Al</h3>
                                        <div class="text-muted font-weight-bold font-size-h4 text-left">
                                            Lütfen randevunuz için tarih seçimi yapın
                                        </div>
                                    </div>
                        

                                    <div class="card card-custom">
                                        <div class="card-body">
                                            <div id="kt_calendar"></div>
                                        </div>
                                    </div>

                                    <script>
                                        var calendarEl = document.getElementById('kt_calendar');
                                        randevun=null;
                                        calendarEl.innerHTML = '';
                                        calendar = new FullCalendar.Calendar(calendarEl, {
                                            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar' ],
                                            locale: "tr",
                                            header: {
                                                center: 'prev,next today',
                                                right:""
                                            },

                                            displayEventTime: true, // don't show the time column in list view

                                            height: 400,
                                            contentHeight: 380,
                                            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                                            defaultView: 'timeGridDay',
                                            
                                            selectable: true,
                                            
                                            editable: true,
                                            // eventLimit: true, // allow "more" link when too many events
                                            // navLinks: true,

                                            businessHours: [ // specify an array instead
                                                {
                                                    daysOfWeek: [ 1, 2, 3, 4, 5 ],
                                                    startTime: '08:00',
                                                    endTime: '17:00'
                                                },
                                                {
                                                    daysOfWeek: [ 0, 6 ],
                                                    startTime: '10:00',
                                                    endTime: '16:00'
                                                }
                                            ],

                                            // THIS KEY WON'T WORK IN PRODUCTION!!!
                                            // To make your own Google API key, follow the directions here:
                                            // http://fullcalendar.io/docs/google_calendar/
                                            //googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

                                            // US Holidays
                                            //events: 'en.usa#holiday@group.v.calendar.google.com',

                                            eventClick: function(event) {
                                                // opens events in a popup window
                                                //window.open(event.url, 'gcalevent', 'width=700,height=600');
                                                console.log(event);
                                                event.event.remove();
                                                return false;
                                            },

                                            

                                            dateClick: function(info) {
                                                console.log(info);
                                                console.log(info.jsEvent);
                                                console.log(info.view);
                                                info.title = "Randevun";
                                                calendar.getEvents().forEach(event => {
                                                    if(event._def.title == "Randevun"){
                                                        event.remove()
                                                    }
                                                })
                                                calendar.addEvent(info);
                                            },

                                            loading: function(bool) {
                                                return;

                                                /*
                                                KTApp.block(portlet.getSelf(), {
                                                    type: 'loader',
                                                    state: 'success',
                                                    message: 'Please wait...'
                                                });
                                                */
                                            },

                                            eventRender: function(info) {
                                                var element = $(info.el);

                                                if (info.event.extendedProps && info.event.extendedProps.description) {
                                                    if (element.hasClass('fc-day-grid-event')) {
                                                        element.data('content', info.event.extendedProps.description);
                                                        element.data('placement', 'top');
                                                        KTApp.initPopover(element);
                                                    } else if (element.hasClass('fc-time-grid-event')) {
                                                        element.find('.fc-title').append('&lt;div class="fc-description"&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                                                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                                        element.find('.fc-list-item-title').append('&lt;div class="fc-description"&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                                                    }
                                                }
                                            }

                                        });

                                        calendar.render();
                                        
                                    </script>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-left" style="margin-left: -2rem;" id="prev-btn" data-to="step-1">Geri Dön</button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: -2rem;" id="next-btn" data-to="step-3">Devam Et</button>
                    </div>
                </div>
            </div>
            <div class="modal-content step-3" style="display: none;">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="padding: 1vw;">
                                    <div class="pb-5 pb-lg-10">
                                        <h3 class="font-weight-bolder text-navbar-color font-size-h2 font-size-h1-lg">Randevu Al</h3>
                                    </div>

                                    <div class=" text-left">
                                        <h6 class="text-navbar-color">Randevu Bilgileri</h6>
                                    </div>
                                    <div class="text-left">
                                        <a class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="mr-2 text-navbar-color font-size-lg">
                                                <?= basil_icon("Outline", "Communication", "User"); ?>
                                            </i><span id="HizmetAl_HizmetSaglayiciAdi">--[HizmetAl_HizmetSaglayiciAdi]--</span>
                                        </a>
                                    </div>
                                    <div class="text-left">
                                        <a class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="mr-2 text-navbar-color font-size-lg">
                                                <?= basil_icon("Outline", "General", "Calendar"); ?>
                                            </i><span id="Randevu_Tarihi">--[Randevu_Tarihi]--</span>
                                        </a>
                                    </div>
                                    <div class="text-left">
                                        <a  class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="mr-2 text-navbar-color font-size-lg">
                                                <?= basil_icon("Outline", "General", "Clock"); ?>
                                            </i><span id="Randevu_Saat_Araligi">--[Randevu_Saat_Araligi]--</span>
                                        </a>
                                    </div>
                                    <!-- <div class="text-left">
                                        <a  class="text-success mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            Tarihi Güncelle
                                        </a>
                                    </div> -->
                                    <div class="mt-6 text-left">
                                        <h6 class="text-navbar-color">Görüntülü Konuşma Linkinin Gönderileceği Adres</h6>
                                    </div>
                                    <div class="text-left">
                                        <a  class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="mr-2 text-navbar-color font-size-lg">
                                                <?= basil_icon("Outline", "Communication", "Send"); ?>
                                            </i><?php if(oturumAcikMi()){ echo $kullanici['email']; } ?>
                                        </a>
                                    </div>
                                    <!-- <div class="text-left">
                                        <a  class="text-success mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            Adresimi Güncelle
                                        </a>
                                    </div> -->
                                    <div class="mt-6 text-left">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Randevu Bilgilerimi Onaylıyorum
                                            </label>
                                        </div>
                                    </div>
                                    <script>
                                        if(calendar != null){
                                            calendar.getEvents().forEach(event => {
                                                if(event._def.title == "Randevun"){
                                                    randevun = event
                                                }
                                            })
                                        }
                                        if(randevun != null){
                                            var HizmetAlPopup3 = $('#HizmetAlModal .modal-content.step-3 .row')[0]
                                            data_obj["Randevu_Tarihi"] = moment(randevun.start).locale('tr').format("D.MM.YYYY");
                                            if(randevun.end == null){
                                                var enddate = randevun.start
                                                enddate.setHours( enddate.getHours() + 1 );
                                            }else{
                                                enddate = randevun.end
                                            }
                                            data_obj["Randevu_Saat_Araligi"] = moment(randevun.start).locale('tr').format("HH:mm") + "-" +moment(enddate).locale('tr').format("HH:mm");
                                            
                                            Object.keys(data_obj).forEach((key) => {
                                                HizmetAlPopup3.innerHTML = HizmetAlPopup3.innerHTML.replaceAll("--[" + key + "]--", data_obj[key]);
                                            });
                                            $('#HizmetAlModal .modal-content.step-3 #Randevu_Saat_Araligi').html(data_obj["Randevu_Saat_Araligi"]);
                                            $('#HizmetAlModal .modal-content.step-3 #Randevu_Tarihi').html(data_obj["Randevu_Tarihi"]);   
                                        }else{
                                            $('#HizmetAlModal .modal-content.step-3 #Randevu_Saat_Araligi').html("<span class='text-danger'>Saat Aralığı Belirtilmedi</span>");
                                            $('#HizmetAlModal .modal-content.step-3 #Randevu_Tarihi').html("<span class='text-danger'>Tarih Belirtilmedi</span>");
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary float-left" style="margin-left: -2rem;" id="prev-btn" data-to="step-2">Geri Dön</button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: -2rem;" id="submit-data">Gönder</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#next-btn, #prev-btn').click(function() {
                var to = $(this).data('to');
                $('.modal-content').hide();
                $('.modal-content.' + to).show();
                $('.modal-content.' + to +' script').each(function() {
                    eval($(this).text());
                });
            });
            $('#submit-data').click(function() {
                console.log(data_obj)
                if(data_obj.Randevu_Tarihi == null || data_obj.Randevu_Saat_Araligi == null){
                    alert("Randevu Tarihi ve Saat Aralığı Belirtilmelidir.")
                }else{
                    data_obj["islem"] = "randevu_al";
                    $.ajax({
                        type: "POST",
                        url: "/API/SiparisKaydet",
                        data: data_obj,
                        success: function (response) {
                            console.log(response)
                            if(response.durum == "Başarılı"){
                                swal({
                                    title: "Randevu Alındı",
                                    text: "Randevu Bilgileriniz Kaydedildi.",
                                    icon: "success",
                                    button: "Tamam",
                                })
                                $('#HizmetAlModal').modal('hide');
                            }else{
                                swal({
                                    title: "Randevu Alınamadı",
                                    text: "Randevu Bilgileriniz Kaydedilemedi. Lütfen Daha Sonra Tekrar Deneyiniz!",
                                    icon: "error",
                                    button: "Tamam",
                                })
                            }
                        }
                    });
                }

            });
        </script>
    </div>
    <!--end::Modal-->



    <template id="HizmetAlPopupTemplate" style="display: none;">
        <div style="padding: 1vw;">
            <div class="pb-5 pb-lg-15">
                <h3 class="font-weight-bolder text-navbar-color font-size-h2 font-size-h1-lg">Randevu Al</h3>
                <div class="text-muted font-weight-bold font-size-h4 text-left">
                    Görüntülü konuşma hakkında bilgilendirme metni.
                </div>
            </div>
  
            <div class="d-flex">
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img src="--[HizmetAl_HizmetSaglayiciKapatFotografi]--" alt="image">
                    </div>
                </div>
                <div class="flex-grow-1 text-left">
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">--[HizmetAl_HizmetAdi]--</a>
                            <!-- <a href="#">
                                <i class="flaticon2-correct text-success font-size-h5"></i>
                            </a> -->
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="/Profil/1" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>--[HizmetAl_HizmetSaglayiciAdi]--</a>
                            </div>
                            <!-- <span class="font-weight-bold text-dark-50 kisa_metin"><p>--[HizmetAl_Tanitim]--</p></span> -->
                        </div>
                    </div>
                </div>
            </div>

   
        </div>
    </template>

    <template id="HizmetAlPopupTemplate2" style="display: none;">
        <div style="padding: 1vw;">
            <div class="pb-5 pb-lg-15">
                <h3 class="font-weight-bolder text-navbar-color font-size-h2 font-size-h1-lg">Randevu Al</h3>
                <div class="text-muted font-weight-bold font-size-h4 text-left">
                    Lütfen randevunuz için tarih seçimi yapın
                </div>
            </div>
  

            <div class="card card-custom">
                <div class="card-body">
                    <div id="kt_calendar"></div>
                </div>
            </div>

            <script>
                var calendarEl = document.getElementById('kt_calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar' ],
                    locale: "tr",
                    header: {
                        center: 'prev,next today',
                        right:""
                    },

                    displayEventTime: true, // don't show the time column in list view

                    height: 400,
                    contentHeight: 380,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    defaultView: 'timeGridDay',
                    
                    selectable: true,
                    
                    editable: true,
                    // eventLimit: true, // allow "more" link when too many events
                    // navLinks: true,

                    businessHours: [ // specify an array instead
                        {
                            daysOfWeek: [ 1, 2, 3, 4, 5 ],
                            startTime: '08:00',
                            endTime: '17:00'
                        },
                        {
                            daysOfWeek: [ 0, 6 ],
                            startTime: '10:00',
                            endTime: '16:00'
                        }
                    ],

                    // THIS KEY WON'T WORK IN PRODUCTION!!!
                    // To make your own Google API key, follow the directions here:
                    // http://fullcalendar.io/docs/google_calendar/
                    //googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

                    // US Holidays
                    //events: 'en.usa#holiday@group.v.calendar.google.com',

                    eventClick: function(event) {
                        // opens events in a popup window
                        //window.open(event.url, 'gcalevent', 'width=700,height=600');
                        console.log(event);
                        event.event.remove();
                        return false;
                    },

                    dateClick: function(info) {
                        console.log(info);
                        console.log(info.jsEvent);
                        console.log(info.view);
                        info.title = "Randevun";
                        calendar.getEvents().forEach(event => {
                            if(event._def.title == "Randevun"){
                                event.remove()
                            }
                        })
                        calendar.addEvent(info);
                        // var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                        // var date = new Date(dateStr + 'T00:00:00'); // will be in local time

                        // if (!isNaN(date.valueOf())) { // valid?
                        //     calendar.addEvent({
                        //         title: 'dynamic event',
                        //         start: date,
                        //         allDay: true
                        //     });
                        //     alert('Great. Now, update your database...');
                        // } else {
                        //     alert('Invalid date.');
                        // }
        
                    },

                    loading: function(bool) {
                        return;

                        /*
                        KTApp.block(portlet.getSelf(), {
                            type: 'loader',
                            state: 'success',
                            message: 'Please wait...'
                        });
                        */
                    },

                    eventRender: function(info) {
                        var element = $(info.el);

                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('&lt;div class="fc-description"&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('&lt;div class="fc-description"&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                            }
                        }
                    }
                });

                calendar.render();
                        
            </script>

   
        </div>
    </template>

    <template id="HizmetAlPopupTemplate3" style="display: none;">
        <div style="padding: 1vw;">
            <div class="pb-5 pb-lg-10">
                <h3 class="font-weight-bolder text-navbar-color font-size-h2 font-size-h1-lg">Randevu Al</h3>
            </div>

            <div class=" text-left">
                <h6 class="text-navbar-color">Randevu Bilgileri</h6>
            </div>
            <div class="text-left">
                <a class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="mr-2 text-navbar-color font-size-lg">
                        <?= basil_icon("Outline", "Communication", "User"); ?>
                    </i>--[HizmetAl_HizmetSaglayiciAdi]--
                </a>
            </div>
            <div class="text-left">
                <a class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="mr-2 text-navbar-color font-size-lg">
                        <?= basil_icon("Outline", "General", "Calendar"); ?>
                    </i>--[Randevu_Tarihi]--
                </a>
            </div>
            <div class="text-left">
                <a  class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="mr-2 text-navbar-color font-size-lg">
                        <?= basil_icon("Outline", "General", "Clock"); ?>
                    </i>--[Randevu_Saat_Araligi]--
                </a>
            </div>
            <!-- <div class="text-left">
                <a  class="text-success mr-lg-8 mr-5 mb-lg-0 mb-2">
                    Tarihi Güncelle
                </a>
            </div> -->
            <div class="mt-6 text-left">
                <h6 class="text-navbar-color">Görüntülü Konuşma Linkinin Gönderileceği Adres</h6>
            </div>
            <div class="text-left">
                <a  class="text-dark mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="mr-2 text-navbar-color font-size-lg">
                        <?= basil_icon("Outline", "Communication", "Send"); ?>
                    </i><?php if(oturumAcikMi()){ echo $kullanici['email']; } ?>
                </a>
            </div>
            <!-- <div class="text-left">
                <a  class="text-success mr-lg-8 mr-5 mb-lg-0 mb-2">
                    Adresimi Güncelle
                </a>
            </div> -->
            <div class="mt-6 text-left">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Randevu Bilgilerimi Onaylıyorum
                    </label>
                </div>
            </div>

        </div>
    </template>

    <template id="HizmetSaglayiciOlTemplate" style="display: none;">
        <div style="padding: 5% 10%;">
            <div class="pb-5 pb-lg-15">
                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Hizmetin için ilan oluştur</h3>
            </div>
  
            <div class="form-group" style="text-align: left;">
                <label class="font-size-h6 font-weight-bolder text-dark">Hizmet Adı</label>
                <input id="hizmet_saglayici_adi" type="text" name="text" autocomplete="off" class="form-control h-auto py-4 px-2">
            </div>

            <div class="form-group" style="text-align: left;">
                <label class="font-size-h6 font-weight-bolder text-dark">Hizmet Kategorisi</label>
                <?php include bilesen('hizmetler_select'); hizmetler_select('hizmet_id'); ?>
            </div>
        </div>
    </template>

    <?php include(sablonBileseni('MobilUst')); ?>

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <?php include(sablonBileseni('SayfaUst')); ?>

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <?php include(sablonBileseni('AnasayfaArama')); ?>

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            
                            <?php include(sayfa($sayfa)); ?>

                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <?php include(sablonBileseni('SayfaAlt')); ?>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    <?php include(sablonBileseni('KullaniciPaneli')); ?>

    <?php include(sablonBileseni('HizliPanel')); ?>

    <?php include(sablonBileseni('Sohbet')); ?>

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/dashboard/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->

    <?php include(sablonBileseni('Scripts')); ?>

</body>
<!--end::Body-->
</html>