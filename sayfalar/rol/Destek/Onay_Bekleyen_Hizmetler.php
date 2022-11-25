
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="text-center">
    <div class="row">
        <div class="col-lg-12">
          <div div class="card card-custom card-stretch gutter-b">
              <div class="card-header">
                <div class="card-title">
                    <!-- <h3 class="card-label">Yönetici Anasayfası</h3> -->
                    <!-- tabs bar -->
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-primary nav-tabs-line-right card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#onay_bekleyen" data-toggle="tab">
                                <span class="nav-text">Onay Bekleyen</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#onaylanan_hizmetler" data-toggle="tab">
                                <span class="nav-text">Onaylanan Hizmetler</span>
                            </a>
                        </li>

                    </ul>
                </div>
              </div>
              <div class="card-body">
                  <div class="tab-content">
                      <div class="tab-pane active show" id="onay_bekleyen">
                          <div class="kt-widget5">
                              <table class="datatable table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Hizmet Sağlayıcı</th>
                                    <th>Hizmet</th>
                                    <th>Tanıtım</th>
                                    
                                    <th>işlem</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($onay_bekleyen_hizmetler as $hizmet_id => $hizmet) {
                                      ?>
                                    <tr>
                                      <td><?= $hizmet['id'] ?></td>
                                      <td><?= $hizmet['isim'] . " " . $hizmet['soyisim'] ?></td>
                                      <td><?= $hizmet['adi'] ?></td>
                                      <td><?= str_limit($hizmet['tanitim'], 100) ?></td>
                                      <td>
                                        <!-- bootstrap button dropdown -->
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-light-primary btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="navi navi-hover">
                                                    <li class="navi-header font-weight-bold py-4">
                                                        <span class="font-size-lg">İşlem Seçenekleri</span>
                                                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Daha fazlasını öğren..."></i>
                                                    </li>
                                                    <li class="navi-separator mb-3 opacity-70"></li>
                                                    <li class="navi-item">
                                                        <a href="/Destek/<?= seoURL($hizmet['adi']) ?>/<?= $hizmet['id'] ?>" class="navi-link" target="_blank">
                                                            <span class="navi-icon"><i class="flaticon2-search"></i></span>
                                                            <span class="navi-text">Görüntüle</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="javascript:;" 
                                                          data-hizmet-saglayici-id="<?= $hizmet['id'] ?>"
                                                          class="navi-link onayla_btn">
                                                            <span class="navi-icon"><i class="flaticon2-check-mark"></i></span>
                                                            <span class="navi-text">Onayla</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="javascript:;" 
                                                        data-hizmet-saglayici-id="<?= $hizmet['id'] ?>"
                                                        class="navi-link reddet_btn">
                                                            <span class="navi-icon"><i class="flaticon2-cancel"></i></span>
                                                            <span class="navi-text">Reddet</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php
                                  }?>
                                </tbody>
                              </table>

                          </div>
                      </div>
                      <div class="tab-pane" id="onaylanan_hizmetler">
                        <div class="kt-widget5">

                              <table class="datatable table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Hizmet Sağlayıcı</th>
                                    <th>Hizmet</th>
                                    <th>Tanıtım</th>
                                    <th>Onaylayan Kullanici</th>
                                    <th>işlem</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($onaylanan_hizmetler as $hizmet_id => $hizmet) {
                                      ?>
                                    <tr>
                                      <td><?= $hizmet['id'] ?></td>
                                      <td><?= $hizmet['isim'] . " " . $hizmet['soyisim'] ?></td>
                                      <td><?= $hizmet['adi'] ?></td>
                                      <td><?= str_limit($hizmet['tanitim'], 100) ?></td>
                                      <td><?= $hizmet['onaylayan_kullanici_isim'] . " " . $hizmet['onaylayan_kullanici_soyisim'] ?></td>
                                      <td>
                                        <!-- bootstrap button dropdown -->
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-light-primary btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ki ki-bold-more-hor"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="navi navi-hover">
                                                    <li class="navi-header font-weight-bold py-4">
                                                        <span class="font-size-lg">İşlem Seçenekleri</span>
                                                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Daha fazlasını öğren..."></i>
                                                    </li>
                                                    <li class="navi-separator mb-3 opacity-70"></li>
                                                    <li class="navi-item">
                                                        <a href="/Destek/<?= seoURL($hizmet['adi']) ?>/<?= $hizmet['id'] ?>" class="navi-link" target="_blank">
                                                            <span class="navi-icon"><i class="flaticon2-search"></i></span>
                                                            <span class="navi-text">Görüntüle</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="javascript:;"
                                                          data-hizmet-saglayici-id="<?= $hizmet['id'] ?>"
                                                          class="navi-link reddet_btn">
                                                            <span class="navi-icon"><i class="flaticon2-cancel"></i></span>
                                                            <span class="navi-text">Reddet</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php
                                  }?>
                                </tbody>
                              </table>

                              


                        </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
                              <script>
                                $(document).ready(function() {
                                  $('.datatable').DataTable({
                                    "language": {
                                      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
                                    }
                                  });
                                } );

                                $('.onayla_btn').click(function() {
                                  var hizmet_saglayici_id = $(this).data('hizmet-saglayici-id');
                                  var form_data = new FormData();
                                  form_data.append('hizmet_saglayici_id', hizmet_saglayici_id);
                                  swal({
                                    title: "Başvuruyu onaylamak istediğine emin misin?",
                                    icon: "warning",
                                    button: {
                                      text: "Tamamla",
                                      closeModal: false,
                                    },
                                    dangerMode: true,
                                  }).then(function(swal_data) {
                                    if (!swal_data) throw null;
                                    $.ajax({
                                      url: 'API/HizmetSaglayiciOnayla',
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
                                  });
                                });

                                $('.reddet_btn').click(function() {
                                  var hizmet_saglayici_id = $(this).data('hizmet-saglayici-id');
                                  var form_data = new FormData();
                                  form_data.append('hizmet_saglayici_id', hizmet_saglayici_id);
                                  swal({
                                    title: "Başvuruyu reddetmek istediğine emin misin?",
                                    icon: "warning",
                                    button: {
                                      text: "Tamamla",
                                      closeModal: false,
                                    },
                                    dangerMode: true,
                                  }).then(function(swal_data) {
                                    if (!swal_data) throw null;
                                    $.ajax({
                                      url: 'API/HizmetSaglayiciReddet',
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
                                  });
                                });
                              </script>
        <!--end::Card with tabs -->
    </div>
    <script src="~assets/dashboard/js/pages/custom/wizard/wizard-3.js"></script>
</div>