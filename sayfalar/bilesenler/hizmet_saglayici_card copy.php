<div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div class="d-flex">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img src="/assets/uploads/hizmet_kapak/5a4f23de67b0a91d1c6b91d5.jpg" alt="image">
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
                            <div class="d-flex my-lg-0 my-4 mr-3">
                                <a href="/Sigorta/lenda/3" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">Lenda</a>
                                <a href="#">
                                    <i class="flaticon2-correct text-success font-size-h5"></i>
                                </a>
                            </div>
                            <div class="my-lg-0 my-3">
                                <a href="/Sigorta/lenda/3" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3" data-toggle="modal" data-target="#kt_chat_modal" onclick="istemci_durumu.oturum_acik_mi ? mesajlara_git(this) : oturum_popup()" data-kullanici_id="3" data-kullanici_adi="Eyyüp YALÇIN">Soru Sor</a>
                                <a href="/Sigorta/lenda/3" class="btn btn-sm btn-info font-weight-bolder text-uppercase">Hizmet Al</a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <!-- <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"> -->
                                    <!-- <i class="flaticon2-new-email mr-2 font-size-lg"></i>jason@siastudio.com</a> -->
                                    <a href="/Profil/3" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>Eyyüp YALÇIN</a>
                                    <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                    <?php include_once 'Servisler/Adres_sehir.php'; $hizmet_saglayici_adres = get_adres_sehir_By_il_id($hizmet_saglayici['adres_id']);?>
                                    <i class="flaticon2-placeholder mr-2 font-size-lg"></i><?= $hizmet_saglayici_adres['il_adi'] ?></a>
                                </div>
                                <span class="font-weight-bold text-dark-50 kisa_metin"><p>Sigorta acenteliğine hızlı bir başlangıç yapmak isterseniz bizimle irtibata geçebilirsiniz. Türkiye genelinde geniş şube ağıyla hizmet vermekte olan şirketimize sizde katılın.</p></span>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
        </div>