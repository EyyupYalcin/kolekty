<?php

$old_password = gerekli("POST", "old_password");
$password = gerekli("POST", "password");
$repassword = gerekli("POST", "repassword");

if(md5($old_password) == $kullanici['parola']){
    if(parola_guncelle($password, $kullanici['id'])){
        api_yanit([
            "durum" => "Bilgi",
            "mesaj" => "Parola Başarıyla Güncellendi!"
        ]);
    }else{
        api_yanit([
            "durum" => "Hata",
            "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
        ]);
    }
}else{
    api_yanit([
        "durum" => "Bilgi",
        "mesaj" => "Eski Parola Hatalı!"
    ]);
}

