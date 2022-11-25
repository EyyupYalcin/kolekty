<template id="gelenMesaj" style="display: none;">
    <div class="d-flex flex-column mb-5 align-items-start">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle symbol-40 mr-3">
                <img alt="Pic" src="--[ProfilResmi]--" />
            </div>
            <div>
                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">--[KullaniciAdi]--</a>
                <span class="text-muted font-size-sm" title="--[MesajZamani]--">--[Ne_Kadar_Once]--</span>
            </div>
        </div>
        <div id="--[Mesaj_id]--" class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px mesaj_metni">--[Mesaj]--</div>
    </div>
</template>

<template id="gidenMesaj" style="display: none;">
    <div class="d-flex flex-column mb-5 align-items-end">
        <div class="d-flex align-items-center">
            <div>
                <span class="text-muted font-size-sm" title="--[MesajZamani]--">--[Ne_Kadar_Once]--</span>
                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">--[KullaniciAdi]--</a>
            </div>
            <div class="symbol symbol-circle symbol-40 ml-3">
                <img alt="Pic" src="--[ProfilResmi]--" />
            </div>
        </div>
        <div id="--[Mesaj_id]--" class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px mesaj_metni">--[Mesaj]--</div>
    </div>
</template>

<style>
    .teklif_hizmet_kutusu[data-hizmet-id="0"] {
        display: none;
    }

    .teklif_menu{
        display: none;
    }

    .teklif_menu[data-teklif-durumu="1"]{
        display: inline-flex;
    }

    .teklif_bilgi{
        display: inline-flex;
        padding: 0 .5rem;
    }

    .teklif_bilgi[data-teklif-durumu="1"]::after {
        display: none;
    }

    .teklif_bilgi[data-teklif-durumu="1"] {
        display: none;
    }

    .teklif_bilgi[data-teklif-durumu="2"]::after {
        content: 'Teklif Kabul Edildi.';
        color: green;
        padding-left: .5rem;
    }

    .teklif_bilgi[data-teklif-durumu="2"]{
        color: green;
    }

    .teklif_bilgi[data-teklif-durumu="3"]::after {
        content: 'Teklif Red Edildi.';
        color: red;
        padding-left: .5rem;
    }

    .teklif_bilgi[data-teklif-durumu="3"]{
        color: red;
    }

    .teklif_bilgi[data-teklif-durumu="4"]::after {
        content: 'Teklif Iptal Edildi.';
        padding-left: .5rem;
    }

    .teklif_bilgi i {
        color: inherit;
        line-height: 1.5rem;
    }
    
</style>

<template id="GelenTeklifKutusu" style="display: none;">
    <div style="text-align: left;">
        --[TeklifMetni]--
        <br>
        <a class="teklif_hizmet_kutusu" data-hizmet-id="--[HizmetID]--" onclick="openHizmetPopup(this.dataset.href);" data-href="/--[hizmet_kategori_adi]--/--[HizmetAdi]--/--[HizmetID]--">
        <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3" style="float: left;">
                <div class="symbol-label hizmet_adi" style="background-image:url('--[HizmetKapakFotografi]--')"></div>
                <i></i>
            </div>
            <div class="navi-text" style="float: left;">
                <div class="font-weight-bold">--[HizmetAdi]--</div>
                <div class="text-muted" style="text-align: end;">
                    Size Özel: --[TeklifTutari]--₺
                </div>
            </div>
        </div>
        </a>
        <br>
        <div class="teklif_menu btn-group w-100" role="group" aria-label="Kabul_Ret" data-teklif-durumu="--[TeklifDurumuID]--">
            <button type="button" class="btn btn-success" data-teklif-id="--[TeklifID]--" onclick="TeklifKabul(this)">Kabul Et</button>
            <button type="button" class="btn btn-danger" data-teklif-id="--[TeklifID]--" onclick="TeklifRed(this)">Reddet</button>
        </div>
        <div class="teklif_bilgi" data-teklif-durumu="--[TeklifDurumuID]--"><i class="fas fa-info-circle mr-3"></i></div>
    </div>
