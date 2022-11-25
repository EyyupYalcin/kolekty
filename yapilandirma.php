<?php
$proje_adi = "Kolekty";
$slogan = "Kolekty";
$versiyon = "1.0";

$gelistirici_modu = true;

$varsayilan_kullanici_rol_id = 2; // Veritabanında 2 -> Müşteri

if($gelistirici_modu){
    error_reporting(E_ALL);
}

$veriTabaniYapilandirmalari = [
    'prod' => [
        'hostname' => "localhost",
        'username' => "u0294194_admin",
        'password' => "F!Lq5,50oltd",
        'database' => "u0294194_engine",
        'kok_dizini' => $_SERVER['SERVER_NAME'],
    ],
    'dev' => [
        'hostname' => "localhost",
        'username' => "root",
        'password' => "",
        'database' => "kolekty",
        'kok_dizini' => "http://kolekty/",
    ],
];

// Eğer sunucu adı localhost ise yerel veritabanına bağlanacak. -Yasir
if(isset($_SERVER['SERVER_NAME'])){
    if($_SERVER['SERVER_NAME'] == "kolekty"){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "kolekty";
        $kok_dizini = "http://kolekty/";
    }else{ // Değilse kolekty sunucusuna bağlanacak
        $hostname = "localhost";
        $username = "u0294194_admin";
        $password = "F!Lq5,50oltd";
        $database = "u0294194_engine";
        $kok_dizini = $_SERVER['SERVER_NAME'];
    }
}
