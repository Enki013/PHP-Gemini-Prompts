<?php
// require_once 'db_config.php';
// require_once 'check_session.php';
// $statement = $db_cnn->prepare("SELECT * FROM prompt_cards");
// $statement->execute();
// $prompt_cards = $statement->fetchAll(PDO::FETCH_ASSOC);
// header('Content-Type: application/json charset=UTF-8');
// http_response_code(200);
// echo json_encode($prompt_cards);

require_once 'db_config.php';
require_once 'check_session.php';

try {
    $statement = $db_cnn->prepare("SELECT * FROM prompt_cards");
    $statement->execute();
    $prompt_cards = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(200);
    echo json_encode($prompt_cards);
} catch (PDOException $e) {
    // Handle database errors gracefully
    http_response_code(500); // Internal Server Error
    echo json_encode(array("error" => "Database error: " . $e->getMessage()));
}


?>