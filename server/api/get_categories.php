<?php
require_once 'db_config.php';
require_once 'check_session.php';

try {
    $statement = $db_cnn->prepare("SELECT * FROM categories");
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(200);
    echo json_encode($categories);
} catch (PDOException $e) {
    // Veritabanı hatasını işle
    http_response_code(500); // İç Sunucu Hatası
    echo json_encode(array("error" => "Veritabanı hatası: " . $e->getMessage()));
}
?>
