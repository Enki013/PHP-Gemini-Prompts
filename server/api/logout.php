<?php
session_start();
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();
// Redirect to login page
header("Location: ../login.html");
// session_start();
// // Unset session token
// unset($_SESSION['token']);
// // Redirect to login page
// header("Location: ../login.html");
exit;
?>
