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


<?php
    $alt_hizmetler = array_filter($hizmetler, function($v, $k) {
        global $ust_id;
        return $v['ust_id'] == $ust_id;
    }, ARRAY_FILTER_USE_BOTH);

    if(count($alt_hizmetler) != 0){
        ?> <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4" style=""> <?php
        foreach ($alt_hizmetler as $hizmet) {
            ?>
                <div class="col">
                    <?= hizmet_card($hizmet) ?>
                </div>
            <?php
        }
        ?> </div> <?php
    }else{
        include "sayfalar/Hizmetler/Hizmet_Sağlayici.kayit.php";
    }
?>

<!-- 
<?php 
// if(count($secili_hizmet) != 0){
//     if(file_exists("sayfalar/Hizmetler/" . $secili_hizmet[0]['hizmet_adi'] . ".kayit.php")){
//         include "sayfalar/Hizmetler/" . $secili_hizmet[0]['hizmet_adi'] . ".kayit.php";
//     }
// }
?> -->