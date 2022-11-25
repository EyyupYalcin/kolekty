<?php include "../Servisler/Hizmet_saglayicilar.php"; ?>
<?php include "../Servisler/Hizmetler.php"; ?>
<?php
$hizmet_id = gerekli("POST", "hizmet_id");
$hizmet_saglayici_adi = gerekli("POST", "hizmet_saglayici_adi");

$sonuc = insert_hizmet_saglayicilar([
    "adi" => $hizmet_saglayici_adi,
    "tanitim" => "",
    "saatlik_ucret" => 0,
    "profil_fotografi" => "",
    "kapak_fotografi" => "",
    "diploma" => "",
    "kullanici_id" => $kullanici['id'],
    "hizmet_id" => $hizmet_id,
]);

$rol_eklenecek_mi = true;

$roller = getKullaniciRolleri($kullanici['id']);

foreach ($roller as $key => $rol) {
    if($rol == "Hizmet Sağlayıcı"){
        $rol_eklenecek_mi = false;
    }
}

if($rol_eklenecek_mi){
    RolTanimla($kullanici['id'], 4);
}

$eklenen_id = $db->lastInsertId();

$hizmet_adi = get_Hizmetler_where(" id = " . $hizmet_id)[0]['hizmet_adi'];

if($sonuc){
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Freelancer Bilgileri Kaydedildi!",
        "yonlendirme" => $hizmet_adi . "/" . $hizmet_saglayici_adi . "/" . $eklenen_id,
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}