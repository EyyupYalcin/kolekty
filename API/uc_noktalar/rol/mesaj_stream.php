<?php include "../Servisler/Mesaj_Bildirim.php"; ?>
<?php include "../Servisler/Teklif.php"; ?>
<?php
function standart_output($data){
  echo 'data: '.json_encode($data).'';
  echo "\n\n";
  flush();
}
function event($event_name, $data){
  echo "event: ".$event_name."\n";
  standart_output($data);
}
?>
<?php if(oturumAcikMi()) kullanici_goruldu($kullanici['id']);?>
<?php
  header("Cache-Control: no-cache");
  header("Content-Type: text/event-stream");

  // while(1){
    $kullanici_id = $kullanici['id'];
    $mesajlar = getYeniMesajByAliciID($kullanici_id);
    foreach ($mesajlar as $mesaj) {
      MesajIletildi($mesaj['id']);
    }
  
    standart_output(['mesajlar' => $mesajlar, 'okunmamis_mesaj_sayisi' => okunmamisMesajSayisi($kullanici['id'])]);

    event("okunmamis_mesaj_sayaci", [
      "kisiler" => getKisiler($kullanici['id'])
    ]);

    // Observable Teklifleri yani teklif durumu güncellenen teklifleri yayınlar.
    $ObservedTeklifs = TeklifObserver($kullanici['id']);
    if(count($ObservedTeklifs) != 0){
      event("teklif_guncellendi", [
        "guncellenen_teklifler" => $ObservedTeklifs
      ]);
    }


  //   ob_end_flush();

  //   if (connection_aborted()) break;

  //   sleep(1);
  // }


?>