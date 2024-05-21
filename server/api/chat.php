<?php
require_once 'db_config.php';
require_once 'check_session.php';

$postData = json_decode(file_get_contents('php://input'), true);

// Get token from headers
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
$user = $statement->fetch(PDO::FETCH_ASSOC);

$user_id = $user['id'];

$prompt_card_id = $postData['prompt_card_id'];
$userMessage = $postData['user_message'];

// Fetch chat history
$statement = $db_cnn->prepare("SELECT * FROM chat_history WHERE user_id = :user_id AND prompt_card_id = :prompt_card_id");
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':prompt_card_id', $prompt_card_id);
$statement->execute();
$chat_history = $statement->fetchAll(PDO::FETCH_ASSOC);

$contents = array();

// Populate contents array with existing chat history
foreach ($chat_history as $chat) {
    $contents[] = array(
        "role" => "user",
        "parts" => array(
            array(
                "text" => $chat['user_message']
            )
        )
    );
    $contents[] = array(
        "role" => "model",
        "parts" => array(
            array(
                "text" => $chat['response']
            )
        )
    );
}

// Add user's new message to contents array
$contents[] = array(
    "role" => "user",
    "parts" => array(
        array(
            "text" => $userMessage
        )
    )
);

// Call language generation API
$googleApiKey = 'AIzaSyDyQINDxkPD7RXKsH6G76eOyJUHrETS4Kc';
$endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$googleApiKey";

$data = array(
    "contents" => $contents
);

$jsonData = json_encode($data);

$options = array(
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json charset=UTF-8"
    )
);

$curl = curl_init();
curl_setopt_array($curl, $options);
$response = curl_exec($curl);
curl_close($curl);

// Parse response from the language generation service
$responseData = json_decode($response, true);

// if (!isset($responseData['candidates']) || !isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
//     http_response_code(500);
//     echo json_encode(array("error" => "Invalid response from language generation service"));
//     exit;
// }

$responseMessage = $responseData['candidates'][0]['content']['parts'][0]['text'];

// Save the conversation to the database
$statement = $db_cnn->prepare("INSERT INTO chat_history (user_id, prompt_card_id, user_message, response) VALUES (:user_id, :prompt_card_id, :user_message, :response)");
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':prompt_card_id', $prompt_card_id);
$statement->bindParam(':user_message', $userMessage);
$statement->bindParam(':response', $responseMessage);
$statement->execute();

// Return the generated response to the client
header('Content-Type: application/json charset=UTF-8');
http_response_code(200);
echo json_encode(["response"=> $responseMessage]);
?>
