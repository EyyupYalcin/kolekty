<?php include 'Servisler/Randevu.php'; ?>
<?php
  $baslik = "Randevu";
  $sayfa = "Randevu";
  if(!oturumAcikMi()){
    header("Location: Giris");
  }else{
    $sablon_bilesenleri = ['AnasayfaArama',  'KategoriMenu', 'KullaniciPaneli', 'MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'Sohbet'];
  }
  $sablon = "GostergePaneli";

  $randevu = get_randevu_By_ID($_GET['id']);
  if($randevu["kullanici_1"] == $kullanici["id"]){
    $connectTo = "kolekty_". md5('kolekty_peer_'.$randevu["kullanici_2"]);
  }else{
    $connectTo = "kolekty_". md5('kolekty_peer_'.$randevu["kullanici_1"]);
  }