</template>

<template id="GidenTeklifKutusu" style="display: none;">
    <div style="text-align: left;">
        --[TeklifMetni]--
        <br>
        <a class="teklif_hizmet_kutusu card" data-hizmet-id="--[HizmetID]--" onclick="openHizmetPopup(this.dataset.href);" data-href="/--[hizmet_kategori_adi]--/--[HizmetAdi]--/--[HizmetID]--">
        <div class="navi-link" style="padding: .5rem;">
            <div class="symbol symbol-40 bg-light mr-3" style="float: left;">
                <div class="symbol-label hizmet_adi" style="background-image:url('--[HizmetKapakFotografi]--')"></div>
                <i></i>
            </div>
            <div class="navi-text" style="float: left;">
                <div class="font-weight-bold">--[HizmetAdi]--</div>
                <div class="text-muted" style="text-align: end;">
                    Size Özel: --[TeklifTutari]--₺
                </div>
            </div>
        </div>
        </a>
        <br>
        <div class="teklif_menu btn-group w-100" role="group" aria-label="iptal" data-teklif-durumu="--[TeklifDurumuID]--">
            <button type="button" class="btn btn-secondary" data-teklif-id="--[TeklifID]--" onclick="TeklifIptal(this);">İptal Et</button>
        </div>
        <div class="teklif_bilgi" data-teklif-durumu="--[TeklifDurumuID]--"><i class="fas fa-info-circle"></i></div>
    </div>
</template>

<template id="RandevuKutusu" style="display: none;">
    <div style="text-align: left;">
        <a class="card" data-href="/Randevu/--[RandevuID]--">
            <div class="navi-link" style="padding: .5rem;">
                <div class="navi-text" style="float: left;">
                    <div class="font-weight-bold">--[Konu]--</div>
                    <div class="text-muted">
                        --[Aciklama]--
                    </div>
                </div>
            </div>
        </a>
        <br>
        <a href="/Randevu/--[RandevuID]--" class="btn-group w-100" role="group">
            <button type="button" class="btn btn-success" data-randevu-id="--[RandevuID]--" onclick="Katıl(this);">Katıl</button>
        </a>
    </div>
</template>

<?php if(getAktifRol() == "Hizmet Sağlayıcı"){ 
    include_once 'Servisler/Hizmet_saglayicilar.php';
    ?>
    <template id="TeklifForm" style="display: none;">
        <div class="d-flex flex-column mb-5 align-items-start">
            <div class="alert alert-primary" role="alert">
                Müşterinize ne vaat ettiğinizi özenle açıklayınız. Ayrıca dilerseniz mevcut hizmetlerinizden birini seçebilirsiniz.
            </div>

            <textarea id="Teklif_Metni" class="form-control mb-2" placeholder="Müşterinize ne vaat ettiğinizi özenle açıklayınız."></textarea>
            <input id="Teklif_Tutari" class="form-control mb-2" placeholder="Teklif Tutarı">
            <select id="hizmet_sec" class="form-control mb-2" style="display: none;">
                <option value="0">Hizmetlerinizden biri için özel bir teklifte bulunun.</option>
                <?php
                    $hizmetlerim = get_hizmet_saglayicilar_where(" kullanici_id = " . $kullanici['id']);
                    foreach($hizmetlerim as $hizmetim){ 
                    ?>
                    <option value="<?= $hizmetim['id'] ?>"><?= $hizmetim['adi'] ?></option>
                <?php } ?>
            </select>
            <button class="btn" style="font-size: x-small;" onclick="
                if($('#hizmet_sec')[0].style.display == 'none'){
                    $('#hizmet_sec')[0].style.display = 'block';
                    this.innerText = 'Hizmeti Kaldır';
                }else{
                    $('#hizmet_sec')[0].style.display = 'none';
                    $('#hizmet_sec').val('0').change();
                    this.innerText = 'Hizmet Seç';
                }
            ">Hizmet Seç</button>
        </div>
    </template>
<?php } ?>
<template id="goruntuluSohbetIstegiForm" style="display: none;">
        <div class="d-flex flex-column mb-5 align-items-start">
            <div class="alert alert-primary" role="alert">
                Randevuya davet oluşturmak için aşağıdaki formu doldurunuz.
            </div>
            <input type="datetime-local" id="zaman" value="<?php echo date('Y-m-d\TH:i'); ?>" class="form-control mb-2" placeholder="Randevu Zamanı">
            <input type="text" id="konu" class="form-control mb-2" placeholder="Görüşme Konusu">
            <textarea id="aciklama" class="form-control mb-2" placeholder="Açıklama"></textarea>
        </div>
