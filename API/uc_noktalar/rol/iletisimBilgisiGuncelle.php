<?php include_once "../Servisler/Kullanici.php"; ?>
<?php

$telefon = gerekli("POST", "telefon");
$email = gerekli("POST", "email");

$data = [
  "id" => $kullanici['id'],
  "telefon" => $telefon,
  "email" => $email,
];

if(update_kullanici($data)){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Profil Ayarları Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}

$kullanici = getKullaniciSessionByID($kullanici['id']);
$_SESSION['kullanici'] = $kullanici;