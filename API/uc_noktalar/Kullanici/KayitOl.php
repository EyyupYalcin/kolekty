<?php
$isim = gerekli("POST", "isim");
$soyisim = gerekli("POST", "soyisim");
$email = gerekli("POST", "email");
$telefon = gerekli("POST", "telefon");
$sehir = gerekli("POST", "sehir");
$dogum_tarihi = gerekli("POST", "dogum_tarihi");
$parola = gerekli("POST", "parola");
$parola_tekrar = gerekli("POST", "parola_tekrar");

if($parola == $parola_tekrar){
    // TODO: Burada mail adresi ile kontrol yap. getKullaniciByEmail($email);
    $yeni_kullanici = [
        "isim" => $isim,
        "soyisim" => $soyisim,
        "email" => $email,
        "telefon" => $telefon,
        "adres_id" => $sehir,
        "dogum_tarihi" => $dogum_tarihi,
        "parola" => $parola
    ];
    
    $durum = KullaniciEkle($yeni_kullanici);

    $kullanici = getKullaniciByEmail($email);
    if($durum){
        //PHP Mailler Send Mail
        $doğrulamaKodu = DoğrulamaKoduOlustur(6);
        if(doğrulama_kodu_gonder($email, $doğrulamaKodu)){
            $_SESSION['DoğrulamaKodu'] = $doğrulamaKodu;
            $_SESSION['kullanici'] = $kullanici;
            setAktifRol("EpostaDoğrula");
            $_SESSION['AktifRol'] = "EpostaDoğrula";
            
            api_yanit([
                "durum" => "Başarılı",
                "mesaj" => "Aktivasyon Kodu Gönderildi"
            ]);
        }else{
            api_yanit([
                "durum" => "Hata",
                "mesaj" => "Hesabınız için aktivasyon kodu gönderilemedi!"
            ]);
        }
    }else{
        api_yanit([
            "durum" => "Hata",
            "mesaj" => "Kullanıcı kaydedilirken bir hata meydana geldi!"
        ]);
    }
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Parolalarınız Eşleşmiyor!"
    ]);
}


?>