</template>


<!--begin::Chat Panel-->
<div class="modal modal-sticky modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--begin::ChatCard-->
            <div id="ChatCard" class="card card-custom" style="display: none;">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-left flex-grow-1">
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown dropdown-inline">
                            <button id="dropdownMenuButton" type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="rehbereGit()">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </button>
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <div class="text-center flex-grow-1">
                        <div id="mesaj_kullanici_adi" class="text-dark-75 font-weight-bold font-size-h5">Kullanici Adı</div>
                        <div>
                            <span id="cevrimici_nokta" class="label label-dot"></span>
                            <span id="son_gorulme_metin" class="font-weight-bold text-muted font-size-sm">Kişi bilgisi bekleniyor... </span>
                        </div>
                    </div>
                    <div class="text-right flex-grow-1">
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-dismiss="modal">
                            <i class="ki ki-close icon-1x"></i>
                        </button>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div id="MesajlarScroll" class="scroll scroll-pull" data-height="375" data-mobile-height="300">
                        <!--begin::Messages-->
                        <div id="Mesajlar" class="messages">

                        </div>
                        <!--end::Messages-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer align-items-center">
                    <!--begin::Compose-->
                    <textarea id="chatArea" class="form-control border-0 p-0" rows="2" placeholder="Mesaj Yaz.."></textarea>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        <div class="mr-3">
                            <!-- <a href="#" class="btn btn-clean btn-icon btn-md mr-1">
                                <i class="flaticon2-photograph icon-lg"></i>
                            </a>
                            <a href="#" class="btn btn-clean btn-icon btn-md">
                                <i class="flaticon2-photo-camera icon-lg"></i>
                            </a> -->
                            <?php if(getAktifRol() == "Hizmet Sağlayıcı"){
                                ?>
                                <button id="teklifGonder" type="button" class="btn btn-md btn-light text-uppercase font-weight-bold py-2 px-6"><i class="fas fa-file-contract" aria-hidden="true"></i>Teklif Gönder</button>
                                <?php
                            } ?>
                            <button id="goruntuluSohbetIstegi" type="button" class="btn btn-md btn-light btn-md text-uppercase font-weight-bold py-2 px-6"><i class="fas fa-video" aria-hidden="true"></i></button>
                        </div>
                        <div>
                            <button id="charSendBtn" type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold py-2 px-6">Gönder</button>
                        </div>
                    </div>
                    <!--begin::Compose-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::ChatCard-->
            <!--begin::ContactCard-->
            <div id="ContactCard" class="card card-custom" style="display: block;">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-left flex-grow-1">

                            <!-- 
                            <button id="back" type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-icon-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                </span>
                            </button> -->


                    </div>
                    <div class="text-center flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5">Rehber</div>
                    </div>
                    <div class="text-right flex-grow-1">
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-dismiss="modal">
                            <i class="ki ki-close icon-1x"></i>
                        </button>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="scroll scroll-pull" data-height="375" data-mobile-height="300">
                    <div class="navi navi-spacer-x-0 p-0">
                        <style>
                            .okunmamis_mesaj_kullanici_icin .mesaj_count_badge {
                                background: #e71c1cf2;
                                border-radius: 6px;
                                padding: 0 4px;
                            }
                            .okunmamis_mesaj_kullanici_icin[data-count]::before  {
                                font-size: smaller;
                                content: "Okunmayı bekleyen " attr(data-count) " adet mesaj var";
                            }
                            .okunmamis_mesaj_kullanici_icin[data-count="0"]::before {
                                content: "Okunmayı bekleyen mesaj yok";
                            }
                        </style>
                        <?php
                            include('Servisler/Mesaj_Bildirim.php');
                            $kullanicilar = getKisiler($kullanici['id']);
                            foreach ($kullanicilar as $index => $mesaj_kullanici) {
                                ?>
                                    <a class="navi-item" onclick="mesajlara_git(this)"
                                        data-kullanici_id="<?= $mesaj_kullanici['id'] ?>"
                                        data-kullanici_adi="<?= $mesaj_kullanici['isim'] . " " . $mesaj_kullanici['soyisim'] ?>"
                                    >
                                        <div class="navi-link">
                                            <div class="symbol symbol-40 bg-light mr-3">
                                                <div class="symbol-label kullanici_adi" style="background-image:url('<?= isset($mesaj_kullanici['profil_resmi']) ? $mesaj_kullanici['profil_resmi'] : "assets/dashboard/media/users/default.jpg"; ?>')"></div>
                                                <!-- <i class="symbol-badge bg-success"></i> -->
                                            </div>
                                            <div class="navi-text">
                                                <div class="font-weight-bold"><?= $mesaj_kullanici['isim'] . " " . $mesaj_kullanici['soyisim'] ?></div>
                                                <div class="text-muted">
                                                    <b class="okunmamis_mesaj_kullanici_icin" data-count="<?= $mesaj_kullanici['okunmamis_mesaj_sayisi'] ?>" id="okunmamis_mesaj_sayisi_for_<?= $mesaj_kullanici['id'] ?>"></b>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                            }
                        ?>

                    </div>


                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::ContactCard-->
        </div>
    </div>

