<?php include bilesen('hizmet_card'); ?>
<?php
$ust_id = isset($_GET['hizmet_id']) ? $_GET['hizmet_id'] : 0;
$secili_hizmet = get_Hizmetler_where("id = " . $ust_id);
?>

<?php
if($ust_id == 0){
?>
    <div class="alert alert-info mt-4" role="alert">
    Vermek istediğiniz hizmeti seçiniz
    </div>
<?php
}else{
?>
    <div class="alert alert-info mt-4" role="alert">
    Seçili Hizmet: <?= $secili_hizmet[0]['hizmet_adi'] ?>
    </div>
<?php
}
?>


<div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4" style="">
<?php
    $alt_hizmetler = array_filter($hizmetler, function($v, $k) {
        global $ust_id;
        return $v['ust_id'] == $ust_id;
    }, ARRAY_FILTER_USE_BOTH);
    foreach ($alt_hizmetler as $hizmet) {
        ?>
            <div class="col">
                <?= hizmet_card($hizmet) ?>
            </div>
        <?php
    } ?>
</div>

<?php 
if(count($secili_hizmet) != 0){
?>
    <div class="card card-custom gutter-b mt-8">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    <?= $secili_hizmet[0]['hizmet_adi'] ?> Hizmet Sağlayıcı Başvuru Formu
                    <small></small>
                </h3>
            </div>
        </div>
        <div class="card-body">
            <?php include bilesen('adres_sec'); ?>
        </div>
        <div class="card-footer">
            <?php 
                Form::render('AjaxPostButton', [
                    "id" => "KayitTamamla",
                    "metin" => "Kaydet",
                    "API" => "API/MusteriKayit",
                ]);
            ?>
        </div>
    </div>
<?php
}
?>
