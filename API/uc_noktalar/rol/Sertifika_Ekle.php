<?php include "../Servisler/Egitim.php"; ?>
<?php

$kullanici_id = gerekli("POST", "kullanici_id");
$sertifika_adi = gerekli("POST", "sertifika_adi");
$sertifika_belge = gerekli("FILES", "sertifika_belge");
$sertifika_belge = dosyaYukle($sertifika_belge, 'sertifika');

$sonuc = insert_egitim([
  "adi" => $sertifika_adi,
  "dosya" => $sertifika_belge,
  "kullanici_id" => $kullanici['id']
]);

if($sonuc){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Eğitim Bilgileriniz Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}