<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to home or another page
header("Location: user-products.php");
exit();
?>
