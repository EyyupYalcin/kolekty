<?php include "../Servisler/Uzmanlik_alani.php"; ?>
<?php
$uzmanlik_id = gerekli("POST", "uzmanlik_id");

if(delete_uzmanlik_alani($uzmanlik_id)){
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