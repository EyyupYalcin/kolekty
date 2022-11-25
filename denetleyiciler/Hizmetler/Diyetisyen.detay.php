<?php include('Servisler/Hizmet_saglayicilar.php'); ?>
<?php
    $diyetisyen_id = $_GET['diyetisyen_id'];
    $diyetisyen = get_hizmet_saglayicilar_where(" id = " . $diyetisyen_id)[0];

    $baslik = $diyetisyen['adi'] . " Diyetisyenlik Hizmeti";
    
    define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if(IS_AJAX_REQUEST) {
        $sablon = "bos";
    }
    else {
        $sablon = "GostergePaneli";
    }
?>