<?php
require_once 'db_config.php';
$statement = $db_cnn->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
http_response_code(200);
header('Content-Type: application/json charset=UTF-8');
echo json_encode($categories);
