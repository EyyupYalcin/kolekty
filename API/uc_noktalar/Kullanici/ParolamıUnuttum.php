<?php

$email = gerekli("POST", "email");

$kullanici = getKullaniciByEmail($email);

if(!$kullanici){
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Kullanıcı Bulunamadı!"
    ]);
    die;
}

$parola_yenileme_kodu = DoğrulamaKoduOlustur(16);

$son_kullanim = date_create(date('Y-m-d H:i:s'));
date_add($son_kullanim, date_interval_create_from_date_string('1 days'));
$son_kullanim = date_format($son_kullanim, 'Y-m-d H:i:s');

$update_data = [
  "id" => $kullanici['id'],
  "parola_yenileme_kodu" => $parola_yenileme_kodu,
  "parola_yenileme_kodu_son_kullanim" => $son_kullanim
];


if(update_kullanici($update_data)){
    if(parola_yenileme_baglantisi_gonder($email, $parola_yenileme_kodu)){
        api_yanit([
            "durum" => "Başarılı",
            "mesaj" => "Gelen Kutunuzu Kontrol Edin!"
        ]);
    }else{
        api_yanit([
            "durum" => "Hata",
            "mesaj" => "Mail Gönderilemedi!"
        ]);
    }
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
    ]);
}