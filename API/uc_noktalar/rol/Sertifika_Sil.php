<?php include "../Servisler/Egitim.php"; ?>
<?php
$sertifika_id = gerekli("POST", "sertifika_id");

if(delete_egitim($sertifika_id)){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Eğitim Bilgileri Silindi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}