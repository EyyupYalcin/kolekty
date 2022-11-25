<?php include "../Servisler/Hizmetler.php"; ?>
<?php
$adi = gerekli("POST", "adi");
$id = gerekli("POST", "id");
$hizmet_aciklaması = gerekli("POST", "hizmet_aciklaması");

$sonuc = update_Hizmetler([
    "id" => $id,
    "hizmet_adi" => $adi,
    "hizmet_aciklaması" => $hizmet_aciklaması
]);

if($sonuc){
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Hizmet Başarıyla Güncellendi!"
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}