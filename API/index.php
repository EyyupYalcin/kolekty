<?php session_start(); ?>
<?php include('../yapilandirma.php'); ?>
<?php include('Temel_API.php'); ?>
<?php include('../yonlendirmeler.php'); ?>
<?php if(oturumAcikMi()) $kullanici = $_SESSION['kullanici']; ?>
<?php if(oturumAcikMi()) kullanici_goruldu($kullanici['id']);?>
<?php
    $rol = getAktifRol();
    if(isset($api_yonlendirmeler[$_GET["api"]])){
        include("uc_noktalar/" . $api_yonlendirmeler[$_GET["api"]] . ".php");
    }else{
        if(lfi_guvenli_mi("uc_noktalar/" . $_GET["api"] . ".php")){
            if(file_exists("uc_noktalar/" . $_GET["api"] . ".php")){
                include("uc_noktalar/" . $_GET["api"] . ".php");
            }else{
                if(file_exists("uc_noktalar/rol/" . $_GET["api"] . ".php")){
                    include("uc_noktalar/rol/" . $_GET["api"] . ".php");
                }else{
                    if(file_exists("uc_noktalar/rol/" . $rol . "/" . $_GET["api"] . ".php")){
                        include("uc_noktalar/rol/" . $rol . "/" . $_GET["api"] . ".php");
                    }else{
                        if($gelistirici_modu) uc_nokta_olustur("uc_noktalar/rol/" . $rol . "/" . $_GET["api"] . ".php");
                    }
                }
            }
        }
    }
?>