<?php
## Mysql Bağlantısı ##
$baglandi = false;
foreach ($veriTabaniYapilandirmalari as $yapilandirma => $veritabani) {
    try {
        $options = array(PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_EMULATE_PREPARES => FALSE);
        $db = new PDO("mysql:host=" . $veritabani['hostname'] . ";dbname=" . $veritabani['database'] . ";charset=utf8", $veritabani['username'], $veritabani['password'], $options);
        break;
    } catch (PDOException $e) {
        //print $e->getMessage();
    }
}


$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>