<script>
function mesajlari_getir(kullanici_id){
    $('#Mesajlar').html('');
    var form_data = new FormData();    
    form_data.append('kullanici_id', kullanici_id);

    $.ajax({
        type: "POST",
        url: "API/mesaj",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            data.sohbet.forEach(mesaj => {
               
                if(mesaj.gonderici_id == kullanici_id){
                    gelen_msg(mesaj);
                }else{
                    giden_msg(mesaj);
                }
                
            });

            son_gorulme_guncelle(data.mesajlasilan_kullanici.son_gorulme);
        }
    })
}

function son_gorulme_guncelle(tarih){
    let son_gorulme_ne_kadar_once = ne_kadar_once(tarih);
    if(son_gorulme_ne_kadar_once == "birkaç saniye önce"){
        $('#cevrimici_nokta').removeClass('label-secondary');
        $("#cevrimici_nokta").addClass("label-success");
        $('#son_gorulme_metin').text("Çevrimiçi");
    }else{
        $('#cevrimici_nokta').removeClass('label-success');
        $("#cevrimici_nokta").addClass("label-secondary");
        $('#son_gorulme_metin').text("Son görülme " + son_gorulme_ne_kadar_once);
    }
}

function mesajlara_git(elem){
    $("#mesaj_kullanici_adi").text(elem.dataset.kullanici_adi);
    $("#mesaj_kullanici_adi")[0].dataset.kullanici_id = elem.dataset.kullanici_id;
    $("#cevrimici_nokta").addClass("label-secondary");
    $("#Mesajlar")[0].dataset.kullanici_id = elem.dataset.kullanici_id;
    $("#ChatCard")[0].style.display = "block";
    $("#ContactCard")[0].style.display = "none";
    mesajlari_getir(elem.dataset.kullanici_id);
}

function rehbereGit(){
    $("#mesaj_kullanici_adi").text("");
    $("#mesaj_kullanici_adi")[0].dataset.kullanici_id = 0;
    $("#Mesajlar")[0].dataset.kullanici_id = 0;

    $("#ContactCard")[0].style.display = "block";
    $("#ChatCard")[0].style.display = "none";
}

