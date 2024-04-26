<?php
require_once 'db_config.php';
$postData = json_decode(file_get_contents('php://input'), true);
$name = $postData['name'];
$surname = $postData['surname'];
$username = $postData['username'];
$password = $postData['password'];

if(empty($name) || empty($surname) || empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(array("error" => "All fields are required"));
    exit;
}

$statement = $db_cnn->prepare("SELECT * FROM users WHERE username = :username");
$statement->bindParam(':username', $username);
$statement->execute();
if($statement->rowCount() > 0) {
    http_response_code(400);
    echo json_encode(array("error" => "Username already exists"));
    exit;
}

$token = bin2hex(random_bytes(64));

$statement = $db_cnn->prepare("INSERT INTO users (name, surname, username, password, token) VALUES (:name, :surname, :username, :password, :token)");

$statement->bindParam(':name', $name);
$statement->bindParam(':surname', $surname);
$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->bindParam(':token', $token);

$statement->execute();

header('Content-Type: application/json');
http_response_code(200);
echo json_encode(array("token" => $token));