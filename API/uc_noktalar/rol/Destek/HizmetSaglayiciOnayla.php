<?php include "../Servisler/Hizmet_saglayicilar.php"; ?>

<?php

$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");

$data = [];
$data['id'] = $hizmet_saglayici_id;   
$data['onaylayan_kullanici'] = $kullanici['id'];
$data['durum'] = 3; // 3 = Onaylandı

$hizmet_saglayici = get_hizmet_saglayicilar_where(" hizmet_saglayicilar.id = " .  $hizmet_saglayici_id)[0];
$email_adres =  getKullaniciByID($hizmet_saglayici['kullanici_id'])['email'];

$content = [
  "subject" => "Hizmet Profiliniz Onaylandı",
  "body" => "Hizmet Profiliniz onaylandı. Hizmet Profilinizi görüntülemek için <a href='https://".$_SERVER['SERVER_NAME']."/Hizmet/" . seoURL($hizmet_saglayici['adi']) . "/" . $hizmet_saglayici['id'] . "'>tıklayınız</a>.",
  "alt_body" => "Hizmet Profiliniz onaylandı. Hizmet Profilinizi görüntülemek için https://".$_SERVER['SERVER_NAME']."/Hizmet/" . seoURL($hizmet_saglayici['adi']) . "/" . $hizmet_saglayici['id'] . " adresine gidiniz.",
];

if(update_hizmet_saglayici($data)){
  mail_gonder($email_adres, $content);
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Hizmet Profili Onaylandı!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}