<?php include('Servisler/Hizmet_saglayicilar.php'); ?>
<?php
    $grafiker_id = $_GET['grafiker_id'];
    $grafiker = get_hizmet_saglayicilar_where(" id = " . $grafiker_id)[0];

    $baslik = $grafiker['adi'] . " Hizmeti";
    
    define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if(IS_AJAX_REQUEST) {
        $sablon = "bos";
    }
    else {
        $sablon = "GostergePaneli";
    }
?>