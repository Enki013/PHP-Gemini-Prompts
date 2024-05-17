<?php
// Veritabanı yapılandırması
$db_host = '192.168.1.2';
$db_port = '3306';
$db_name = 'my_db';
$db_user = 'admin';
$db_pass = 'adminpss';

try {
    // Veritabanı bağlantısını kur
    $db_cnn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db_cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Bağlantı hatalarını işle
    header('Content-Type: text/html; charset=UTF-8');
    echo "Bağlantı hatası: " . $e->getMessage();
    // Bu hatayı loglamak veya üretim ortamında farklı şekilde ele almak isteyebilirsiniz
}
?>
