<?php
// session_start();
// require_once 'db_config.php';
// $postData = json_decode(file_get_contents('php://input'), true);
// $email = $postData['email'];
// $password = $postData['password'];

// if(empty($email) || empty($password)) {
//     http_response_code(400);
//     echo json_encode(array("error" => "All fields are required"));
//     exit;
// }

// $statement = $db_cnn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
// $statement->bindParam(':email', $email);
// $statement->bindParam(':password', $password);
// $statement->execute();


// if($statement->rowCount() == 1) {
//     // Fetch user data
//     $user = $statement->fetch(PDO::FETCH_ASSOC);
    
//     // Set session variables
//     $_SESSION['user_id'] = $user['id'];
//     $_SESSION['email'] = $user['email'];

//     // Generate and update token
//     $token = bin2hex(random_bytes(64));
//     $statement = $db_cnn->prepare("UPDATE users SET token = :token WHERE email = :email");
//     $statement->bindParam(':token', $token);
//     $statement->bindParam(':email', $email);
//     $statement->execute();
    
//  // Set session token
//     $_SESSION['token'] = $token;

//     header('Content-Type: application/json');
//     http_response_code(200);
//     echo json_encode(array("token" => $token));
// } else {
//     http_response_code(401);
//     echo json_encode(array("error" => "Invalid email or password"));
// }

session_start();
require_once 'db_config.php';

// Get JSON data from request body
$postData = json_decode(file_get_contents('php://input'), true);
$email = $postData['email'];
$password = $postData['password'];

if(empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(array("error" => "All fields are required"));
    exit;
}

$statement = $db_cnn->prepare("SELECT * FROM users WHERE email = :email");
$statement->bindParam(':email', $email);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($user && password_verify($password, $user['password'])) {
    // Password verification succeeded

    // Generate a new token
    $token = bin2hex(random_bytes(64));
    
    // Update the token in the database
    $updateStatement = $db_cnn->prepare("UPDATE users SET token = :token WHERE email = :email");
    $updateStatement->bindParam(':token', $token);
    $updateStatement->bindParam(':email', $email);
    $updateStatement->execute();

    // Store user information and token in session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['token'] = $token;

    // Respond with the token
    http_response_code(200);
    echo json_encode(array("token" => $token));
} else {
    // Invalid email or password
    http_response_code(401);
    echo json_encode(array("error" => "Invalid email or password"));
}


?>