$("#chatArea").on('keypress', function (e) {
    var key = e.which;
    if(key == 13) { // Enter
        msg_gonder(e.target.value, $("#Mesajlar")[0].dataset.kullanici_id);
        e.target.value = "";
    }
});

$("#charSendBtn").on('click', function (e){
    msg_gonder($('#chatArea')[0].value, $("#Mesajlar")[0].dataset.kullanici_id);
    $('#chatArea')[0].value = "";
})

$("#goruntuluSohbetIstegi").on('click', function (e){
    var goruntuluSohbetIstegiForm = $('#goruntuluSohbetIstegiForm').prop('content').firstElementChild.cloneNode(true);
    swal({
        content: goruntuluSohbetIstegiForm,
        button: {
            text: "İstek Gönder!",
            closeModal: false,
        },
    }).then(teklif => {
        if (!teklif) throw null;
        let gorusme_zamani = $('#zaman').val()
        let gorusme_konusu = $('#konu').val()
        let gorusme_aciklamasi = $('#aciklama').val()
        var form_data = new FormData();    
        form_data.append('zaman', gorusme_zamani);
        form_data.append('konu', gorusme_konusu);
        form_data.append('aciklama', gorusme_aciklamasi);
        form_data.append('alici_id', $("#Mesajlar")[0].dataset.kullanici_id);
        return $.ajax({
            type: "POST",
            url: "API/RandevuOlustur",
            data: form_data,
            processData: false,
            contentType: false,
            success: function (data) {
                if(data.durum == "Hata"){
                    swal({
                        title: "Hata!",
                        text: data.mesaj,
                        icon: "error",
                        timer: 1337
                    });
                }else if(data.durum == "Başarılı"){
                    giden_msg(data.gonderilen_randevu);
                    swal({
                        title: "Başarılı!",
                        text: data.mesaj,
                        icon: "success",
                        timer: 1337
                    })
                    // .then(function() {
                    //     if ('yonlendirme' in data) location.href = data.yonlendirme;
                    // });
                }
            }
        });
    })
    // msg_gonder($('#chatArea')[0].value, $("#Mesajlar")[0].dataset.kullanici_id);
    // $('#chatArea')[0].value = "";
})

$("#teklifGonder").on('click', function (e){
    var TeklifForm = $('#TeklifForm').prop('content').firstElementChild.cloneNode(true);
    swal({
        content: TeklifForm,
        button: {
            text: "Teklif Et!",
            closeModal: false,
        },
    }).then(teklif => {
        if (!teklif) throw null;
        let hizmet_id = $('#hizmet_sec').val()
        let teklif_metni = $('#Teklif_Metni').val()
        let teklif_tutari = $('#Teklif_Tutari').val()
        var form_data = new FormData();    
        form_data.append('hizmet_id', hizmet_id);
        form_data.append('teklif_metni', teklif_metni);
        form_data.append('teklif_tutari', teklif_tutari);
        form_data.append('alici_id', $("#Mesajlar")[0].dataset.kullanici_id);
        return $.ajax({
            type: "POST",
            url: "API/TeklifGonder",
            data: form_data,
            processData: false,
            contentType: false,
            success: function (data) {
                if(data.durum == "Hata"){
                    swal({
                        title: "Hata!",
                        text: data.mesaj,
                        icon: "error",
                        timer: 1337
                    });
                }else if(data.durum == "Başarılı"){
                    giden_msg(data.gonderilen_teklif);
                    swal({
                        title: "Başarılı!",
                        text: data.mesaj,
                        icon: "success",
                        timer: 1337
                    })
                    // .then(function() {
                    //     if ('yonlendirme' in data) location.href = data.yonlendirme;
                    // });
                }
            }
        });
    })
    // msg_gonder($('#chatArea')[0].value, $("#Mesajlar")[0].dataset.kullanici_id);
    // $('#chatArea')[0].value = "";
})


