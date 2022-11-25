<?php include "../Servisler/Egitim.php"; ?>
<?php

$kullanici_id = gerekli("POST", "kullanici_id");
$sertifika_id = gerekli("POST", "sertifika_id");
$sertifika_adi = gerekli("POST", "sertifika_adi");
$sertifika_belge_varsa = var_mi("FILES", "sertifika_belge");

if($sertifika_belge_varsa){
  $sertifika_belge = dosyaYukle($_FILES['sertifika_belge'], 'sertifika');
}

$data = [
  "id" => $sertifika_id,
  "adi" => $sertifika_adi,
];

if($sertifika_belge_varsa){
  $data['dosya'] = $sertifika_belge;
}

if(update_egitim($data)){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Sertifika Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}