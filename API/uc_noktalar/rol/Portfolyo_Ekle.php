<?php include "../Servisler/Portfolyo.php"; ?>
<?php
$portfolyo_adi = gerekli("POST", "portfolyo_adi");
$portfolyo_aciklama = gerekli("POST", "portfolyo_aciklama");
$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");
$portfolyo_resim = gerekli("FILES", "portfolyo_resim");
$portfolyo_resim = dosyaYukle($portfolyo_resim, 'portfolyo');

$sonuc = insert_portfolyo([
  "adi" => $portfolyo_adi,
  "aciklama" => $portfolyo_aciklama,
  "resim" => $portfolyo_resim,
  "hizmet_saglayici_id" => $hizmet_saglayici_id
]);

if($sonuc){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Portfolyo Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}