var source = new EventSource("/API/mesaj_stream");

function setOkunmamisMesajSayisi(sayi){
    $('#okunmamis_mesaj_sayisi')[0].dataset.count = sayi;
}

function mesaj_goruldu(mesaj){
    var form_data = new FormData();    
    form_data.append('mesaj_id', mesaj.id);

    $.ajax({
        type: "POST",
        url: "API/mesaj_goruldu",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            
        }
    })
}

source.addEventListener("okunmamis_mesaj_sayaci", function(event) {
    let data = JSON.parse(event.data);
    data.kisiler.forEach(kisi => {
        $('#okunmamis_mesaj_sayisi_for_'+kisi.id)[0].dataset.count = kisi.okunmamis_mesaj_sayisi;
    });
});

source.addEventListener("teklif_guncellendi", function(event) {
    let data = JSON.parse(event.data);
    console.log('guncelleme')
    data.guncellenen_teklifler.forEach(teklif => {
        getTeklif('Mesaj_'+teklif.id, true)
    });
});

// source.addEventListener("okunmamis_mesaj_sayisi", function(event) {
//     let data = JSON.parse(event.data);
//     setOkunmamisMesajSayisi(data.okunmamis_mesaj_sayisi);
// });

// source.addEventListener("mesajlar", function(event) {
//     let data = JSON.parse(event.data);
//     data.mesajlar.forEach(mesaj => {
//         if(mesaj.gonderici_id == $("#mesaj_kullanici_adi")[0].dataset.kullanici_id){
//             gelen_msg(mesaj);
//             mesaj_goruldu(mesaj);
//         }
//     });
// });
function cevrimici_mi(sorgulanacak_kullanici_id){
    var form_data = new FormData();    
    form_data.append('sorgulanacak_kullanici_id', sorgulanacak_kullanici_id);

    $.ajax({
        type: "POST",
        url: "API/cevrimici_mi",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            son_gorulme_guncelle(data.sorgulanan_kullanici.son_gorulme)
        }
    })
}

var son_gorulme_stream_sayici = 0;
source.onmessage = function(event) {
    let data = JSON.parse(event.data);
    let mesajlar = data.mesajlar;
    if(mesajlar.length > 0){
        mesajlar.forEach(mesaj => {
            if(mesaj.gonderici_id == $("#mesaj_kullanici_adi")[0].dataset.kullanici_id){
                gelen_msg(mesaj);
                mesaj_goruldu(mesaj);
                data.okunmamis_mesaj_sayisi -= 1;
            }
        });
    }
    setOkunmamisMesajSayisi(data.okunmamis_mesaj_sayisi);
    son_gorulme_stream_sayici += 1;
    if(son_gorulme_stream_sayici % 10 == 0){
        cevrimici_mi($("#mesaj_kullanici_adi")[0].dataset.kullanici_id);
    }
}; 

function msg_gonder(mesaj, alici_id){
    // let data = {
    //     "msg": mesaj,
    //     "alici_id": alici_id,
    // }
    // socket.emit('message2user',  JSON.stringify(data));

    var form_data = new FormData();    
    form_data.append('mesaj', mesaj);
    form_data.append('alici_id', alici_id);

    $.ajax({
        type: "POST",
        url: "API/mesaj_gonder",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            giden_msg(data.gonderilen_mesaj);
        }
    })
}

function parametreleri_ekle(template_id, data_obj) {
    let temp = $('#'+template_id).html()
    Object.keys(data_obj).forEach((key) => {
        temp = temp.replaceAll("--[" + key + "]--", data_obj[key]);
    });

    return temp;
}

function element_olustur(template_id, data_obj) {
    let temp_html = parametreleri_ekle(template_id, data_obj);
    let temp = document.createElement("template");
    temp.innerHTML = temp_html;
    return temp.content.firstElementChild;
}

function ne_kadar_once(time_str){
    return moment(time_str).locale('tr').fromNow();
}

