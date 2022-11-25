<?php include "../Servisler/Hizmet_saglayicilar.php"; ?>
<?php

$hizmet_saglayici_id = gerekli("POST", "hizmet_saglayici_id");
$hizmet_saglayici_adi_varsa = var_mi("POST", "hizmet_saglayici_adi");
$hizmet_tanitim_varsa = var_mi("POST", "hizmet_tanitim");
$ucret_varsa = var_mi("POST", "ucret");
$hizmet_resmi_varsa = var_mi("FILES", "hizmet_resmi");

$data = [];
$data['id'] = $hizmet_saglayici_id;

if($hizmet_saglayici_adi_varsa)
  $hizmet_saglayici_adi = $_POST['hizmet_saglayici_adi'];
  if(!empty($hizmet_saglayici_adi))
    $data['adi'] = $hizmet_saglayici_adi;

if($hizmet_tanitim_varsa)
  $hizmet_tanitim = $_POST['hizmet_tanitim'];
  if(!empty($hizmet_tanitim))
      $data['tanitim'] = $hizmet_tanitim;

if($ucret_varsa)
  $ucret = $_POST['ucret'];
  if(!empty($ucret))
      $data['saatlik_ucret'] = $ucret;

      

if($hizmet_resmi_varsa)
  $hizmet_resmi = $_FILES['hizmet_resmi'];
  $hizmet_resmi = dosyaYukle($hizmet_resmi, 'hizmet_profil');
  if(!empty($hizmet_resmi))
    $data['profil_fotografi'] = $hizmet_resmi;

if(update_hizmet_saglayici($data)){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Hizmet Profili Güncellendi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}