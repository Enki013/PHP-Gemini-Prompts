<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Unset session token if needed
// unset($_SESSION['token']);

// Redirect to login page
header("Location: ../login.html");
exit;
?>