function openHizmetPopup(link){
    var icerik = document.createElement('div');
    icerik.id = 'hizmet_popup';
    document.getElementById('gorunmez_alan').appendChild(icerik);

    $("#hizmet_popup").load(encodeURIComponent(link))

    swal({
        content: $("#hizmet_popup")[0],
        button: {
            text: "Kapat!",
        },
    })
}

function getTeklif(mesaj_element_id, updated){
    var updated = (typeof updated !== 'undefined') ? updated : false;

    var form_data = new FormData();    
    let mesaj_id = mesaj_element_id.replace('Mesaj_','');
    form_data.append('mesaj_id', mesaj_id);

    $.ajax({
        type: "POST",
        url: "API/teklif_getir",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data)
            $('#'+mesaj_element_id)[0].innerText = '';
            if(data.teklif.gonderici_id == '<?= $kullanici['id'] ?>'){
                var teklifKutusu = element_olustur('GidenTeklifKutusu', {
                    'TeklifMetni': data.teklif.teklif_metni,
                    'TeklifTutari': data.teklif.teklif_tutari,
                    'HizmetAdi': data.teklif.hizmet_adi,
                    'HizmetID': data.teklif.hizmet_id,
                    'HizmetKapakFotografi': data.teklif.hizmet_kapak_fotografi,
                    'hizmet_kategori_adi': data.teklif.hizmet_kategori_adi,
                    'TeklifDurumuID': data.teklif.teklif_durumu,
                    'TeklifID': data.teklif.teklif_id
                })
            }else{
                var teklifKutusu = element_olustur('GelenTeklifKutusu', {
                    'TeklifMetni': data.teklif.teklif_metni,
                    'TeklifTutari': data.teklif.teklif_tutari,
                    'HizmetAdi': data.teklif.hizmet_adi,
                    'HizmetID': data.teklif.hizmet_id,
                    'HizmetKapakFotografi': data.teklif.hizmet_kapak_fotografi,
                    'hizmet_kategori_adi': data.teklif.hizmet_kategori_adi,
                    'TeklifDurumuID': data.teklif.teklif_durumu,
                    'TeklifID': data.teklif.teklif_id
                })
            }
            $('#'+mesaj_element_id)[0].appendChild(teklifKutusu);
            $("#MesajlarScroll").scrollTop( $( "#MesajlarScroll" ).prop( "scrollHeight" ) );
            // Şimdi ekleyeceğim komut ile getirilen teklife kaydırılır.
            if(updated){
                scrollToMesaj(mesaj_element_id);
            }


        }
    })
}

function getRandevu(mesaj_element_id, updated){
    var updated = (typeof updated !== 'undefined') ? updated : false;

    var form_data = new FormData();    
    let mesaj_id = mesaj_element_id.replace('Mesaj_','');
    form_data.append('mesaj_id', mesaj_id);

    $.ajax({
        type: "POST",
        url: "API/RandevuGetir",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data)
            $('#'+mesaj_element_id)[0].innerText = '';
            
            var randevuKutusu = element_olustur('RandevuKutusu', {
                'Konu': data.randevu.konu,
                'Aciklama': data.randevu.aciklama,
                'RandevuID': data.randevu.randevu_id,
            })
            
            $('#'+mesaj_element_id)[0].appendChild(randevuKutusu);
            $("#MesajlarScroll").scrollTop( $( "#MesajlarScroll" ).prop( "scrollHeight" ) );
            // Şimdi ekleyeceğim komut ile getirilen teklife kaydırılır.
            if(updated){
                scrollToMesaj(mesaj_element_id);
            }


        }
    })
}

