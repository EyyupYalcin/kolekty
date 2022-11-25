<?php
$email = gerekli("POST", "email");
$parola = gerekli("POST", "parola");
$kullanici = getKullaniciByEmail($email);
if($kullanici){
    if(md5($parola) == $kullanici['parola']){
        if($kullanici['email_onay'] == 1){
            api_yanit([
                "durum" => "Başarılı",
                "mesaj" => "Giriş Başarılı!"
            ]);
            $_SESSION['kullanici'] = $kullanici;
            $roller = getKullaniciRolleri($kullanici['id']);
            if(count($roller) != 0){
                setAktifRol($roller[0]);
            }else{
                setAktifRol("Yeni Üye");
            }
        }else{
            //PHP Mailler Send Mail
            $doğrulamaKodu = DoğrulamaKoduOlustur(6);
            if(doğrulama_kodu_gonder($email, $doğrulamaKodu)){
                $_SESSION['DoğrulamaKodu'] = $doğrulamaKodu;
                api_yanit([
                    "durum" => "Başarılı",
                    "mesaj" => "Aktivasyon Kodu Gönderildi"
                ]);
                $_SESSION['kullanici'] = $kullanici;
                setAktifRol("EpostaDoğrula");
            }else{
                api_yanit([
                    "durum" => "Hata",
                    "mesaj" => "Hesabınız için aktivasyon kodu gönderilemedi!"
                ]);
            }
        }
    }else{
        api_yanit([
            "durum" => "Hata",
            "mesaj" => "Parola Hatalı!"
        ]);
    }
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Kullanıcı Bulunamadı!"
    ]);
}
?>