<?php
$profil_resmi = gerekli("FILES", "profil_resmi");

$profil_resmi = dosyaYukle($profil_resmi, 'profil_resmi');

$sonuc = profilResmiYukle($kullanici['id'], $profil_resmi);

$kullanici = getKullaniciByEmail($kullanici['email']);
$_SESSION['kullanici'] = $kullanici;

if($sonuc){
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Profil Resmi Yüklendi!"
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}