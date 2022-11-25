        <style>

        .col-row-responsive {

            flex-direction: row;

        }

        @media only screen and (max-width: 600px) {

            .col-row-responsive {

                flex-direction: column;

                align-items: start !important

            }

            .copyright {

                margin-top: 0.5rem;

            }

            .footer {

 

            }

        }

        </style>

<!--begin::Footer-->

<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">

    <!--begin::Container-->

    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between col-row-responsive">

        <!--begin::Copyright-->

        <div class="text-dark order-2 order-md-1 pl-3 copyright">

            <span class="text-muted font-weight-bold mr-2"> &copy;</span>

            <a href="" target="_blank" class="text-dark-75 text-hover-primary">Kolekty</a>

            <span class="text-muted font-weight-bold mr-2">2021 - <?= date("Y"); ?></span>

            

        </div>

        <!--end::Copyright-->

        <!--begin::Nav-->



        <div class="nav nav-dark order-1 order-md-2 col-row-responsive">

            <a href="kolekty_hakkinda" target="_blank" class="nav-link pl-3">Kolekty Hakkında</a>

            <a href="teslimat_ve_iade" target="_blank" class="nav-link px-3">Teslimat ve İade</a>

            <a href="gizlilik_politikasi" target="_blank" class="nav-link pl-3">Gizlilik politikası</a>

            <!-- <a href="mesafeli_satis_sozlesmesi" target="_blank" class="nav-link pl-3">Mesafeli Satış Sözleşmesi</a> -->

            <img class="pl-3" src="/assets/master_card_visa.svg" style="width: 150px;">

        </div>

        <!--end::Nav-->

    </div>

    <!--end::Container-->

</div>

<!--end::Footer-->



<!--Start of Tawk.to Script-->

<script type="text/javascript">

var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

(function(){

var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

s1.async=true;

s1.src='https://embed.tawk.to/622de40fa34c2456412ad0ff/1fu1k5nl1';

s1.charset='UTF-8';

s1.setAttribute('crossorigin','*');

s0.parentNode.insertBefore(s1,s0);

})();

</script>

<!--End of Tawk.to Script-->