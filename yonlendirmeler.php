<?php
    $yonlendirmeler = [
        "URL" => ["denetleyici_adi", "sayfa_adi"],
        "Giris" => ["OturumDenetleyici/Giris", "OturumSayfalari/Giris"],
        "KayitOl" => ["OturumDenetleyici/KayitOl", "OturumSayfalari/KayitOl"],
        "ParolamıUnuttum" => ["OturumDenetleyici/ParolamiUnuttum", "OturumSayfalari/ParolamiUnuttum"],
        "EpostaDoğrula" => ["OturumDenetleyici/EpostaDoğrula", "OturumSayfalari/EpostaDoğrula"],
        "Hizmet-Sağlayıcı-Ol" => ["Hizmet-Sağlayıcı-Ol", "Hizmet-Sağlayıcı-Ol"],
        "kolekty_hakkinda" => ["sozlesme/kolekty_hakkinda", "sozlesme/kolekty_hakkinda"],
        "teslimat_ve_iade" => ["sozlesme/teslimat_ve_iade", "sozlesme/teslimat_ve_iade"],
        "gizlilik_politikasi" => ["sozlesme/gizlilik_politikasi", "sozlesme/gizlilik_politikasi"],
        "mesafeli_satis_sozlesmesi" => ["sozlesme/mesafeli_satis_sozlesmesi", "sozlesme/mesafeli_satis_sozlesmesi"],
    ];

    $turkce_karekterler = "İçÇöÖüÜğĞşŞ ";

    $parametreli_yonlendirmeler = [
        [
            "tanimlayici" => "Randevu/(?P<id>[0-9]+)",
            "denetleyici" => "randevu",
            "sayfa" => "Randevu"
        ],
        [
            "tanimlayici" => "Profil/Ayarlar/(?P<kullanici_id>[0-9]+)",
            "denetleyici" => "Ayarlar",
            "sayfa" => "Ayarlar"
        ],
        [
            "tanimlayici" => "Profil/Takvim/(?P<kullanici_id>[0-9]+)",
            "denetleyici" => "Takvim",
            "sayfa" => "Takvim"
        ],
        [
            "tanimlayici" => "Profil/Siparisler/(?P<kullanici_id>[0-9]+)",
            "denetleyici" => "Siparisler",
            "sayfa" => "Siparisler"
        ],
        [
            "tanimlayici" => "Test/Test2/(?P<id>[0-9]+)",
            "denetleyici" => "deneme/dizin_deneyi_denetleyicisi",
            "sayfa" => "deneme/dizin_deneyi_sayfasi"
        ],
        [
            "tanimlayici" => "KayitTamamla/(?P<rol_adi>[0-9A-Za-z_\-ğüşöçıİĞÜŞÖÇ]+)/(?P<rol_id>[0-9]+)",
            "denetleyici" => "Anasayfa",
            "sayfa" => "Anasayfa"
        ],
        [
            "tanimlayici" => "Hizmet-Sağlayıcı-Ol/(?P<hizmet_adi>[0-9A-Za-z_\-ğüşöçıİĞÜŞÖÇ]+)/(?P<hizmet_id>[0-9]+)",
            "denetleyici" => "Hizmet-Sağlayıcı-Ol",
            "sayfa" => "Hizmet-Sağlayıcı-Ol"
        ],
        [
            "tanimlayici" => "OdemeYap/hizmet/(?P<hizmet_id>[0-9]+)",
            "denetleyici" => "OdemeYap",
            "sayfa" => "OdemeYap"
        ],
        // [
        //     "tanimlayici" => "Diyetisyen/(?P<diyetisyen_adi>[0-9A-Za-z_\-]+)/(?P<diyetisyen_id>[0-9]+)",
        //     "denetleyici" => "Hizmetler/Diyetisyen.detay",
        //     "sayfa" => "Hizmetler/Diyetisyen.detay"
        // ],
        // [
        //     "tanimlayici" => "Grafiker/(?P<grafiker_adi>[0-9A-Za-z_\-]+)/(?P<grafiker_id>[0-9]+)",
        //     "denetleyici" => "Hizmetler/Grafiker.detay",
        //     "sayfa" => "Hizmetler/Grafiker.detay"
        // ],
        [
            "tanimlayici" => "İlanlar/(?P<hizmet_adi>[0-9A-Za-z_\-\ ğüşöçıİĞÜŞÖÇ]+)(/(?P<parametreler>[0-9A-Za-z_\-\ /ğüşöçıİĞÜŞÖÇ]+))*",
            "denetleyici" => "İlanlar/İlanlar",
            "sayfa" => "İlanlar/İlanlar"
        ],
        [
            "tanimlayici" => "İlan/(?P<hizmet_adi>[0-9A-Za-z_\ \-ğüşöçıİĞÜŞÖÇ]+)/(?P<hizmet_saglayici_adi>[0-9A-Za-z_\-\ ğüşöçıİĞÜŞÖÇ]+)/(?P<ilan_id>[0-9]+)",
            "denetleyici" => "İlanlar/İlan.detay",
            "sayfa" => "İlanlar/İlan.detay"
        ],
        [
            "tanimlayici" => "(?P<hizmet_adi>[0-9A-Za-z_\ \-ğüşöçıİĞÜŞÖÇ]+)/(?P<hizmet_saglayici_adi>[0-9A-Za-z_\-\ ğüşöçıİĞÜŞÖÇ]+)/(?P<hizmet_saglayici_id>[0-9]+)",
            "denetleyici" => "Hizmetler/Hizmet_Sağlayici.detay",
            "sayfa" => "Hizmetler/Hizmet_Sağlayici.detay"
        ],
        [
            "tanimlayici" => "Hizmetler/(?P<hizmet_adi>[0-9A-Za-z_\-\ ğüşöçıİĞÜŞÖÇ]+)(/(?P<parametreler>[0-9A-Za-z_\-\ /ğüşöçıİĞÜŞÖÇ]+))*",
            "denetleyici" => "Hizmetler/Hizmet_Sağlayici",
            "sayfa" => "Hizmetler/Hizmet_Sağlayici"
        ],
        [
            "tanimlayici" => "Profil/(?P<kullanici_id>[0-9]+)",
            "denetleyici" => "Profil",
            "sayfa" => "Profil"
        ],
        [
            "tanimlayici" => "ParolaYenile/(?P<parola_yenileme_kodu>[0-9A-Za-z]+)",
            "denetleyici" => "OturumDenetleyici/ParolaYenile",
            "sayfa" => "OturumSayfalari/ParolaYenile"
        ],
        
        // Blog Start
        [
            // Anasayfa
            "tanimlayici" => "Blog",
            "denetleyici" => "Blog/anasayfa",
            "sayfa" => "Blog/anasayfa"
        ],
        [
            // Kategori Sayfası
            "tanimlayici" => "Blog/(?P<kategori_adi>[0-9A-Za-z_\-ğüşöçıİĞÜŞÖÇ]+)/(?P<kategori_id>[0-9]+)",
            "denetleyici" => "Blog/kategori",
            "sayfa" => "Blog/kategori"
        ],
        [
            // Blog İçerik Sayfası
            "tanimlayici" => "Blog/(?P<kategori_adi>[0-9A-Za-z_\-ğüşöçıİĞÜŞÖÇ]+)/(?P<icerik_adi>[0-9A-Za-z_\-ğüşöçıİĞÜŞÖÇ]+)/(?P<icerik_id>[0-9]+)",
            "denetleyici" => "Blog/icerik",
            "sayfa" => "Blog/icerik"
        ]
        // blog End
    ];

    $api_yonlendirmeler = [
        "Hesap_Olustur" => "Kullanici/KayitOl",
        "Giris" => "Kullanici/Giris",
        "Oturum_Kapat" => "Kullanici/Cikis",
        "mailKontrol" => "Kullanici/mailKontrol",
        "telefonKontrol" => "Kullanici/telefonKontrol",
        "RolDegistir" => "Kullanici/RolDegistir",
        "ProfilResmiYükle" => "Kullanici/ProfilResmiYükle",
        "ParolamıUnuttum" => "Kullanici/ParolamıUnuttum",
        "ParolaYenile" => "Kullanici/ParolaYenile",
    ]
?>