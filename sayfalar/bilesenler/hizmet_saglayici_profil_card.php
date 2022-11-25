<?php include_once bilesen('basil_icon') ?>
<?php 
function hizmet_saglayici_profil_card($hizmet_adi, $hizmet_saglayici, $yorum_sayisi){
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
                            <img id="hizmet_photo" src="<?= $hizmet_saglayici['profil_fotografi'] ?>" alt="image">
                        </div>
                        <br>
                        <a id="HizmetAlBtn" class="btn btn-sm btn-info font-weight-bolder text-uppercase"
                            onclick="console.log(this);if($(this).attr('disabled') != 'disabled') { istemci_durumu.oturum_acik_mi ? hizmet_al_popup(this) : oturum_popup() }"
                            data-hizmet_adi="<?= $hizmet_saglayici['adi'] ?>"
                            data-hizmet_tanitim="<?= $hizmet_saglayici['tanitim'] ?>"
                            data-hizmet_id="<?= $hizmet_saglayici['id'] ?>"
                            data-hizmet_saglayici_id="<?= $hizmet_saglayici['kullanici_id'] ?>"
                            data-hizmet_saglayici_adi="<?= $hizmet_saglayici['isim'] . " " . $hizmet_saglayici['soyisim'] ?>"
                            data-hizmet_saglayici_kapak_fotografi="<?= $hizmet_saglayici['kapak_fotografi'] ?>">Hizmet Al [<span id='ucret'><?= $hizmet_saglayici['saatlik_ucret'] ?></span>₺]
                        </a>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1 position-relative">
                        <?= $hizmet_saglayici['kullanici_id'] == $kullanici['id'] ? "<i id='profil_card_duzenle_" . $params['id'] ."' class='profil_card_duzenle fa fa-edit icon-lg'></i>" : "" ?>
                        <!--begin::Title-->
                        <div id="hizmet_saglayici_profil_card_title" class="d-flex justify-content-between flex-wrap mt-1">
                            <div class="d-flex mr-3">
                                <a id="profile_card_hizmet_adi" autocomplete="off" spellcheck="false" href="/<?= $hizmet_adi ?>/<?= seoURL($hizmet_saglayici['adi']) ?>/<?= $hizmet_saglayici['id'] ?>" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $hizmet_saglayici['adi'] ?></a>
                                <a href="javascript:void(0)">
                                    <i class="<?= $hizmet_saglayici['onaylayan_kullanici'] ? "flaticon2-correct text-success" : "far fa-eye-slash" ?> font-size-h5"></i>
                                </a>
                            </div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex flex-wrap justify-content-between mt-1">
                            <div class="d-flex flex-column flex-grow-1 pr-8">
                                <div class="d-flex flex-wrap mb-4">
                                    <!-- <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"> -->
                                    <!-- <i class="flaticon2-new-email mr-2 font-size-lg"></i>jason@siastudio.com</a> -->
                                    <a href="/Profil/<?= $hizmet_saglayici['kullanici_id'] ?>" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i><?= $hizmet_saglayici['isim'] . " " . $hizmet_saglayici['soyisim'] /*$hizmet_adi*/ ?></a>
                                    <a href="javascript:void(0)" class="text-dark-50 text-hover-primary font-weight-bold">
                                    <?php include_once 'Servisler/Adres_sehir.php'; $hizmet_saglayici_adres = get_adres_sehir_By_il_id($hizmet_saglayici['adres_id']);?>
                                    <i class="flaticon2-placeholder mr-2 font-size-lg"></i><?= $hizmet_saglayici_adres['il_adi'] ?></a>
                                </div>
                                <span id="hizmet_tanitim" spellcheck="false" autocomplete="off" class="font-weight-bold text-dark-50 kisa_metin scroll scroll-pull"><?= $hizmet_saglayici['tanitim'] ?></span>
                            </div>
            
                        </div>
                        <!--end::Content-->
                    </div>
                    <div id="hizmet_saglayici_profil_card_icons" class="d-flex justify-content-between flex-wrap mt-1" style="flex-direction: column;">
                    
                    

                        <div class="row">
                            <div class="col-md-4 p-0">
                                <i class="icon-36 text-dark">
                                    <?= basil_icon("Outline", "Status", "Checked-box"); ?>
                                </i>
                            </div>
                            <div style="width: 127px;" class="col-md-8 p-0">
                                Siparişler<br>
                                <b style="font-size: large;">15</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-0">
                                <i class="icon-36 text-dark">
                                    <?= basil_icon("Outline", "Status", "Heart"); ?>
                                </i>
                                <!-- <i class="icon-2x text-dark-50 flaticon-star"></i> -->
                            </div>
                            <div style="width: 127px;" class="col-md-8 p-0 ">
                                Puan<br>
                                <b style="font-size: large;">4</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-0">
                                <i class="icon-36 text-dark">
                                    <?= basil_icon("Outline", "Communication", "Chat"); ?>
                                </i>
                            </div>
                            <div style="width: 127px;" class="col-md-8 p-0">
                                Yorumlar<br>
                                <b style="font-size: large;"><?= $yorum_sayisi ?></b>
                            </div>
                        </div>
                    </div>
                    
                
                </div>
                <!--end::Details-->
         

            </div>
        </div>
        
<script>
$('.profil_card_duzenle').on('click', function(event){
    console.log(event.target)
    if(event.target.className.indexOf('edit') >= 0){
        $('#profile_card_hizmet_adi').attr('contentEditable', true);
        $('#hizmet_tanitim').attr('contentEditable', true);
        $('.hizmet_photo_wrapper')[0].className = 'hizmet_photo_wrapper_active symbol symbol-120'
        $('#ucret').attr('contentEditable', true);
        $('#ucret').attr('style', 'cursor: text;');
        $('#HizmetAlBtn').attr('disabled', true);
        $('#hizmet_saglayici_profil_card')[0].className += " profil_card_duzenlenebilir";
        event.target.className = 'far fa-save profil_card_duzenle icon-lg';

        $(".hizmet_photo_wrapper_active .plus_icon").click(function () {
            $("#imgupload").trigger("click");
        });
    } else {
        $('#profile_card_hizmet_adi').attr('contentEditable', false);
        $('#hizmet_tanitim').attr('contentEditable', false);
        $('.hizmet_photo_wrapper_active')[0].className = 'hizmet_photo_wrapper symbol symbol-120'
        $('#ucret').attr('contentEditable', false);
        $('#ucret').attr('style', 'cursor: inherit;');
        $('#HizmetAlBtn').attr('disabled', false);
        $('#hizmet_saglayici_profil_card')[0].className = $('#hizmet_saglayici_profil_card')[0].className.replace(" profil_card_duzenlenebilir", "");
        event.target.className = 'fa fa-edit profil_card_duzenle icon-lg';
        let hizmet_saglayici_adi = $('#profile_card_hizmet_adi').text();
        let hizmet_id = <?= $hizmet_saglayici['id'] ?>;
        let hizmet_tanitim = $('#hizmet_tanitim').text();
        let ucret = $('#ucret').text()

        var form_data = new FormData();    
        form_data.append('hizmet_saglayici_id', hizmet_id);
        form_data.append('hizmet_saglayici_adi', hizmet_saglayici_adi);
        form_data.append('hizmet_tanitim', hizmet_tanitim);
        form_data.append("ucret", ucret);
        form_data.append("hizmet_resmi", $("#imgupload")[0].files[0]);
        

        return $.ajax({
            url: 'API/Hizmet_Saglayici_Duzenle',
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
                       // window.location = window.location ;
                    });
                }
            }
        });
    }

})

$("#imgupload").change(function (e) {
  
    var reader = new FileReader(); //Initialize FileReader.

    reader.onload = function (e) {
        $('#hizmet_photo').attr('src', e.target.result);
    };
    
    reader.readAsDataURL(e.target.files[0]);

});
</script>
    <?php
}
?>