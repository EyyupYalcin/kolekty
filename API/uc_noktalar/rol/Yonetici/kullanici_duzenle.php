<?php
$isim = gerekli("POST", "isim");
$soyisim = gerekli("POST", "soyisim");
$email = gerekli("POST", "email");
$telefon = gerekli("POST", "telefon");
$hakkinda = gerekli("POST", "hakkinda");
$id = gerekli("POST", "id");

$sonuc = update_kullanici([
    "id" => $id,
    "isim" => $isim,
    "soyisim" => $soyisim,
    "email" => $email,
    "telefon" => $telefon,
    "hakkinda" => $hakkinda
]);

if($sonuc){
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Kullanıcı Başarıyla Güncellendi!"
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}
?>