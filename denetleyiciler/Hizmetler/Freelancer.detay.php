<?php include('Servisler/Hizmet_saglayicilar.php'); ?>
<?php
    $freelancer_id = $_GET['freelancer_id'];
    $freelancer = get_hizmet_saglayicilar_where(" id = " . $freelancer_id)[0];

    $baslik = $freelancer['adi'] . " Diyetisyenlik Hizmeti";
    
    define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if(IS_AJAX_REQUEST) {
        $sablon = "bos";
    }
    else {
        $sablon = "GostergePaneli";
    }
?>