<?php
$API_Kodu = '<?php';
foreach(array_keys($_GET) as $parametre_ismi){
    if($parametre_ismi != "api")
    $API_Kodu .= 
'
$' . $parametre_ismi . ' = gerekli("GET", "' . $parametre_ismi . '");';
}

foreach(array_keys($_POST) as $parametre_ismi){
    $API_Kodu .= 
'
$' . $parametre_ismi . ' = gerekli("POST", "' . $parametre_ismi . '");';
}

foreach(array_keys($_FILES) as $parametre_ismi){
    $API_Kodu .= 
'
$' . $parametre_ismi . ' = gerekli("FILES", "' . $parametre_ismi . '");';
}

$API_Kodu .= 
'

api_yanit([
    "durum" => "Bilgi",
    "mesaj" => "API Oluşturuldu Ancak Henüz Hazır Değil!"
]);';

$kendiDosyasi = fopen(__FILE__, "w") or die("Dosya Açılamadı!");
fwrite($kendiDosyasi, $API_Kodu);
fclose($kendiDosyasi);