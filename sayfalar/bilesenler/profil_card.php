<?php include_once bilesen('basil_icon') ?>
<?php 
function profil_card($card_kullanici){
    global $kullanici;
    ?>
        <style>
            @media (max-width: 600px) {
                #hizmet_saglayici_profil_card {
                    flex-direction: column;
                }
                #hizmet_saglayici_profil_card_icons {
                    flex-direction: row !important;
                    padding: 2rem 2.25rem;
                }
                #hizmet_saglayici_profil_card_icons .col-md-8 {
                    width: auto !important;
                }
                #hizmet_saglayici_profil_card_title {
                    margin-top: 1rem !important;
                }
            }
            .profil_card_duzenle {
                position: absolute;
                right: 40px;
                top: 14px;
                color: black;
                cursor: pointer;
            }
            .profil_card_duzenle:hover {
                color: inherit;
            }
            a[contenteditable="true"], div[contenteditable="true"], span[contenteditable="true"] {
                text-decoration-line: underline;
                text-decoration-style: dotted;
                text-decoration-thickness: 2px;
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

            .hizmet_photo_wrapper_active:hover .plus_icon {
                display: block;
                position: absolute;
                right: -12px;
                top: -12px;
            }
            .hizmet_photo_wrapper_active #hizmet_photo{
                border: 3px dotted;
            }

            .profil_card_duzenlenebilir *[contenteditable="true"] {
                text-decoration-line: none;
                text-decoration-style: dotted;
                text-decoration-thickness: 2px;
                border: 2px dotted #585858;
                padding: 2px;
            }
            
            .profil_card_duzenlenebilir .btn *[contenteditable="true"] {
                text-decoration-line: none;
                border: 1px solid white;
       
            }
        </style>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Details-->
                <div id="hizmet_saglayici_profil_card" class="d-flex">
                    <!--begin: Pic-->
                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3 text-center">
                        <div class="symbol symbol-120 hizmet_photo_wrapper">
                            <span class="plus_icon bg-success text-white">
                                <i class="fas fa-plus"></i>
                            </span>
                            <input type="file" id="imgupload" style="display: none;" />
                            <img id="hizmet_photo" src="<?= $card_kullanici['profil_resmi'] ?>" alt="image">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1 position-relative">
                        <!--begin::Title-->
                        <div id="hizmet_saglayici_profil_card_title" class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a id="profile_card_hizmet_adi" autocomplete="off" spellcheck="false" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= ucfirst($card_kullanici['isim']) . " " . ucfirst($card_kullanici['soyisim']) ?></a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <!-- <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"> -->
                                    <!-- <i class="flaticon2-new-email mr-2 font-size-lg"></i>jason@siastudio.com</a> -->
                                    
                                    <a href="javascript:void(0)" class="text-dark-50 text-hover-primary font-weight-bold">
                                    <?php include_once 'Servisler/Adres_sehir.php'; $konum = get_adres_sehir_By_il_id($card_kullanici['adres_id']);?>
                                    <i class="flaticon2-placeholder mr-2 font-size-lg"></i><?= $konum['il_adi'] ?></a>
                                </div>
                                <span id="hizmet_tanitim" spellcheck="false" autocomplete="off" class="font-weight-bold text-dark-50 kisa_metin scroll scroll-pull"><?= $card_kullanici['hakkinda'] ?></span>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <div>
                        <a  class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mx-auto"
                            data-toggle="modal"
                            data-target="#kt_chat_modal"
                            onclick="istemci_durumu.oturum_acik_mi ? mesajlara_git(this) : oturum_popup()"
                            data-kullanici_id="<?= $card_kullanici['id'] ?>"
                            data-kullanici_adi="<?= $card_kullanici['isim'] . " " . $card_kullanici['soyisim'] ?>"
                        >Soru Sor</a>
                    </div>

                    
                
                </div>
                <!--end::Details-->
         

            </div>
        </div>
    <?php
}
?>