<?php
require_once("check_session.php");
require_once("db_config.php");
if (!isset($_GET['id'])) {
echo json_encode(["success" => false, "error" => "id parametresi eksik."]);
exit;
}
$card_id = $_GET['id'];
// Kart bilgilerini al
$query = $db_cnn->prepare("SELECT title FROM prompt_cards WHERE id = ?");
$query->execute([$card_id]);
$card = $query->fetch(PDO::FETCH_ASSOC);
if ($card) {
echo json_encode(["success" => true, "title" => $card['title']]);
} else {
echo json_encode(["success" => false, "error" => "Kart bilgileri alınamadı."]);
}
?>
