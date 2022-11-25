
<?php include "../Servisler/Hizmet_saglayicilar.php"; ?>
<?php

$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");

$data = [];
$data['id'] = $hizmet_saglayici_id;   
$data['durum'] = 2; // 2 = Onay Bekliyor

/*
    Mesaj gönder onay kullanıcılarından birine
 */

if(update_hizmet_saglayici($data)){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Hizmet Profili Onay Bekliyor!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}