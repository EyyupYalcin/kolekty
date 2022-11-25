<?php

$password_token = gerekli("POST", "password_token");
$password = gerekli("POST", "password");
$repassword = gerekli("POST", "repassword");

$_kullanici = getKullaniciByParolaYenilemeKodu($password_token);


if(parola_guncelle($password, $_kullanici['id'])){
    update_kullanici([
        "id" => $_kullanici['id'],
        "parola_yenileme_kodu" => NULL,
        "parola_yenileme_kodu_son_kullanim" => NULL
    ]); // parola_yenileme_kodu yok edilir.
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Parola Başarıyla Güncellendi!"
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}

