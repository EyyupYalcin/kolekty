<?php

$hakkinda_metni = gerekli("POST", "hakkinda_metni");



$sonuc = hakkindaDuzenle($kullanici['id'], $hakkinda_metni);



$kullanici = getKullaniciByEmail($kullanici['email']);

$_SESSION['kullanici'] = $kullanici;



if($sonuc){

    api_yanit([

        "durum" => "Başarılı",

        "mesaj" => "Hakkında Metni Güncellendi!"

    ]);

}else{

    api_yanit([

        "durum" => "Hata",

        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."

    ]);

}