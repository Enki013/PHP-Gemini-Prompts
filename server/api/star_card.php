<?php
require_once("check_session.php");
require_once("db_config.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['card_id'])) {
    echo json_encode(["success" => false, "error" => "card_id parametresi eksik."]);
    exit;
}

$user_id = $_SESSION['user_id'];
$card_id = $data['card_id'];

// Kullanıcının mevcut yıldızlı kartlarını al
$query = $db_cnn->prepare("SELECT starred_cards FROM users WHERE id = ?");
$query->execute([$user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);
$starred_cards = json_decode($user['starred_cards'], true) ?? [];

// Kartı yıldızlı kartlara ekle
if (!in_array($card_id, $starred_cards)) {
    $starred_cards[] = $card_id;
}

// Güncellenmiş yıldızlı kartları veritabanına kaydet
$query = $db_cnn->prepare("UPDATE users SET starred_cards = ? WHERE id = ?");
$query->execute([json_encode($starred_cards), $user_id]);

echo json_encode(["success" => true]);
?>