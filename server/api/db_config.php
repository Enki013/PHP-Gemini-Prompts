<?php
$db_host = '192.168.1.2';
$db_port = '3306';
$db_name = 'my_db';
$db_user = 'admin';
$db_pass = 'adminpss';

try {
    $db_cnn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db_cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
