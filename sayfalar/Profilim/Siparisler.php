<?php include bilesen('hizmet_saglayici_list_element'); ?>

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
  <div class="container"><?php // container class'ı sildim çünkü yatay padding'den dolayı hizza bozuluyordu ?>
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
                <div class="profil_resmi symbol-label" style="background-image:url('<?= $kullanici['profil_resmi'] != null ? $kullanici['profil_resmi'] : 'assets/dashboard/media/users/default.jpg' ?>">
                  <span class="plus_icon bg-success text-white">
                    <i class="fas fa-plus"></i>
                  </span>
                </div>
              </div>
              <div>
                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?= $kullanici['isim'] . " " . $kullanici['soyisim'] ?></a>
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
                <?= $kullanici['hakkinda'] ?>
              </div>
            </div>
            <!--end::Contact-->
            <!--begin::Contact-->
            <div class="py-9">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Email:</span>
                <a href="#" class="text-muted text-hover-primary"><?= $kullanici['email'] ?></a>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">Telefon:</span>
                <span class="text-muted"><?= $kullanici['telefon'] ?></span>
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
                <a href="" class="navi-link" style="padding-left: 0;">
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
            <div class="card card-custom">
              <div class="card-header card-header-tabs-line">
                <div class="card-toolbar w-100">
                  <ul class="nav nav-tabs w-100 nav-bold nav-tabs-line d-flex flex-row">
                    <li class="nav-item w-50">
                      <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                        <span class="nav-icon">
                          <i class="flaticon-time-1"></i>
                        </span>
                        <span class="nav-text">Aktif Siparişler</span>
                      </a>
                    </li>
                    <li class="nav-item w-50">
                      <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                        <span class="nav-icon">
                          <i class="flaticon-time "></i>
                        </span>
                        <span class="nav-text">Tüm Siparişler</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <!-- Aktif -->
                  <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                  <style>
                    #countdown {
                      display: flex;
                      justify-content: center;
                      align-items: center;
                      flex-direction: column;
                    }

                    #countdown .circle {
                      display: flex;
                      justify-content: center;
                      align-items: center;
                      width: 7rem;
                      height: 7rem;
                      border-radius: 50%;
                    }

                    #countdown .circle span {
                      font-size: 1rem;
                      font-weight: 500;
                      color: #6610f2;
                      width: 6.5rem;
                      height: 6.5rem;
                      border-radius: 50%;
                      display: flex;
                      justify-content: center;
                      align-items: center;
                      background-color: #f3f6f9;
                    }
                  </style>
                  <?php if(count($aktif_siparisler) == 0){
                    ?>
                    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning"></i></div>
                      <div class="alert-text">Aktif siparişiniz bulunmamaktadır.</div>
                    </div>
                    <?php
                  } ?>
                  <?php
                    foreach($aktif_siparisler as $siparis){
                    ?>
                    <div id="hizmet_saglayici_profil_card" class="d-flex">
                      <!--begin: Pic-->
                      <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3 text-center">
                        <div class="symbol symbol-120 hizmet_photo_wrapper">
                          <span class="plus_icon bg-success text-white">
                            <i class="fas fa-plus"></i>
                          </span>
                          <input type="file" id="imgupload" style="display: none;">
                          <img id="hizmet_photo" src="<?= $siparis['hizmet_kapak_fotografi'] ?>" alt="image">
                        </div>

                      </div>
                      <!--end::Pic-->
                      <!--begin::Info-->
                      <div class="flex-grow-1 position-relative">
                        <!--begin::Title-->
                        <div id="hizmet_saglayici_profil_card_title" class="d-flex justify-content-between flex-wrap mt-1">
                          <div class="d-flex mr-3">
                            <a id="profile_card_hizmet_adi" autocomplete="off" spellcheck="false" href="/<?=$siparis['hizmet_turu_adi']?>/<?=seoURL($siparis['hizmet_adi'])?>/<?=$siparis['hizmet_id']?>" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $siparis['hizmet_saglayici_isim'] . " " . $siparis['hizmet_saglayici_soyisim'] ?></a>
                            <a href="/<?=$siparis['hizmet_turu_adi']?>/<?=seoURL($siparis['hizmet_adi'])?>/<?=$siparis['hizmet_id']?>"
                              class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3"
                              data-toggle="modal"
                              data-target="#kt_chat_modal"
                              onclick="istemci_durumu.oturum_acik_mi ? mesajlara_git(this) : oturum_popup()"
                              data-kullanici_id="<?= $siparis['hizmet_saglayici_id'] ?>"
                              data-kullanici_adi="<?= $siparis['hizmet_saglayici_isim'] . " " . $siparis['hizmet_saglayici_soyisim'] ?>">Mesaj At</a>
                            <?php if($siparis['odeme_id'] == 0){
                              ?>
                            <a href="/OdemeYap/hizmet/<?=$siparis['hizmet_id']?>"
                              class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-3">Ödeme Yap</a>
                              <?php
                            }else{
                              ?>
                            <a href="/Randevu/<?=$siparis['randevu_id']?>"
                              class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">Toplantıya Katıl</a>
                              <?php
                            } ?>
                          </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                          <div class="d-flex flex-column flex-grow-1 pr-8">
                          <span class="font-weight-bold text-dark-50 kisa_metin scroll scroll-pull ps ps--active-y" data-scroll="true" style="height: 54px; overflow: hidden;"><?= $siparis['hizmet_tanitim'] ?><div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 54px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 40px;"></div></div></span>

                          </div>
                        </div>
                        <!--end::Content-->
                      </div>
                      <div id="hizmet_saglayici_profil_card_icons" class="d-flex justify-content-center flex-wrap mt-1" style="flex-direction: column;">
                      <!-- begin:Circular remain time countdown -->
                      <div class="d-flex justify-content-center flex-wrap mt-1">
                        <div class="d-flex flex-column flex-grow-1">

                          <div id="countdown" class="circular-countdown" data-end="<?= $siparis['teslim_tarihi'] ?>" data-start="<?= $siparis['siparis_tarihi'] ?>">
                            <div class="circle">
                              <span class="time"></span>
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- end:Circular remain time countdown -->
                      </div>

                    </div>
                    <hr>
                    <?php
                    }
                  ?>
                        <script>
                          //                         var x = setInterval(function() {
                          //   var end = new Date("<?= $siparis['siparis_tarihi'] ?>");
                          //   var start = new Date("<?= $siparis['teslim_tarihi'] ?>").getTime();
                          //   var now = new Date().getTime();
                          //   var diff = start - end;
                          //   var left = start - now;
                          //   var percent = (left / diff) * 100;
                          //   var percent = 100 - percent;
                          //   var percent = percent.toFixed(2);
                          //   var percent = percent + "%";
                          //   var left = left / 1000;
                          //   var days = Math.floor(kalan / 86400);
                          //   var hours = Math.floor((kalan % 86400) / 3600);
                          //   var minutes = Math.floor(((kalan % 86400) % 3600) / 60);
                          //   var seconds = Math.floor(((kalan % 86400) % 3600) % 60);
                          //   if(days != 0){
                          //     var remain_time = days + " gün ";
                          //   }else if(hours != 0){
                          //     var remain_time = hours + " saat ";
                          //   }else if(minutes != 0){
                          //     var remain_time = minutes + " dakika ";
                          //   }else if(seconds != 0){
                          //     var remain_time = seconds + " saniye ";
                          //   }
                          //   document.querySelector("#countdown .circle .time").innerHTML = kalan_zaman;
                          //   document.querySelector(".circle").style.background = "conic-gradient(#6610f2 " + yuzde + ", #e3e3e3 " + yuzde + ")";
               

                          //   if (kalan < 0) {
                          //     clearInterval(x);
                          //     document.getElementById("countdown").innerHTML = "Süre Doldu";
                          //   }
                          // }, 1000);
                          document.querySelectorAll('.circular-countdown').forEach((countdown) => {
                            setInterval(function() {
                              var end = new Date(countdown.dataset.end).getTime();
                              var start = new Date(countdown.dataset.start).getTime();
                              var now = new Date().getTime();
                              var diff = end - start;
                              var left = end - now;
                              var percent = (left / diff) * 100;
                              var percent = 100 - percent;
                              var percent = percent.toFixed(2);
                              var percent = percent + "%";
                              var left = left / 1000;
                              var days = Math.floor(left / 86400);
                              var hours = Math.floor((left % 86400) / 3600);
                              var minutes = Math.floor(((left % 86400) % 3600) / 60);
                              var seconds = Math.floor(((left % 86400) % 3600) % 60);
                              if(days != 0){
                                var remain_time = days + " gün ";
                              }else if(hours != 0){
                                var remain_time = hours + " saat ";
                              }else if(minutes != 0){
                                var remain_time = minutes + " dakika ";
                              }else if(seconds != 0){
                                var remain_time = seconds + " saniye ";
                              }

                              if (left < 0) {
                                countdown.querySelector(".circle .time").innerHTML = "Süre Doldu";
                              }else{
                                if(typeof remain_time !== 'undefined'){
                                  countdown.querySelector(".circle .time").innerHTML = remain_time;
                                }
                                countdown.querySelector(".circle").style.background = "conic-gradient(#6610f2 " + percent + ", #e3e3e3 " + percent + ")";
                              }
                            }, 1000);
                          });

                        </script>
                  </div>
                  <!-- Aktif Son -->

                  <!-- Tüm -->
                  <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                  <?php if(count($tum_siparisler) == 0){
                    ?>
                    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning"></i></div>
                      <div class="alert-text">Geçmiş siparişiniz bulunmamaktadır.</div>
                    </div>
                    <?php
                  } ?>
                  <?php
                    foreach($tum_siparisler as $siparis){
                    ?>
                    <div id="hizmet_saglayici_profil_card" class="d-flex">
                      <!--begin: Pic-->
                      <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3 text-center">
                        <div class="symbol symbol-120 hizmet_photo_wrapper">
                          <span class="plus_icon bg-success text-white">
                            <i class="fas fa-plus"></i>
                          </span>
                          <input type="file" id="imgupload" style="display: none;">
                          <img id="hizmet_photo" src="<?= $siparis['hizmet_kapak_fotografi'] ?>" alt="image">
                        </div>

                      </div>
                      <!--end::Pic-->
                      <!--begin::Info-->
                      <div class="flex-grow-1 position-relative">
                        <!--begin::Title-->
                        <div id="hizmet_saglayici_profil_card_title" class="d-flex justify-content-between flex-wrap mt-1">
                          <div class="d-flex mr-3">
                            <a id="profile_card_hizmet_adi" autocomplete="off" spellcheck="false" href="/<?=$siparis['hizmet_turu_adi']?>/<?=seoURL($siparis['hizmet_adi'])?>/<?=$siparis['hizmet_id']?>" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $siparis['hizmet_saglayici_isim'] . " " . $siparis['hizmet_saglayici_soyisim'] ?></a>
                            <a href="/<?=$siparis['hizmet_turu_adi']?>/<?=seoURL($siparis['hizmet_adi'])?>/<?=$siparis['hizmet_id']?>"
                              class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3"
                              data-toggle="modal"
                              data-target="#DegerlendirModal_<?=$siparis['id']?>">Değerlendir</a>
                            <div class="modal fade" id="DegerlendirModal_<?=$siparis['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Değerlendir</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="exampleTextarea">Yorum</label>
                                      <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                      <input type="number" class="form-control d-none" id="pointSelect"></input>
                                      <i class="fas fa-star" id="starPoint"></i>
                                      <i class="fas fa-star" id="starPoint"></i>
                                      <i class="fas fa-star" id="starPoint"></i>
                                      <i class="fas fa-star" id="starPoint"></i>
                                      <i class="fas fa-star" id="starPoint"></i>
                                      <script>
                                        var starPoint = document.querySelectorAll("#starPoint");
                                        starPoint.forEach(function(item){
                                          item.addEventListener("click", function(){
                                            var color = "orange";
                                            var point = 0
                                            starPoint.forEach(function(item2){
                                              if(color == "orange"){
                                                point++;
                                              }
                                              item2.style.color = color;
                                              if(item2 == item){
                                                color = "black";
                                              }
                                            });
                                            document.querySelector("#pointSelect").value = point;
                                          });
                                        });
                                      </script>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    <button type="button" class="btn btn-primary">Kaydet</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                          <div class="d-flex flex-column flex-grow-1 pr-8">
                          <span class="font-weight-bold text-dark-50 kisa_metin scroll scroll-pull ps ps--active-y" data-scroll="true" style="height: 54px; overflow: hidden;"><?= $siparis['hizmet_tanitim'] ?><div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 54px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 40px;"></div></div></span>

                          </div>
                        </div>
                        <!--end::Content-->
                      </div>

                    </div>
                    <hr>
                    <?php
                    }
                  ?>

                  </div>
                  <!-- Tüm Son-->

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!--end::Content-->
    </div>
    <!--end::Profile Overview-->
  </div>
  <!--end::Container-->
</div>

<script>
  $(".profil_resmi .plus_icon").click(function() {
    $("#imgupload").trigger("click");
  });
  $("#imgupload").change(function(e) {
    var form_data = new FormData();
    var profil_resmi = e.target.files[0];
    form_data.append("profil_resmi", profil_resmi);

    $.ajax({
      url: "API/ProfilResmiYükle",
      data: form_data,
      processData: false,
      contentType: false,
      type: "POST",
      success: function(data) {
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