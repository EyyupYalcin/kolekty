<?php 
function hizmet_saglayici_list_element($hizmet_adi, $hizmet_saglayici){
    ?>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img src="<?= $hizmet_saglayici['kapak_fotografi'] ?>" alt="image">
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
                                <a href="/<?= $hizmet_adi ?>/<?= seoURL($hizmet_saglayici['adi']) ?>/<?= $hizmet_saglayici['id'] ?>" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $hizmet_saglayici['adi'] ?></a>
                                <a href="#">
                                    <i class="flaticon2-correct text-success font-size-h5"></i>
                                </a>
                            </div>
                            <div class="my-lg-0 my-3">
                                <a  href="/<?= $hizmet_adi ?>/<?= seoURL($hizmet_saglayici['adi']) ?>/<?= $hizmet_saglayici['id'] ?>" 
                                    class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3"
                                    data-toggle="modal"
                                    data-target="#kt_chat_modal"
                                    onclick="mesajlara_git(this)"
                                    data-kullanici_id="<?= $hizmet_saglayici['kullanici_id'] ?>"
                                    data-kullanici_adi="<?= $hizmet_saglayici['isim'] . " " . $hizmet_saglayici['soyisim'] ?>"
                                >Soru Sor</a>
                                <a href="/<?= $hizmet_adi ?>/<?= seoURL($hizmet_saglayici['adi']) ?>/<?= $hizmet_saglayici['id'] ?>" class="btn btn-sm btn-info font-weight-bolder text-uppercase">Hizmet Al</a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <!-- <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"> -->
                                    <!-- <i class="flaticon2-new-email mr-2 font-size-lg"></i>jason@siastudio.com</a> -->
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i><?= $hizmet_saglayici['isim'] . " " . $hizmet_saglayici['soyisim'] /*$hizmet_adi*/ ?></a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                    <i class="flaticon2-placeholder mr-2 font-size-lg"></i>Neverland</a>
                                </div>
                                <span class="font-weight-bold text-dark-50 kisa_metin"><?= $hizmet_saglayici['tanitim'] ?></span>
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
                <!--end::Details-->
                <!-- <div class="separator separator-solid"></div> -->
                <!--begin::Items-->
                <div class="d-flex align-items-center flex-wrap mt-8" style="display: none !important;">
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Earnings</span>
                            <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold">$</span>249,500</span>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Expenses</span>
                            <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold">$</span>164,700</span>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Net</span>
                            <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold">$</span>782,300</span>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column flex-lg-fill">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">73 Tasks</span>
                            <a href="#" class="text-primary font-weight-bolder">View</a>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="d-flex flex-column">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">648 Comments</span>
                            <a href="#" class="text-primary font-weight-bolder">View</a>
                        </div>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center flex-lg-fill mb-2 float-left">
                        <span class="mr-4">
                            <i class="flaticon-network display-4 text-muted font-weight-bold"></i>
                        </span>
                        <div class="symbol-group symbol-hover">
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Mark Stone">
                                <img alt="Pic" src="assets/media/users/300_25.jpg">
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Charlie Stone">
                                <img alt="Pic" src="assets/media/users/300_19.jpg">
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Luca Doncic">
                                <img alt="Pic" src="assets/media/users/300_22.jpg">
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Nick Mana">
                                <img alt="Pic" src="assets/media/users/300_23.jpg">
                            </div>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="Teresa Fox">
                                <img alt="Pic" src="assets/media/users/300_18.jpg">
                            </div>
                            <div class="symbol symbol-30 symbol-circle symbol-light">
                                <span class="symbol-label font-weight-bold">5+</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->
                </div>
                <!--begin::Items-->
            </div>
        </div>
    <?php
}
?>