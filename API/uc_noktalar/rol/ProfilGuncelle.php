<?php include_once "../Servisler/Kullanici.php"; ?>
<?php
$isim = gerekli("POST", "isim");
$soyisim = gerekli("POST", "soyisim");
$unvan = gerekli("POST", "unvan");
$hakkinda = gerekli("POST", "hakkinda");
$konum = gerekli("POST", "konum");
$profil_resmi_varsa = var_mi("FILES", "profil_resmi");

if($profil_resmi_varsa){
  $profil_resmi = dosyaYukle($_FILES['profil_resmi'], 'profil_resmi');
}

$data = [
  "id" => $kullanici['id'],
  "isim" => $isim,
  "soyisim" => $soyisim,
  "unvan" => $unvan,
  "hakkinda" => $hakkinda,
  "adres_id" => $konum
];

if($profil_resmi_varsa){
  $data['profil_resmi'] = $profil_resmi;
}

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