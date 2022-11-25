<?php include bilesen('hizmet_saglayici_list_element');?>
<style>
  .profil_resmi {
    position: relative;
    width: 30px;
    height: 30px;
  }
  .plus_icon {
    display: none;
    width: 30px;
    height: 30px;
    border-radius: 15px;
    text-align: center;
    padding: 7.5px;
    color: white;
    cursor: pointer;
    font-size: 15px;
    line-height: 15px;
  }
  .plus_icon i {
    color: white;
  }
  .profil_resmi:hover .plus_icon {
    display: block;
    position: absolute;
    right: -12px;
    top: -12px;
  }
</style>
<div class="d-flex flex-column-fluid">
  <!--begin::Container-->
  <div class=""><?php // container class'ı sildim çünkü yatay padding'den dolayı hizza bozuluyordu ?>
    <!--begin::Profile Overview-->
    <div class="d-flex flex-row">
      <!--begin::Aside-->
      <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
        <!--begin::Profile Card-->
        <div class="card card-custom card-stretch">
          <!--begin::Body-->
          <div class="card-body pt-4">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end">
              <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon">
                  <i class="ki ki-bold-more-ver"> </i>
                </a>
              </div>
            </div>
            <!--end::Toolbar-->
            <!--begin::User-->
            <div class="d-flex align-items-center">
              <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                <input type="file" id="imgupload" style="display: none;" />
                <div class="profil_resmi symbol-label" style="background-image:url('<?=$kullanici['profil_resmi'] != null ? $kullanici['profil_resmi'] : 'assets/dashboard/media/users/default.jpg'?>">
                  <span class="plus_icon bg-success text-white">
                    <i class="fas fa-plus"></i>
                  </span>
                </div>
              </div>
              <div>
                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?=$kullanici['isim'] . " " . $kullanici['soyisim']?></a>
                <div class="text-muted"><?=$kullanici['unvan']?></div>
              </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class="font-weight-bold mr-2">Hakkında</h4>
              </div>
              <div id="hakkinda_metni">
                <?=$kullanici['hakkinda']?>
              </div>
            </div>
            <!--end::Contact-->
            <!--begin::Contact-->
            <div class="py-9">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Email:</span>
                <a href="#" class="text-muted text-hover-primary"><?=$kullanici['email']?></a>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Telefon:</span>
                <span class="text-muted"><?=$kullanici['telefon']?></span>
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <span class="font-weight-bold mr-2">Konum:</span>
                <?php include_once 'Servisler/Adres_sehir.php'; $konum = get_adres_sehir_By_il_id($kullanici['adres_id']);?>
                <span class="text-muted"><?= $konum['il_adi'] ?></span>
              </div>
            </div>
            <!--end::Contact-->
            <!--begin::Nav-->
            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
              <div class="navi-item mb-2">
                <a href="/Profil/Ayarlar/<?= $kullanici['id'] ?>" class="navi-link" style="padding-left: 0;">
                  <span class="navi-icon mr-2">
                    <i class="fa fa-cog"></i>
                  </span>
                  <span class="navi-text font-size-lg">Ayarlar</span>
                </a>
              </div>
              <div class="navi-item mb-2">
                <a href="/Profil/Siparisler/<?= $kullanici['id'] ?>" class="navi-link" style="padding-left: 0;">
                  <span class="navi-icon mr-2">
                    <i class="fas fa-list"></i>
                  </span>
                  <span class="navi-text font-size-lg">Siparişlerim</span>
                </a>
              </div>
              <div class="navi-item mb-2">
                <a href="" class="navi-link" style="padding-left: 0;">
                  <span class="navi-icon mr-2">
                    <i class="fas fa-calendar-alt"></i>
                  </span>
                  <span class="navi-text font-size-lg">Takvimim</span>
                </a>
              </div>
            </div>
            <!--end::Nav-->
          </div>
          <!--end::Body-->
        </div>
        <!--end::Profile Card-->
      </div>
      <!--end::Aside-->
      <!--begin::Content-->
      <div class="flex-row-fluid ml-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-custom card-stretch gutter-b">
              <!--begin::Header-->
              <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Takvim</h3>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body pt-2" style="min-height: 200px;">
            
            
                  <div class="card-body">
                    <div id="kt_calendar"></div>
                  </div>
                  </div>
      
              <!--end::Body-->
            </div>
          </div>
        </div>
        <!--end::Advance Table Widget 7-->
        <!--begin::Row-->
        <!--end::Row-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Profile Overview-->
  </div>
  <!--end::Container-->
</div>
<script>
  $(".profil_resmi .plus_icon").click(function () {
    $("#imgupload").trigger("click");
  });
  $("#imgupload").change(function (e) {
    var form_data = new FormData();
    var profil_resmi = e.target.files[0];
    form_data.append("profil_resmi", profil_resmi);
    $.ajax({
      url: "API/ProfilResmiYükle",
      data: form_data,
      processData: false,
      contentType: false,
      type: "POST",
      success: function (data) {
        if (data.durum == "Hata") {
          swal.fire({
            title: "Hata!",
            text: data.mesaj,
            icon: "error",
            timer: 1337,
          });
        } else if (data.durum == "Başarılı") {
          location.href = location.href;
        }
        console.log(data);
      },
    });
  });
  var KTCalendarBasic = function() {
return {
    //main function to initiate the module
    init: function() {
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
        var calendarEl = document.getElementById('kt_calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: "tr",
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            themeSystem: 'bootstrap',
            isRTL: KTUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo
            views: {
                dayGridMonth: { buttonText: 'Ay' },
                timeGridWeek: { buttonText: 'Hafta' },
                timeGridDay: { buttonText: 'Gün' }
            },
            defaultView: 'dayGridMonth',
            defaultDate: TODAY,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events: [
                {
                    title: 'Tüm gün etkinliği',
                    start: YM + '-01',
                    description: 'XYZ işi yapılacak',
                    className: "fc-event-danger fc-event-solid-warning"
                },
                {
                    title: 'Raporlama',
                    start: YM + '-14T13:30:00',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    end: YM + '-14',
                    className: "fc-event-success"
                }
            ],
            eventRender: function(info) {
                var element = $(info.el);
                if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', info.event.extendedProps.description);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    }
                }
            },
            viewDidMount: function(info){
              alert();
            }
        });
        calendar.render();
        $('.fc-today-button').text('Bugün')
    }
};
}();
jQuery(document).ready(function() {
KTCalendarBasic.init();
});
</script>
