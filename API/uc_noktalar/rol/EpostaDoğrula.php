<?php
$DogrulamaKodu = gerekli("POST", "DogrulamaKodu");

if($_SESSION['DoğrulamaKodu'] == $DogrulamaKodu){
    EpostaOnay($kullanici);
    $roller = getKullaniciRolleri($kullanici['id']);
    if(count($roller) != 0){
        setAktifRol($roller[0]);
    }else{
        setAktifRol("Yeni Üye");
    }
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Hesabınız Doğrulandı!",
        "yonlendirme" => "Anasayfa"
    ]);   
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Doğrulama kodu hatalı veya süresi geçmiş!"
    ]);   
}