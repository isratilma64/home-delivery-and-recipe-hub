<?php
session_start();
include 'connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone_number'];
    $paymentMethod = $_POST['payment_method'];
    $bikashNumber = $_POST['payment_method'] === 'bikash' ? $_POST['bikash_number'] : null;
    $totalAmount = $_POST['total_amount'];

    // Get cart items
    $cart = $_SESSION['cart'];

    // Initialize variable for order_id (used later for the review)
    $lastOrderId = null;

    // Store order in the database
    foreach ($cart as $foodId => $item) {
        $foodName = $item['food_name'];
        $quantity = $item['quantity'];
        $price = ($item['food_price'] * $quantity) + $item['delivery_price'];

        $query = "INSERT INTO orders (username, food_name, quantity, total_amount, address, phone_number, payment_method, bikash_number)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssidsiss', $username, $foodName, $quantity, $price, $address, $phoneNumber, $paymentMethod, $bikashNumber);
        $stmt->execute();

        // Get the last inserted order_id (used for review linking)
        $lastOrderId = $conn->insert_id;
    }

    // Clear the cart
    $_SESSION['cart'] = [];

    // Redirect to review page with the order ID, or allow skipping
    echo "<script>
        alert('Order placed successfully!');
        window.location.href = 'review.php?order_id=$lastOrderId';
    </script>";
}
?>