function scrollToMesaj(mesaj_id){
    var scrollHeightSum = 0;
    $('#Mesajlar > div').each(i => {
        if($('#Mesajlar > div:nth-child('+i+') .mesaj_metni').length != 0) {
            if($('#Mesajlar > div:nth-child('+i+') .mesaj_metni').attr('id') != mesaj_id){
                scrollHeightSum+=$('#Mesajlar > div:nth-child('+i+')')[0].scrollHeight
            }else{
                scrollHeightSum+=$('#Mesajlar > div:nth-child('+i+')')[0].scrollHeight
                return false;
            }
        }
    })
    $("#MesajlarScroll").scrollTop( scrollHeightSum + $('#'+mesaj_id)[0].parentElement.parentElement.scrollHeight);
}

function TeklifIptal(elem){
    var form_data = new FormData();    
    form_data.append('teklif_id', elem.dataset.teklifId);

    $.ajax({
        type: "POST",
        url: "API/teklif_iptal",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            if(data.durum == 'success'){
                elem.parentElement.dataset.teklifDurumu = 4
                elem.parentElement.nextElementSibling.dataset.teklifDurumu = 4
            }
        }
    })
}

function TeklifKabul(elem){
    var form_data = new FormData();    
    form_data.append('teklif_id', elem.dataset.teklifId);

    $.ajax({
        type: "POST",
        url: "API/teklif_kabul",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            if(data.durum == 'success'){
                elem.parentElement.dataset.teklifDurumu = 2
                elem.parentElement.nextElementSibling.dataset.teklifDurumu = 2
            }
        }
    })
}

function TeklifRed(elem){
    var form_data = new FormData();    
    form_data.append('teklif_id', elem.dataset.teklifId);

    $.ajax({
        type: "POST",
        url: "API/teklif_red",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
            if(data.durum == 'success'){
                elem.parentElement.dataset.teklifDurumu = 3
                elem.parentElement.nextElementSibling.dataset.teklifDurumu = 3
            }
        }
    })
}

function gelen_msg(mesaj) {
    if(mesaj.gonderici_profil_resmi == null){
        mesaj.gonderici_profil_resmi = "assets/dashboard/media/users/default.jpg";
    }
    var element = element_olustur('gelenMesaj', {'Mesaj_id': 'Mesaj_' + mesaj.id, 'ProfilResmi': mesaj.gonderici_profil_resmi, 'KullaniciAdi': mesaj.gonderici_isim + " " + mesaj.gonderici_soyisim, 'MesajZamani': mesaj.olusturma_zamani, 'Ne_Kadar_Once': ne_kadar_once(mesaj.olusturma_zamani), 'Mesaj': mesaj.metin});

    if(mesaj.ek_turu_adi == "Teklif"){
        getTeklif('Mesaj_' + mesaj.id);
    }else if(mesaj.ek_turu_adi == "Randevu"){
        getRandevu('Mesaj_' + mesaj.id);
    }

    $('#Mesajlar')[0].appendChild(element);
    $("#MesajlarScroll").scrollTop( $( "#MesajlarScroll" ).prop( "scrollHeight" ) );
};

function giden_msg(mesaj) {
    console.log(mesaj);
    if(mesaj.gonderici_profil_resmi == null){
        mesaj.gonderici_profil_resmi = "assets/dashboard/media/users/default.jpg";
    }

    var element = element_olustur('gidenMesaj', {'Mesaj_id': 'Mesaj_' + mesaj.id, 'ProfilResmi': mesaj.gonderici_profil_resmi, 'KullaniciAdi': mesaj.gonderici_isim + " " + mesaj.gonderici_soyisim, 'MesajZamani': mesaj.olusturma_zamani, 'Ne_Kadar_Once': ne_kadar_once(mesaj.olusturma_zamani), 'Mesaj': mesaj.metin});

    if(mesaj.ek_turu_adi == "Teklif"){
        getTeklif('Mesaj_' + mesaj.id);
    }else if(mesaj.ek_turu_adi == "Randevu"){
        getRandevu('Mesaj_' + mesaj.id);
    }

    $('#Mesajlar')[0].appendChild(element);
    $("#MesajlarScroll").scrollTop( $( "#MesajlarScroll" ).prop( "scrollHeight" ) );
};
</script>

</div>
<!--end::Chat Panel-->