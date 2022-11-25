<?php include bilesen('hizmet_saglayici_list_element'); ?>
<?php include bilesen('profil_card'); ?>
<?php $profil_kullanici = getKullaniciSessionByID($_GET['kullanici_id']) ?>
<?php $hizmet_bilgileri = get_hizmet_saglayicilar_where(" kullanici_id = $profil_kullanici[id] AND onaylayan_kullanici != 0"); ?>

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
  <div class=""> <?php // container class'ı sildim çünkü yatay padding'den dolayı hizza bozuluyordu ?>
      <?= profil_card($profil_kullanici) ?>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-custom card-stretch gutter-b">
              <!--begin::Header-->
              <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Yaptığı Değerlendirmeler</h3>
                <div class="card-toolbar"></div>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body pt-2" style="min-height: 200px;"></div>
              <!--end::Body-->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-custom card-stretch gutter-b">
              <!--begin::Header-->
              <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Sağladığı Hizmetler</h3>
                <div class="card-toolbar"></div>
              </div>
              <!--end::Header-->
              <style>
              .kisa_metin{
                  margin: 0;
                  padding: 0;
                  overflow: hidden;
                  text-overflow: ellipsis;
                  display: -webkit-box;
                  -webkit-line-clamp: 2;
                  -webkit-box-orient: vertical;
                  height: 50px;
              }

              .carousel_item .gutter-b {
                margin-bottom: 0;
              }

              .carousel_item .card {
                /* -webkit-box-shadow: unset !important;
                box-shadow: unset !important; */
                border: 0;
              }

              .left-arrow {
                position: absolute;
                top: 0;
                left: 1rem;
                z-index: 9;
                height: 200px;
                display: flex;
                flex-direction: column;
                justify-content: center;

              }

              .right-arrow {
                position: absolute;
                top: 0;
                right: 1rem;
                z-index: 9;
                height: 200px;
                display: flex;
                flex-direction: column;
                justify-content: center;
              }
              </style>
              <div class="card-body pt-2 pb-2  position-relative" >
                <?php 
                if(count($hizmet_bilgileri) > 1){
                  ?>
                    <div class="left-arrow">
                      <button data-carousel-left class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success">
                        <i class="fas fa-angle-left"></i>
                      </button>
                    </div>

                    <div class="right-arrow">
                      <button data-carousel-right class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success">
                        <i class="fas fa-angle-right"></i>
                      </button>
                    </div>
                  <?php
                }
                ?>

                <div class="d-flex flex-column flex-wrap overflow-hidden carousel_area" style="height: 200px;">



                  <?php include_once bilesen('hizmet_saglayici_list_element'); ?>
                  <?php 
                  foreach ($hizmet_bilgileri as $key => $hizmet) {
                    ?>
                      <div class="carousel_item w-100">
                          <?= hizmet_saglayici_list_element("sad", $hizmet) ?>
                      </div>
                    <?php
                  }
                  ?>
                </div>
                <script>
                    function convertRemToPixels(rem) {    
                        return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
                    }

                    

                    $('button[data-carousel-left=""]').on('click', function(event){
                      let active_carousel = $('.carousel_item.active');
                      active_carousel.removeClass('active');
               
                      if(active_carousel.prev().length !== 0){
                        active_carousel.prev().addClass('active');
               
          
                        active_carousel.parent()[0].scroll({
                          left: active_carousel.prev()[0].offsetLeft - convertRemToPixels(2.25),
                          behavior: "smooth"
                        });
                      }else{
                        $('.carousel_item:last').addClass('active')
                        $('.carousel_item:last').parent()[0].scroll({
                          left: $('.carousel_item:last').offset().left - convertRemToPixels(2.25),
                          behavior: "smooth"
                        });
                      }
                    })
                    
                    $('button[data-carousel-right=""]').on('click', function(event){
                      let active_carousel = $('.carousel_item.active');
                      active_carousel.removeClass('active');
               
                      if(active_carousel.next().length !== 0){
                        active_carousel.next().addClass('active');
               
          
                        active_carousel.parent()[0].scroll({
                          left: active_carousel.next()[0].offsetLeft - convertRemToPixels(2.25),
                          behavior: "smooth"
                        });
                      }else{
                        $('.carousel_item:first').addClass('active')
                        $('.carousel_item:first').parent()[0].scroll({
                          left: $('.carousel_item:first').offset().left - convertRemToPixels(2.25),
                          behavior: "smooth"
                        });
                      }

                    })
                    $('.carousel_item:first').addClass('active')

                  </script>
              </div>
              <!--end::Body-->
            </div>
          </div>
        </div>

        <?php
        // <div class="row">
        //   <div class="col-lg-12">
        //     <div class="card card-custom card-stretch gutter-b">
        //       <!--begin::Header-->
        //       <div class="card-header border-0">
        //         <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Aradığım Hizmetler</h3>
        //         <div class="card-toolbar text-primary">
        //           Yeni İlan Ekle
        //         </div>
        //       </div>
        //       <!--end::Header-->
        //       <!--begin::Body-->
        //       <div class="card-body pt-2" style="min-height: 200px;"></div>
        //       <!--end::Body-->
        //     </div>
        //   </div>
        // </div>
        ?>

        <!--end::Advance Table Widget 7-->
 

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
</script>
