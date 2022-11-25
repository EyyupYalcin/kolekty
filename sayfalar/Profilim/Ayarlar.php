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
                <a href="/Profil/Takvim/<?= $kullanici['id'] ?>" class="navi-link" style="padding-left: 0;">
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
                <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Profil Ayarları</h3>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="image-input-wrapper"></div>
              <div class="card-body pt-2" style="min-height: 200px;">
                <form class="form">
												<!--begin::Body-->
												<div class="card-body">
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mb-6">Müşteri Bilgisi</h5>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Profil Resmi</label>
														<div class="col-lg-9 col-xl-6">
															<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url('<?=$kullanici['profil_resmi'] != null ? $kullanici['profil_resmi'] : 'assets/dashboard/media/users/default.jpg'?>')">
																<div class="image-input-wrapper" style="background-image: url()"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Değiştir">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input id="profil_resmi" type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
																	<input type="hidden" name="profile_avatar_remove" />
																</label>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Sil">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
															</div>
															<span class="form-text text-muted">İzin verilen dosya türleri: png, jpg, jpeg.</span>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Adınız</label>
														<div class="col-lg-9 col-xl-6">
															<input id="isim" class="form-control form-control-lg form-control-solid" type="text" value="<?=$kullanici['isim']?>" />
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Soyadınız</label>
														<div class="col-lg-9 col-xl-6">
															<input id="soyisim" class="form-control form-control-lg form-control-solid" type="text" value="<?= $kullanici['soyisim']?>" />
														</div>
													</div>
						
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Ünvan</label>
														<div class="col-lg-9 col-xl-6">
															<input id="unvan" class="form-control form-control-lg form-control-solid" type="text" value="<?= $kullanici['unvan']?>" />
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Hakkında</label>
														<div class="col-lg-9 col-xl-6">
															<input id="hakkinda" class="form-control form-control-lg form-control-solid" type="text" value="<?= $kullanici['hakkinda']?>" />
														</div>
													</div>
                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Konum</label>
														<div class="col-lg-9 col-xl-6">
															<select id="konum" class="form-control form-control-lg form-control-solid">
                                <option value="" disabled>Seçiniz</option>
                              </select>
                              <script>
                                $.ajax({
                                    type: "GET",
                                    url: "API/Sehir",
                                    dataType: "json",
                                    success: function (data) {
                                      var cities = data;
                                      cities.forEach(city => {
                                        $('#konum').append(`<option value="${city.il_id}">${city.il_adi}</option>`);
                                      });
                                      $('#konum option[value="<?= $kullanici['adres_id'] ?>"]')[0].selected = 1; // kayıtlı il'i seç
                                    }
                                });
                              </script>
														</div>
													</div>
												</div>
												<!--end::Body-->
                        <button id="profil_kaydet_btn" type="button" class="swal-button swal-button--confirm float-right">Kaydet</button>
                        <script>
                            $("#profil_resmi").on("change", function(e){
                             
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                $('#kt_profile_avatar')[0].style.backgroundImage = "url('" + e.target.result + "')"
                              }
                              reader.readAsDataURL( e.target.files[0]);
                            })

                            $("#profil_kaydet_btn").on('click', function (e) {
                              var form_data = new FormData();
                              var profil_resmi = $('#profil_resmi')[0].files[0];
                              var isim = $('#isim').val()
                              var soyisim = $('#soyisim').val()
                              var unvan = $('#unvan').val()
                              var hakkinda = $('#hakkinda').val()
                              var konum = $('#konum').val()
                              form_data.append("profil_resmi", profil_resmi);
                              form_data.append("isim", isim);
                              form_data.append("soyisim", soyisim);
                              form_data.append("unvan", unvan);
                              form_data.append("hakkinda", hakkinda);
                              form_data.append("konum", konum);

                              $.ajax({
                                url: "API/ProfilGuncelle",
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
								</form>
              </div>
              <!--end::Body-->
            </div>
          </div>
        </div>
        <!--end::Advance Table Widget 7-->
        <!--begin::Row-->
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                <div class="card card-custom card-stretch gutter-b">
                  <!--begin::Header-->
                  <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">İletişim Ayarları</h3>
                    
                    <div class="card-toolbar">
                    </div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body pt-2" style="min-height: 200px;">
                
                    <form class="form">
                          <!--begin::Body-->
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">İletişim Bilgileri</h5>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Telefon Numarası</label>
														<div class="col-xl">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-phone"></i>
																	</span>
																</div>
																<input id="telefon" type="text" class="form-control form-control-lg form-control-solid" value="<?= $kullanici['telefon']?>" placeholder="Phone" />
															</div>
															<span class="form-text text-muted">E-postanızı başkalarıyla paylaşmayacağız.</span>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Email Adresi</label>
														<div class="col-xl">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-at"></i>
																	</span>
																</div>
																<input id="email" type="text" class="form-control form-control-lg form-control-solid" value="<?= $kullanici['email']?>" placeholder="Email" />
															</div>
														</div>
													</div>
										      <button id="iletisim_bilgi_kaydet" type="button" class="swal-button swal-button--confirm float-right">Kaydet</button>
                          <!--end::Body-->
                          <script>
                            $("#iletisim_bilgi_kaydet").on('click', function (e) {
                              var form_data = new FormData();
                              var telefon = $('#telefon').val()
                              var email = $('#email').val()
                              form_data.append("telefon", telefon);
                              form_data.append("email", email);

                              $.ajax({
                                url: "API/iletisimBilgisiGuncelle",
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
                    </form>
                
                  </div>
                  <!--end::Body-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                <div class="card card-custom card-stretch gutter-b">
                  <!--begin::Header-->
                  <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Güvenlik Ayarları</h3>
                    
                    <div class="card-toolbar">
                    
                    </div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body pt-2" style="min-height: 200px;">
                      <form class="form">
												<div class="card-body">
										
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label text-alert">Mevcut Parola</label>
														<div class="col-xl">
															<input id="old_password" type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Mevcut Parola" />
															<a href="#" class="text-sm font-weight-bold">Parolanızı mı unuttunuz ?</a>
														</div>
													</div>
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
                        <button id="parola_guncelle" type="button" class="swal-button swal-button--confirm float-right">Kaydet</button>
                        <script>
                            $("#parola_guncelle").on('click', function (e) {
                              var form_data = new FormData();
                              var old_password = $('#old_password').val()
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
                              form_data.append("old_password", old_password);
                              form_data.append("password", password);
                              form_data.append("repassword", repassword);

                              $.ajax({
                                url: "API/ParolaReset",
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
											</form>
                  </div>
                  <!--end::Body-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end::Row-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Profile Overview-->
  </div>
  <!--end::Container-->
</div>

