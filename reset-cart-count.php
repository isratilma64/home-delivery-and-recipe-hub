<?php
session_start();

// Reset the cart count
if (isset($_SESSION['cart_count'])) {
    $_SESSION['cart_count'] = 0;
}
?>
