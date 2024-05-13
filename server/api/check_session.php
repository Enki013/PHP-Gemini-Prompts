<?php
session_start();

// Kullanıcının giriş yapmış olması gerekiyor
if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
    header("Location: login.html");
    exit;
}
?>
