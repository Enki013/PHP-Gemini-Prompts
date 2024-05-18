<?php
// Database configuration
$db_host = '192.168.1.2';
$db_port = '3306';
$db_name = 'my_db';
$db_user = 'admin';
$db_pass = 'adminpss';

try {
    // Establish database connection
    $db_cnn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db_cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Handle connection errors
    echo "Connection error: " . $e->getMessage();
    // You may want to log this error or handle it differently in a production environment
}
?>
