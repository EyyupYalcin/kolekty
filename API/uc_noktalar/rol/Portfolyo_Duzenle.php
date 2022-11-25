<?php include "../Servisler/Portfolyo.php"; ?>
<?php
$portfolyo_id = gerekli("POST", "portfolyo_id");
$portfolyo_adi = gerekli("POST", "portfolyo_adi");
$portfolyo_aciklama = gerekli("POST", "portfolyo_aciklama");
$portfolyo_resim_varsa = var_mi("FILES", "portfolyo_resim");

if($portfolyo_resim_varsa){
  $portfolyo_resim = dosyaYukle($_FILES['portfolyo_resim'], 'portfolyo');
}

$data = [
  "id" => $portfolyo_id,
  "adi" => $portfolyo_adi,
  "aciklama" => $portfolyo_aciklama,
];

if($portfolyo_resim_varsa){
  $data['resim'] = $portfolyo_resim;
}



if(update_portfolyo($data)){
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