<?php include('Servisler/Rol.php'); ?>
<?php 

$baslik = "Kaydınızı Tamamlayın";
$sablon = "GostergePaneli";
$sablon_bilesenleri = ['MobilUst', 'SayfaAlt', 'SayfaUst', 'Scripts', 'KullaniciPaneli'];

if(isset($_GET['rol_id'])){
    $rol_id = $_GET['rol_id']; 
    $rol = get_rol_By_id($rol_id);
    $sayfa = 'rol/Yeni Üye/Formlar/Müşteri';
}
