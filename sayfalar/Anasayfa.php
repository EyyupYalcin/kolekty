<?php include bilesen('hizmet_grid'); ?>
<div class="text-center">

    <?= hizmet_grid() ?>

    <div class="row">
        <div class="col-lg-4">
            <!--begin::List Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="flex-grow-1 p-12 pb-40 card-rounded flex-grow-1" style="">
                    <h3 class=" pb-5 font-weight-bolder">Kolekty</h3>
                    <hr>
                    <p class=" pb-5 font-size-h6">
                        En kaliteli hizmet sağlayıcıyı bul
                        <br>İletişime geç
                        <br>Randevu al
                    </p>
                    <a href="/KayitOl" class="btn btn-primary font-weight-bold py-2 px-6">Hemen Üye Ol</a>
                </div>

            </div>
            <!--end:List Widget 4-->
        </div>
        <div class="col-lg-8">
            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom card-stretch gutter-b">

                <!--begin::Body-->
                <div class="card-body mt-n3">
                    <video controls style="width: 100%;">
                        <source src="/assets/kolekty_tanitim.mp4" type="video/mp4" />
                    </video>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 2-->
        </div>
    </div>


    <script src="~assets/dashboard/js/pages/custom/wizard/wizard-3.js"></script>
</div>