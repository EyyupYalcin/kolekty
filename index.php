<?php session_start(); ?>
<?php ob_start(); ?>
<?php include_once('yapilandirma.php'); ?>
<?php include_once('veritabani.php'); ?>
<?php include('guvenlik.php'); ?>
<?php if(oturumAcikMi()) $kullanici = $_SESSION['kullanici']; ?>
<?php
    if(getAktifRol() == 'EpostaDoğrula' && $_GET['sayfa'] != 'EpostaDoğrula'){
        header('Location: /EpostaDoğrula');
    }
?>
<?php include('yonlendirmeler.php'); ?>
<?php include('Servisler/Mail/load.php'); ?>
<?php include('Servisler/Kullanici.php');?>
<?php if(oturumAcikMi()) kullanici_goruldu($kullanici['id']);?>
<?php include('SayfaYukle.php'); ?>
<?php include(denetleyici($denetleyici)); ?>
<?php include('varsayilanBilesenler.php'); ?>
<?php include('sablonlar/' . $sablon . '.php'); ?>