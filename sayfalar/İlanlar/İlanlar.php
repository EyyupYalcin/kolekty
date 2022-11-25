<?php include bilesen('ilan_list_element'); ?>
<style>
.kisa_metin{
    height: 54px;
    line-height: 18px;
}
</style>
<div class="container text-left">
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
                <div class="btn-group">
                    <button type="button" class="ilan-tip-menu btn btn-sm btn-light my-1 text-nowrap dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İlanlar</button>
                    <div class="dropdown-menu">
                        <button data-ilan-tip="Hizmetler" class="ilan_tip dropdown-item">Hizmetler</button>
                        <button data-ilan-tip="İlanlar" class="ilan_tip dropdown-item">İlanlar</button>
                    </div>
                </div>
                <script>
                    $('.ilan_tip').on('click', function(e){
                        let ilanTip = e.target.dataset.ilanTip;
                        $(e.target).closest('.ilan-tip-menu').innerText = ilanTip
                        let parsedUrl = urlParse();
                        location.href = parsedUrl.toString().replace(Object.keys(parsedUrl)[0], ilanTip)
                    })
                </script>


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

    <?php if(count($ilanlar) != 0){ ?>
    <?php // aslında aşadaki row-cols-lg-2 değil 4 dü ama onu 2 yaparak list element'i card gibi kullandım her satırda iki tane koyuo böyleyken ?>
    <div class="<?php if($_GET['liste_tip'] == "grid"){echo "row mx-1 row-cols-1 row-cols-lg-2 row-cols-md-2 g-4 mt-2";} ?>" style="">
        <?php 
            foreach ($ilanlar as $ilan) {
                if($_GET['liste_tip'] == "card"){
                    ?>
                    <div class="col">
                        <?= ilan_list_element($hizmet['hizmet_adi'], $ilan) ?>
                    </div>
                    <?php
                }else{
                    ?>
                        <?= ilan_list_element($hizmet['hizmet_adi'], $ilan) ?>
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
                    <div class="card-body">İlan bulunamadı :(</div>
                </div>
            <?php
        }
    ?>
</div>