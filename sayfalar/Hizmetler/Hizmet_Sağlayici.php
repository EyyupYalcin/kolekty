<?php include bilesen('hizmet_saglayici_list_element'); ?>
<?php include bilesen('hizmet_saglayici_card'); ?>
<style>
.kisa_metin{
    height: 54px;
    line-height: 18px;
}
</style>
<div class=" text-left"> <?php // container class'ı sildim çünkü yatay padding'den dolayı hizza bozuluyordu ?>
<?php if(!IS_AJAX_REQUEST){
    ?>
        <div class="card mb-6 d-flex flex-row">
            
            <div class="filtreler card-body mx-2 py-2 d-flex align-items-start flex-rows scroll scroll-pull horizontal_scroll" data-scroll="true" data-suppress-scroll-x="false" data-suppress-scroll-y="true">				
                <?php
			    foreach ($aranan_uzmanliklar as $key => $uzmanlik_alani) {
                    if(in_array($uzmanlik_alani, array_map(function($v){ return $v['adi']; }, $uzmanlik_alanlari_liste))){
                        ?>
                        <div data-uzmanlik-adi="<?= $uzmanlik_alani ?>" class="btn btn-sm btn-light m-1 text-nowrap uzmanlik_alani_filtre_sil">
                            <i class="fa fa-times text-danger" data-uzmanlik-adi="<?= $uzmanlik_alani ?>" style="font-size: 1rem !important;"></i>
                            <?= $uzmanlik_alani ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                foreach ($uzmanlik_alanlari_liste as $key => $uzmanlik_alani) {
                    if(!in_array($uzmanlik_alani['adi'], $aranan_uzmanliklar)){
                        ?>
                            <div data-uzmanlik-adi="<?= $uzmanlik_alani['adi'] ?>" class="btn btn-sm btn-light m-1 text-nowrap uzmanlik_alani_filtrele">
                                <?= $uzmanlik_alani['adi'] ?>
                            </div>
                        <?php
                    }
                }
                ?>
                <script>
                    function parsedUrlToString(){
                        let pathname = location.origin
                        Object.keys(this).forEach((key) => {
                            if(typeof this[key] === "string")
                            pathname += "/" + key + "/" + this[key]
                        })
                        return pathname;
                    }

                    function urlParse(){
                        let parsedUrl = decodeURI(location.pathname).substring(1).split('/');
                        parsedUrl = Object.assign({}, ...parsedUrl.map((x, i) =>{
                            if(i % 2 == 0){
                                return {[x]: parsedUrl[i+1]}
                            }
                        }));
                        parsedUrl.toString = parsedUrlToString;

                        return parsedUrl
                    }


                
                    $('.uzmanlik_alani_filtrele').on('click', function(event) {
                        let uzmanlik_adi = event.target.dataset.uzmanlikAdi;
                        let parsedUrl = urlParse();
                        if(parsedUrl.hasOwnProperty('filtrele')){
                            parsedUrl['filtrele'] += "-ve-"+uzmanlik_adi
                        }else{
                            parsedUrl['filtrele'] = uzmanlik_adi;
                        }
                        location.href = parsedUrl
                    })

                    $('.uzmanlik_alani_filtre_sil').on('click', function(event) {
                        let uzmanlik_adi = event.target.dataset.uzmanlikAdi;
                        let parsedUrl = urlParse();
                        parsedUrl['filtrele'].replace()
                        if(parsedUrl['filtrele'].indexOf('-ve-' + uzmanlik_adi) != -1){
                            parsedUrl['filtrele'] = parsedUrl['filtrele'].replace('-ve-' + uzmanlik_adi, '');
                        }else if(parsedUrl['filtrele'].indexOf(uzmanlik_adi) != -1){
                            parsedUrl['filtrele'] = parsedUrl['filtrele'].replace(uzmanlik_adi, '');
                            if(parsedUrl['filtrele'].indexOf('-ve-') == 0){
                                parsedUrl['filtrele'] = parsedUrl['filtrele'].replace('-ve-', '')
                            }
                        }
                        if(parsedUrl['filtrele'] == ""){
                            delete parsedUrl['filtrele'];
                        }
                        location.href = parsedUrl
                    })

                    // mousewheel eventini manipüle ederek axisleri değiştirir. Siz tekerleği aşağı çevirirsiniz scroll yönü sağa doğru olur.
                    $('.horizontal_scroll').on('mousewheel', (e) => {
                        $(e.target).closest('.horizontal_scroll')[0].scrollLeft += e.deltaY * - 25;
                    })

                </script>
            </div>

            <div class="d-flex py-2">
                <?php
                // <div class="btn-group">
                //     <button type="button" class="ilan-tip-menu btn btn-sm btn-light my-1 text-nowrap dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hizmetler</button>
                //     <div class="dropdown-menu">
                //         <button data-ilan-tip="Hizmetler" class="ilan_tip dropdown-item">Hizmetler</button>
                //         <button data-ilan-tip="İlanlar" class="ilan_tip dropdown-item">İlanlar</button>
                //     </div>
                // </div>
                // <script>
                //     $('.ilan_tip').on('click', function(e){
                //         let ilanTip = e.target.dataset.ilanTip;
                //         $(e.target).closest('.ilan-tip-menu').innerText = ilanTip
                //         let parsedUrl = urlParse();
                //         location.href = parsedUrl.toString().replace(Object.keys(parsedUrl)[0], ilanTip)
                //     })
                // </script>
                ?>

                <div class="mx-2 btn-group" role="group">
                    <button data-list-type="list" class="change_list_type btn btn-sm btn-light my-1 text-nowrap <?= isset($_GET['liste_tip']) && $_GET['liste_tip'] == "list" ? "active" : "" ?>"><i class="fa fa-th-list"></i></button>
                    <button data-list-type="grid" class="change_list_type btn btn-sm btn-light my-1 text-nowrap <?= isset($_GET['liste_tip']) && $_GET['liste_tip'] == "grid" ? "active" : "" ?>"><i class="fa fa-th-large"></i></button>
                </div>
                <script>
                    $('.change_list_type').on('click', function(e){
                        let type = $(e.target).closest('.change_list_type')[0].dataset.listType
                        let parsedUrl = urlParse();
                        parsedUrl['liste_tip'] = type;
                        location.href = parsedUrl
                    });
                </script>
            </div>
        </div>
    <?php
} ?>

<!-- <div class="row spcbt-30">
    <div class="col-lg-4 col-sm-6 sorter"> 
        <ul class="nav-tabs tabination view-tabs">
            <li class="active">
                <a href="#grid-view" data-toggle="tab">                                                    
                    <i class="fa fa-th" aria-hidden="true"></i>
                </a>
            </li>
            <li class="">
                <a href="#list-view" data-toggle="tab">
                    <i class="fa fa-th-list"></i>
                </a>
            </li>
        </ul>
        <form action="#" class="sorting-form">
            <div class="search-selectpicker selectpicker-wrapper">
                <div class="btn-group bootstrap-select input-price" style="width: 100%;"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" title="Sort By" aria-expanded="false"><span class="filter-option pull-left">Sort By</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" style="max-height: 371.6px; overflow: hidden; min-height: 136px;"><div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"></div><ul class="dropdown-menu inner" role="menu" style="max-height: 315.6px; overflow-y: auto; min-height: 80px;"><li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Sort by popularity</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Sort by average rating</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Sort by newness</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="4"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Sort by price: low to high</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="5"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Sort by price: high to low</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div><select class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Sort By" tabindex="-98"><option class="bs-title-option" value="">Sort By</option>                                           
                    <option value="popularity">Sort by popularity</option>
                    <option value="rating">Sort by average rating</option>
                    <option value="date">Sort by newness</option>
                    <option value="price">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                </select></div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 col-sm-6 woocommerce-result-count">  SHOW 24 ITEMS TOTAL OF 120 ITEMS </div>

    <div class="col-lg-4 col-sm-12 col-xs-12 view-wrap">
        <div class="right products-number-selector">
            <span>View All</span>
            <span><a href="?productnumber=9" class="highlight-selector">9</a></span>
            <span><a href="?productnumber=12">12</a></span>
            <span><a href="?productnumber=24">24</a></span>
        </div>

    </div>
</div> -->
    <?php if(count($hizmet_saglayicilar) != 0){ ?>
    <?php // aslında aşadaki row-cols-lg-2 değil 4 dü ama onu 2 yaparak list element'i card gibi kullandım her satırda iki tane koyuo böyleyken ?>
    <div class="<?php if($_GET['liste_tip'] == "grid"){echo "row mx-1 row-cols-1 row-cols-lg-2 row-cols-md-2 g-4 mt-2";} ?>" style="">
        <?php 
            foreach ($hizmet_saglayicilar as $hizmet_saglayici) {
                if($_GET['liste_tip'] == "card"){
                    ?>
                    <div class="col">
                        <?= hizmet_saglayici_list_element($hizmet['hizmet_adi'], $hizmet_saglayici) ?>
                    </div>
                    <?php
                }else{
                    ?>
                        <?= hizmet_saglayici_list_element($hizmet['hizmet_adi'], $hizmet_saglayici) ?>
                    <?php
                }
                ?>
                <?php
            }
        ?>
    </div>
    <?php 
        }else{
            ?>
                <div class="card">
                    <div class="card-body">Bu alanda hizmet veren kullanıcımız yok :(</div>
                </div>
            <?php
        }
    ?>
</div>