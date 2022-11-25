<?php

$phone = gerekli("POST", "phone");

$kullanici = getKullaniciByPhone($phone);

if ($kullanici) {
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Bu numara ile daha önce kayıt yapılmış!"
    ]);
} else {
    api_yanit([
        "durum" => "Bilgi",
        "mesaj" => "Numara hesabı kullanılabilir"
    ]);
}