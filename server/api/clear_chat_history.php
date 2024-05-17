<?php
require_once 'db_config.php';
$headers = getallheaders();
$token = $headers['Authorization'];
$statement = $db_cnn->prepare("SELECT * FROM users WHERE token = :token");
$statement->bindParam(':token', $token);
$statement->execute();
if($statement->rowCount() == 0) {
    http_response_code(401);
    echo json_encode(array("error" => "Invalid token"));
    exit;
}

$postData = json_decode(file_get_contents('php://input'), true);
$prompt_card_id = $postData['prompt_card_id'];

if(empty($prompt_card_id)) {
    http_response_code(400);
    echo json_encode(array("error" => "Prompt card id is required"));
    exit;
}

$user = $statement->fetch(PDO::FETCH_ASSOC);
$user_id = $user['id'];

$statement = $db_cnn->prepare("DELETE FROM chat_history WHERE user_id = :user_id AND prompt_card_id = :prompt_card_id");
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':prompt_card_id', $prompt_card_id);
$statement->execute();

http_response_code(200);
echo json_encode(array("success" => "Chat history cleared"));
?>