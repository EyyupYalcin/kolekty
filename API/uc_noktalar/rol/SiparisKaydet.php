<?php include "../Servisler/Siparisler.php"; ?>
<?php include "../Servisler/Randevu.php"; ?>
<?php include "../Servisler/Hizmet_saglayicilar.php"; ?>
<?php
$HizmetID = gerekli("POST", "HizmetID");
$HizmetAl_HizmetAdi = gerekli("POST", "HizmetAl_HizmetAdi");
$HizmetAl_HizmetSaglayiciAdi = gerekli("POST", "HizmetAl_HizmetSaglayiciAdi");
$HizmetAl_Tanitim = gerekli("POST", "HizmetAl_Tanitim");
$HizmetAl_HizmetSaglayiciKapatFotografi = gerekli("POST", "HizmetAl_HizmetSaglayiciKapatFotografi");
$Randevu_Tarihi = gerekli("POST", "Randevu_Tarihi");
$Randevu_Saat_Araligi = gerekli("POST", "Randevu_Saat_Araligi");
$HizmetAl_Ucret = gerekli("POST", "HizmetAl_Ucret");
$islem = gerekli("POST", "islem");

// teslim tarihi ve saati hesaplanıyor
$baslangic_saati = explode("-", $Randevu_Saat_Araligi)[0];
$teslim_tarihi = $Randevu_Tarihi . " " . $baslangic_saati;
$teslim_tarihi = date("Y-m-d H:i:s", strtotime($teslim_tarihi));

$randevu = insert_randevu([
  "kullanici_1" => $kullanici['id'],
  "kullanici_2" => get_hizmet_saglayicilar_where(" hizmet_saglayicilar.id = '" . $HizmetID . "'")[0]['kullanici_id'],
  "randevu_zamani" => $teslim_tarihi
]);

// son eklenen randevu id'si alınıyor
$randevu_id = $db->lastInsertId();

$sonuc = insert_siparis([
  "hizmet_saglayici_id" => $HizmetID,
  "musteri_id" => $kullanici['id'],
  "ucret" => $HizmetAl_Ucret,
  "odeme_id" => 0,
  "randevu_id" => $randevu_id,
  "teslim_tarihi" => $teslim_tarihi,
]);


if($sonuc){
  api_yanit([
    "durum" => "Başarılı",
    "mesaj" => "Siparişiniz Kaydedildi!"
  ]);
}else{
  api_yanit([
    "durum" => "Hata",
    "mesaj" => "İşlem sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
  ]);
}