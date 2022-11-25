<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "information_schema";
$proje_db = "kolekty";

try {
    $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_EMULATE_PREPARES => false);
    $db = new PDO("mysql:host=" . $hostname . ";dbname=" . $database . ";charset=utf8", $username, $password, $options);
} catch (PDOException $e) {
    print $e->getMessage();
    die;
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$shortopts  = "";
$shortopts .= "t:";     // Tablo Adı ( : yani gerekli)
$shortopts .= "n::";    // Oluşturulacak Dosya Adı ( :: yani isteğe bağlı)

$longopts  = array(
    "table:",           // Tablo Adı ( : yani gerekli)
    "name::",           // Oluşturulacak Dosya Adı ( :: yani isteğe bağlı)
);

$options = getopt($shortopts, $longopts);

echo "Servis Olusturucu v1.0\n\n";

if(count($options) == 0){
    echo "-t  --table\t\tTablo Adi (gerekli)\n";
    echo "-n  --name\t\tDosya Adi (varsayilan -> Tablo Adi)\n\n";
    die;
}

if(!isset($options['t']) & !isset($options['table'])){
    echo "'-t' veya '--table' ile tablo adi giriniz;";
    die;
}

/**
 * Fonksiyonlar Burada Başlıyor
 */
function getKolonBilgileri(){
    GLOBAL $db, $tablo, $proje_db;
    $sorgu_dizgesi = "
        SELECT * FROM COLUMNS 
        WHERE
            TABLE_SCHEMA = ? AND
            TABLE_NAME = ?
    ";
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute([$proje_db, $tablo]);
    $kolonlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    return $kolonlar;
}

function bosluk_birak_ve_ekle($func_kod){
    global $servis_kod;
    $servis_kod .= 
'

'.$func_kod;
}

function CodeGenDosyasiOku($sablon){
    $sablon_konumu = "codegen_sablon/".$sablon.".codegen.func";
    $sablon = fopen($sablon_konumu, "r") or die("Şablon Açılamıyor!");
    $sablon_kod = fread($sablon,filesize($sablon_konumu));
    fclose($sablon);
    return $sablon_kod;
}

function CodeGen($sablon_kod, $parametreler){
    $etiketler = array_keys($parametreler);
    $degerler = array_values($parametreler);
    return str_replace($etiketler, $degerler, $sablon_kod);
}

function servisYaz($servis_kod){
    global $tablo;
    $servis_dosya_konumu = ucfirst($tablo) . ".php";
    if(file_exists($servis_dosya_konumu)){
        $servis_dosya_konumu = '.temp/' . $servis_dosya_konumu;
    }
    $servis = fopen($servis_dosya_konumu, "w") or die("Şablon Açılamıyor!");
    fwrite($servis, $servis_kod);
    fclose($servis);
}

/**
 * Fonksiyonların Sonu
 */

$servis_kod = "<?php";

$tablo = isset($options['t']) ? $options['t'] : $options['table'];

$kolonlar = getKolonBilgileri();

$sablon = CodeGenDosyasiOku("get[TabloAdi]List");
$kod = CodeGen($sablon, ["::[TabloAdi]::" => $tablo]);
bosluk_birak_ve_ekle($kod);

$sablon = CodeGenDosyasiOku("get[TabloAdi]where");
$kod = CodeGen($sablon, ["::[TabloAdi]::" => $tablo]);
bosluk_birak_ve_ekle($kod);

$sablon = CodeGenDosyasiOku("insert[TabloAdi]");
$kod = CodeGen($sablon, ["::[TabloAdi]::" => $tablo]);
bosluk_birak_ve_ekle($kod);

foreach($kolonlar as $kolon){
    //var_dump($kolon);
    $kolon['COLUMN_TYPE'] == "tinyint(1)"; // Bool
    $kolon['COLUMN_TYPE'] == "int(11)"; // int
    $kolon['COLUMN_TYPE'] == "datetime"; // datetime
    $kolon["COLUMN_KEY"] == "UNI"; // Unique
    $kolon['COLUMN_KEY'] == "PRI"; // Primary Key
    $kolon['COLUMN_KEY'] == "MUL"; // MUL? a type of index

    if(
        $kolon["COLUMN_KEY"] == "UNI" ||
        $kolon['COLUMN_KEY'] == "PRI" ||
        $kolon['COLUMN_KEY'] == "MUL"
    ){
        $sablon = CodeGenDosyasiOku("get[TabloAdi]By[Kolon]");
        $kod = CodeGen($sablon, ["::[TabloAdi]::" => $tablo, "::[Kolon]::" => $kolon["COLUMN_NAME"]]);
        bosluk_birak_ve_ekle($kod);
    }

    if($kolon['COLUMN_TYPE'] == "datetime"){
        $sablon = CodeGenDosyasiOku("get[TabloAdi]Between[Kolon]");
        $kod = CodeGen($sablon, ["::[TabloAdi]::" => $tablo, "::[Kolon]::" => $kolon["COLUMN_NAME"]]);
        bosluk_birak_ve_ekle($kod);
    }
}

echo $servis_kod;

servisYaz($servis_kod);
