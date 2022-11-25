<?php
$email = gerekli("POST", "email");
$kullanici = getKullaniciByEmail($email);

if ($kullanici) {
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Bu mail adresi ile daha önce kayıt yapılmış!"
    ]);
} else {
    api_yanit([
        "durum" => "Bilgi",
        "mesaj" => "Mail hesabı kullanılabilir"
    ]);
}