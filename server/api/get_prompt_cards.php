<?php
require_once 'db_config.php';
$statement = $db_cnn->prepare("SELECT * FROM prompt_cards");
$statement->execute();
$prompt_cards = $statement->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
http_response_code(200);
echo json_encode($prompt_cards);
?>