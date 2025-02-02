<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['food_id'], $_POST['food_name'], $_POST['food_price'], $_POST['delivery_price'])) {
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $delivery_price = $_POST['delivery_price'];

        // Initialize cart if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add product to the cart
        if (isset($_SESSION['cart'][$food_id])) {
            $_SESSION['cart'][$food_id]['quantity']++;
        } else {
            $_SESSION['cart'][$food_id] = [
                'food_name' => $food_name,
                'food_price' => $food_price,
                'delivery_price' => $delivery_price, // Make sure delivery price is included
                'quantity' => 1
            ];
        }

        header("Location: view-cart.php");
        exit();
    } else {
        // Handle case when required POST fields are not set
        echo "Missing required data.";
    }
}
?>
<form method="POST" action="add-to-cart.php">
    <input type="hidden" name="food_id" value="<?php echo $food['id']; ?>">
    <input type="hidden" name="food_name" value="<?php echo $food['name']; ?>">
    <input type="hidden" name="food_price" value="<?php echo $food['price']; ?>">
    <input type="hidden" name="delivery_price" value="<?php echo $food['delivery_price']; ?>">
    <button type="submit">Add to Cart</button>
</form>
