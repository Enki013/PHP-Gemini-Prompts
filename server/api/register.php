<?php
// require_once 'db_config.php';
// $postData = json_decode(file_get_contents('php://input'), true);
// $name = $postData['name'];
// $surname = $postData['surname'];
// $email = $postData['email'];
// $password = $postData['password'];

// if(empty($name) || empty($surname) || empty($email) || empty($password)) {
//     http_response_code(400);
//     echo json_encode(array("error" => "All fields are required"));
//     exit;
// }

// $statement = $db_cnn->prepare("SELECT * FROM users WHERE email = :email");
// $statement->bindParam(':email', $email);
// $statement->execute();
// if($statement->rowCount() > 0) {
//     http_response_code(400);
//     echo json_encode(array("error" => "email already exists"));
//     exit;
// }

// $token = bin2hex(random_bytes(64));

// $statement = $db_cnn->prepare("INSERT INTO users (name, surname, email, password, token) VALUES (:name, :surname, :email, :password, :token)");

// $statement->bindParam(':name', $name);
// $statement->bindParam(':surname', $surname);
// $statement->bindParam(':email', $email);
// $statement->bindParam(':password', $password);
// $statement->bindParam(':token', $token);

// $statement->execute();

// header('Content-Type: application/json');
// http_response_code(200);
// echo json_encode(array("token" => $token));<?php
require_once 'db_config.php';

$postData = json_decode(file_get_contents('php://input'), true);
$name = $postData['name'];
$surname = $postData['surname'];
$email = $postData['email'];
$password = $postData['password'];

// Tüm alanların dolu olup olmadığını kontrol et
if(empty($name) || empty($surname) || empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(array("error" => "All fields are required"));
    exit;
}

// E-posta adresinin geçerli olup olmadığını kontrol et
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array("error" => "Invalid email format"));
    exit;
}

// E-postanın benzersiz olduğunu kontrol et
$statement = $db_cnn->prepare("SELECT * FROM users WHERE email = :email");
$statement->bindParam(':email', $email);
$statement->execute();
if($statement->rowCount() > 0) {
    http_response_code(400);
    echo json_encode(array("error" => "Email already exists"));
    exit;
}

// Token oluştur
$token = bin2hex(random_bytes(64));

// Parolayı güvenli bir şekilde hash'le
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Kullanıcıyı veritabanına ekle
try {
    $statement = $db_cnn->prepare("INSERT INTO users (name, surname, email, password, token, starred_cards) VALUES (:name, :surname, :email, :password, :token, :starred_cards)");
    $statement->bindParam(':name', $name);
    $statement->bindParam(':surname', $surname);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $hashedPassword);
    $statement->bindValue(':starred_cards', json_encode([])); // Boş bir dizi olarak başlat
    $statement->bindParam(':token', $token);
    $statement->execute();    
    // Başarılı yanıtı gönder
    header('Content-Type: application/json');
    http_response_code(201);
    echo json_encode(array("token" => $token));
    //echo json_encode(array("message" => "User registered successfully"));

}
 catch (PDOException $e) {
 http_response_code(500);
    echo json_encode(array("error" => "Database error: " . $e->getMessage()));
}
?>
