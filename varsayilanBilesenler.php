<?php
    //varsayılan şablon
    //$sablon = (isset($sablon) && $sablon != 'bos' && !empty($sablon) && $sablon != "") ? $sablon : $varsayilan_sablon;
    if(!isset($sablon_bilesenleri)){
        $varsayilanBilesenler = [
            "bos" => [],
            "AdminLTE" => ['navbar', 'sidebar', 'breadcrumb', 'controlSidebar', 'footer'],
            "GostergePaneli" => ['SayfaUst', 'SayfaAlt', 'MobilUst'],
        ];
        
        $sablon_bilesenleri = $varsayilanBilesenler[$sablon];
    }