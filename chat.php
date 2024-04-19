<?php

$postData = json_decode(file_get_contents('php://input'), true);

$userMessage=$postData['message'];
$message_history = $postData['message_history'];

$contents = array();
//check if the message history is empty
for ($i = 0; $i < count($message_history); $i++) {
    array_push($contents, array(
        "role" => "user",
        "parts" => array(
            array(
                "text" => $message_history[$i]['you']
            )
        )
    ));
    array_push($contents, array(
        "role" => "model",
        "parts" => array(
            array(
                "text" => $message_history[$i]['gemini']
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
        "Content-Type: application/json"
    )
);


$curl = curl_init();


curl_setopt_array($curl, $options);

$response = curl_exec($curl);

curl_close($curl);

$responseData = json_decode($response, true);


print(json_encode(["message"=> $responseData['candidates'][0]['content']['parts'][0]['text']]));

?>
