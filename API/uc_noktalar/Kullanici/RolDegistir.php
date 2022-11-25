<?php
$rol_adi = gerekli("POST", "rol_adi");
if(oturumAcikMi()){
    $kullanici_rolleri = getKullaniciRolleri($kullanici['id']);
    if(in_array($rol_adi, $kullanici_rolleri)){
        setAktifRol($rol_adi);
        api_yanit([
            "durum" => "Başarılı",
            "mesaj" => "Rol Değiştirildi!"
        ]);
    }else{
        api_yanit([
            "durum" => "Hata",
            "mesaj" => "Bu rol için uygun değilsiniz!"
        ]);
    }
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Önce Oturum Açmayı Dene!"
    ]);
}

?>