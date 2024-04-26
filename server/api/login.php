<?php
require_once 'db_config.php';
$postData = json_decode(file_get_contents('php://input'), true);
$username = $postData['username'];
$password = $postData['password'];

if(empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(array("error" => "All fields are required"));
    exit;
}

$statement = $db_cnn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->execute();

if($statement->rowCount() == 0) {
    http_response_code(401);
    echo json_encode(array("error" => "Invalid username or password"));
    exit;
}

$token = bin2hex(random_bytes(64));

$statement = $db_cnn->prepare("UPDATE users SET token = :token WHERE username = :username");
$statement->bindParam(':token', $token);
$statement->bindParam(':username', $username);
$statement->execute();

header('Content-Type: application/json');
http_response_code(200);
echo json_encode(array("token" => $token));