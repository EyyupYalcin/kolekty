<?php include "../Servisler/Portfolyo.php"; ?>
<?php
$portfolyo_id = gerekli("POST", "portfolyo_id");

if(delete_portfolyo($portfolyo_id)){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Portfolyo Silindi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}