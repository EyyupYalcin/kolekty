<?php include('Servisler/Hizmet_saglayicilar.php'); ?>
<?php
    $baslik = "Grafiker Servis Sağlayıcılar";

    define('IS_AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if(IS_AJAX_REQUEST) {
        $sablon = "bos";
    }
    else {
        $sablon = "GostergePaneli";
    }

    $grafikerler = get_hizmet_saglayicilar_where(" hizmet_id = 13");
?>