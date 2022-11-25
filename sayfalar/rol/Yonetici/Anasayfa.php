
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
                            <a class="nav-link active" href="#kullanicilar" data-toggle="tab">
                                <span class="nav-text">Kullanıcılar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#hizmetler" data-toggle="tab">
                                <span class="nav-text">Hizmetler</span>
                            </a>
                        </li>

                    </ul>
                </div>
              </div>
              <div class="card-body">
                  <div class="tab-content">
                      <div class="tab-pane active show" id="kullanicilar">
                          <div class="kt-widget5">
                              <table class="datatable table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>isim</th>
                                    <th>soyisim</th>
                                    <th>hakkında</th>
                                    <th>email</th>
                                    <th>telefon</th>
                                    <th>işlem</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($kullanicilar as $kullanici_id => $kullanici_loop) {
                                      ?>
                                    <tr>
                                      <td><?= $kullanici_loop['id'] ?></td>
                                      <td><?= $kullanici_loop['isim'] ?></td>
                                      <td><?= $kullanici_loop['soyisim'] ?></td>
                                      <td><?= str_limit($kullanici_loop['hakkinda'], 100); ?></td>
                                      <td><?= $kullanici_loop['email'] ?></td>
                                      <td><?= $kullanici_loop['telefon'] ?></td>
                                      <td>
                                        <!-- düzenle modal oppener -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kullanici_duzenle_modal<?= $kullanici_loop['id'] ?>">
                                          <i class="fa fa-edit"></i> Düzenle
                                        </button>
                                        <!-- düzenle modal -->
                                        <div class="modal fade" id="kullanici_duzenle_modal<?= $kullanici_loop['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <form action="/kullanici/duzenle" method="post">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Düzenle</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">İsim</label>
                                                    <input type="text" class="form-control" name="isim" value="<?= $kullanici_loop['isim'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Soyisim</label>
                                                    <input type="text" class="form-control" name="soyisim" value="<?= $kullanici_loop['soyisim'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email" class="form-control" name="email" value="<?= $kullanici_loop['email'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Telefon</label>
                                                    <input type="text" class="form-control" name="telefon" value="<?= $kullanici_loop['telefon'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Hakkında</label>
                                                    <textarea class="form-control" name="hakkinda" rows="3"><?= $kullanici_loop['hakkinda'] ?></textarea>
                                                  </div>
                                                  <input type="hidden" name="id" value="<?= $kullanici_loop['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                                  <button type="button" id="kullanici_duzenle_btn<?= $kullanici_loop['id'] ?>" class="btn btn-primary">Kaydet</button>
                                                </div>
                                              </form>
                                              <script>
                                                $('#kullanici_duzenle_btn<?= $kullanici_loop['id'] ?>').click(function(){
                                                  $('#kullanici_duzenle_modal<?= $kullanici_loop['id'] ?>').modal('hide');

                                                  // get form data form form element and use it to ajax request
                                                  $.ajax({
                                                    type: 'post',
                                                    url: 'api/kullanici_duzenle',
                                                    data: $('#kullanici_duzenle_modal<?= $kullanici_loop['id'] ?> form').serialize(),
                                                    success: function(data) {
                                                      if(data.durum == "Hata"){
                                                        swal({
                                                            title: "Hata!",
                                                            text: data.mesaj,
                                                            icon: "error",
                                                            timer: 1337
                                                        })
                                                      }else if(data.durum == "Başarılı"){
                                                        swal({
                                                          title: 'Başarılı',
                                                          text: data.mesaj,
                                                          icon: "success",
                                                          timer: 1337
                                                        }).then(function() {
                                                          location.reload();
                                                        });
                                                      }
                                                    }
                                                  });
                                                  // $('#hizmet_duzenle_modal form').submit();
                                                });
                                              </script>
                                            </div>
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
                      <div class="tab-pane" id="hizmetler">
                        <div class="kt-widget5">
                            <!-- hizmetleri datatable ile listele -->

                              <table class="datatable table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Adı</th>
                                    <th>Açıklama</th>
                                    <th>İşlem</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($hizmetler as $hizmet_no => $hizmet) {
                                      ?>
                                    <tr>
                                      <td><?= $hizmet['id'] ?></td>
                                      <td><?= $hizmet['hizmet_adi'] ?></td>
                                      <td><?= str_limit($hizmet['hizmet_aciklaması'], 100); ?></td>
                                      <td>
                                        <!-- düzenle modal oppener -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hizmet_duzenle_modal<?= $hizmet['id'] ?>">
                                          <i class="fa fa-edit"></i> Düzenle
                                        </button>
                                        <!-- düzenle modal -->
                                        <div class="modal fade" id="hizmet_duzenle_modal<?= $hizmet['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <form action="api/hizmet_duzenle" method="post">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Hizmet Düzenle</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="form-group">
                                                    <label for="baslik">Başlık</label>
                                                    <input type="text" class="form-control" id="baslik" placeholder="Başlık" name="adi" value="<?= $hizmet['hizmet_adi'] ?>">
                                                    <input type="hidden" name="id" value="<?= $hizmet['id'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="aciklama">Açıklama</label>
                                                    <textarea class="form-control" id="aciklama" placeholder="Açıklama" name="hizmet_aciklaması"><?= $hizmet['hizmet_aciklaması'] ?></textarea>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                                  <button id="hizmet_kaydet_btn<?= $hizmet['id'] ?>" type="button" class="btn btn-primary">Kaydet</button>
                                                </div>
                                              </form>
                                              <script>

                                                $('#hizmet_kaydet_btn<?= $hizmet['id'] ?>').click(function() {
                                                  $('#hizmet_duzenle_modal<?= $hizmet['id'] ?>').modal('hide');
                                                  // get form data form form element and use it to ajax request
                                                  $.ajax({
                                                    type: 'post',
                                                    url: 'api/hizmet_duzenle',
                                                    data: $('#hizmet_duzenle_modal<?= $hizmet['id'] ?> form').serialize(),
                                                    success: function(data) {
                                                      if(data.durum == "Hata"){
                                                        swal({
                                                            title: "Hata!",
                                                            text: data.mesaj,
                                                            icon: "error",
                                                            timer: 1337
                                                        })
                                                      }else if(data.durum == "Başarılı"){
                                                        swal({
                                                          title: 'Başarılı',
                                                          text: data.mesaj,
                                                          icon: "success",
                                                          timer: 1337
                                                        }).then(function() {
                                                          location.reload();
                                                        });
                                                      }
                                                    }
                                                  });
                                                  // $('#hizmet_duzenle_modal form').submit();
                                                });
                                              </script>
                                            </div>
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

                              </script>
        <!--end::Card with tabs -->
    </div>
    <script src="~assets/dashboard/js/pages/custom/wizard/wizard-3.js"></script>
</div>