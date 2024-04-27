<?php
require_once 'db_config.php';

$postData = json_decode(file_get_contents('php://input'), true);

//get token from headers
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

$statement = $db_cnn->prepare("SELECT * FROM chat_history WHERE user_id = :user_id AND prompt_card_id = :prompt_card_id");
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':prompt_card_id', $prompt_card_id);
$statement->execute();
$chat_history = $statement->fetchAll(PDO::FETCH_ASSOC);

$contents = array();

for ($i = 0; $i < count($chat_history); $i++) {
    array_push($contents, array(
        "role" => "user",
        "parts" => array(
            array(
                "text" => $chat_history[$i]['user_message']
            )
        )
    ));
    array_push($contents, array(
        "role" => "model",
        "parts" => array(
            array(
                "text" => $chat_history[$i]['response']
            )
        )
    ));
}


array_push($contents, array(
    "role" => "user",
    "parts" => array(
        array(
            "text" => $userMessage
        )
    )
));


$googleApiKey = 'AIzaSyA4-PdsNb96PxBc_4qCXFat57OaBLPfSDg';


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

$responseData = json_decode($response, true);
$responseMessage = $responseData['candidates'][0]['content']['parts'][0]['text'];

$statement = $db_cnn->prepare("INSERT INTO chat_history (user_id, prompt_card_id, user_message, response) VALUES (:user_id, :prompt_card_id, :user_message, :response)");
$statement->bindParam(':user_id', $user_id);
$statement->bindParam(':prompt_card_id', $prompt_card_id);
$statement->bindParam(':user_message', $userMessage);
$statement->bindParam(':response', $responseMessage);
$statement->execute();


header('Content-Type: application/json charset=UTF-8');
http_response_code(200);
print(json_encode(["response"=> $responseData['candidates'][0]['content']['parts'][0]['text']]));

?>
