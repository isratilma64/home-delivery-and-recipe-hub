<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="place-order.php" method="POST">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="address">Address</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <button type="submit">Place Order</button>
        </form>
    </div>
</body>
</html>
