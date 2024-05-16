<?php
require_once("check_session.php");
require_once("db_config.php");

$user_id = $_SESSION['user_id'];

// Kullanıcı bilgilerini al
$query = $db_cnn->prepare("SELECT name, email, starred_cards FROM users WHERE id = ?");
$query->execute([$user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode([
        "success" => true,
        "name" => $user['name'],
        "email" => $user['email'],
        "starred_cards" => $user['starred_cards']
    ]);
} else {
    echo json_encode(["success" => false, "error" => "Kullanıcı bilgileri alınamadı."]);
}
?>