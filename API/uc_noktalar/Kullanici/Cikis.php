<?php
if(oturumAcikMi()){
    session_destroy();
    api_yanit([
        "durum" => "Başarılı",
        "mesaj" => "Oturum Kapatıldı!"
    ]);
}else{
    api_yanit([
        "durum" => "Hata",
        "mesaj" => "Önce Oturum Açmayı Dene!"
    ]);
}
?>