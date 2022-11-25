<?php include "../Servisler/Hizmet_saglayicilar.php"; ?>
<?php include "../Servisler/Hizmetler.php"; ?>
<?php
$hizmet_id = gerekli("POST", "hizmet_id");
$diyetisten_adi = gerekli("POST", "diyetisten_adi");
$biyografi = gerekli("POST", "biyografi");
$ucret = gerekli("POST", "ucret");

$profil_photo = gerekli("FILES", "profil_photo");
$cover_photo = gerekli("FILES", "cover_photo");
$diplomaniz = isset($_FILES["diplomaniz"]) ? $_FILES["diplomaniz"] : "0";

$profil_photo = dosyaYukle($profil_photo, 'hizmet_profil');
$cover_photo = dosyaYukle($cover_photo, 'hizmet_kapak');
$diplomaniz = dosyaYukle($diplomaniz, 'diploma');

$sonuc = insert_hizmet_saglayicilar([
    "adi" => $diyetisten_adi,
    "tanitim" => $biyografi,
    "saatlik_ucret" => $ucret,
    "profil_fotografi" => $profil_photo,
    "kapak_fotografi" => $cover_photo,
    "diploma" => $diplomaniz,
    "kullanici_id" => $kullanici['id'],
    "hizmet_id" => $hizmet_id,
]);

$hizmet_saglayici_eklenecek_mi = true;

$roller = getKullaniciRolleri($kullanici['id']);

foreach ($roller as $key => $rol) {
    if($rol == "Hizmet Sağlayıcı"){
        $hizmet_saglayici_eklenecek_mi = false;
    }
}

if($hizmet_saglayici_eklenecek_mi){
    RolTanimla($kullanici['id'], 4);
}

setAktifRol("Hizmet Sağlayıcı");

$eklenen_id = $db->lastInsertId();

$hizmet_adi = get_Hizmetler_where(" id = " . $hizmet_id)[0]['hizmet_adi'];

if($sonuc){
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Freelancer Bilgileri Kaydedildi!",
        "yonlendirme" => $hizmet_adi . "/" . $diyetisten_adi . "/" . $eklenen_id,
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}