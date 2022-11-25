<style>
.kisa_metin{
    height: 54px;
    line-height: 18px;
}
</style>
<?php
function ilan_list_element($hizmet_adi, $ilan){
    ?>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img src="<?= $ilan['profil_resmi'] ?>" alt="image">
                        </div>
                        <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                            <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a href="/İlan/<?= seoURL($hizmet_adi) ?>/<?= seoURL($ilan['baslik']) ?>/<?= $ilan['id'] ?>" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $ilan['baslik'] ?></a>
                                <a href="javascript:void(0)">
                                    <i class="<?= $ilan['onaylayan_kullanici'] ? " text-success" : "far fa-eye-slash" ?> font-size-h5"></i>
                                </a>
                            </div>
                            <div class="my-lg-0 my-3">
                                <a  href="/İlan/<?= seoURL($hizmet_adi) ?>/<?= seoURL($ilan['baslik']) ?>/<?= $ilan['id'] ?>" 
                                    class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3"
                                    data-toggle="modal"
                                    data-target="#kt_chat_modal"
                                    onclick="istemci_durumu.oturum_acik_mi ? mesajlara_git(this) : oturum_popup()"
                                    data-kullanici_id="<?= $ilan['musteri_id'] ?>"
                                    data-kullanici_adi="<?= $ilan['isim'] . " " . $ilan['soyisim'] ?>"
                                >Soru Sor</a>
                                <a  class="btn btn-sm btn-info font-weight-bolder text-uppercase">Teklif Ver</a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex flex-wrap mb-4">
                                    <a href="/Profil/<?= $ilan['musteri_id'] ?>" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i><?= $ilan['isim'] . " " . $ilan['soyisim'] /*$hizmet_adi*/ ?></a>
                                    <a class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <?php include_once 'Servisler/Adres_sehir.php'; $ilan_adres = get_adres_sehir_By_il_id($ilan['adres_id']);?>
                                    <i class="flaticon2-placeholder mr-2 font-size-lg"></i><?= $ilan_adres['il_adi'] ?></a>
                                     <a class="text-dark-50 text-hover-primary font-weight-bold mb-lg-0 mb-2 py-auto d-flex">
                                    <i class="far fa-money-bill-alt icon-md d-flex my-auto mr-2 font-size-lg"></i><?= $ilan['butce'] ?>₺</a>
                                </div>
                                <div class="d-flex flex-row">
                                    <span class="font-weight-bold text-dark-50 kisa_metin scroll scroll-pull" data-scroll="true"><?= nl2br($ilan['icerik']) ?></span>

                                </div>
                                
                            </div>
                            <!-- <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                                <span class="font-weight-bold text-dark-75">Progress</span>
                                <div class="progress progress-xs mx-3 w-100">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="font-weight-bolder text-dark">78%</span>
                            </div> -->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
    <?php
}
?>