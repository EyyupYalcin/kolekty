<?php include "../Servisler/Uzmanlik_alani.php"; ?>
<?php

$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");
$uzmanlikAlanlari = gerekli("POST", "uzmanlikAlanlari");
//var_dump(explode(',', $uzmanlikAlanlari));
$sonuc_global = true;
foreach (explode(',', $uzmanlikAlanlari) as $uzmanlik_alani) {
   // var_dump($uzmanlik_alani); 
    $sonuc = insert_uzmanlik_alani([
        "adi" => $uzmanlik_alani,
        "hizmet_saglayici_id" => $hizmet_saglayici_id
    ]);
    if(!$sonuc){
        $sonuc_global = false;
    }
}

if($sonuc_global){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Uzmanlık Alanları Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}