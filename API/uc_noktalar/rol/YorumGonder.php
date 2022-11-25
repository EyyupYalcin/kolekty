<?php include "../Servisler/Yorumlar.php"; ?>
<?php

$yorum = gerekli("POST", "yorum");
$kullanici_id = gerekli("POST", "kullanici_id");
$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");

$sonuc = insert_yorumlar([
    "kullanici_id" => $kullanici['id'],
    "yorum" => $yorum,
    "hizmet_saglayici_id" => $hizmet_saglayici_id
]);

if($sonuc){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Yorumunuz Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}