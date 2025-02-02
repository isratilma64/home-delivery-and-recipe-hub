<?php
session_start();

// Check if the user is logged in as an admin


include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    $delivery_price = $_POST['delivery_price'];

    $food_image = NULL;
    if (!empty($_FILES['food_image']['name'])) {
        $target_dir = "uploads/";
        $image_name = time() . '_' . $_FILES["food_image"]["name"];
        $food_image = $target_dir . $image_name;
        move_uploaded_file($_FILES["food_image"]["tmp_name"], "../" . $food_image);
    }

    // Insert the new product into the database
    $query = "INSERT INTO food_products (food_name, food_image, food_price, delivery_price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdd", $food_name, $food_image, $food_price, $delivery_price);

    if ($stmt->execute()) {
        echo "<script>alert('Food product added successfully!'); window.location.href='admin-products.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Food Products</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css-files/admin-product.css">
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <ul class="side-menu top">
        <li class="active">
            <a href="admin-index.php">
                <i class='bx bxs-user-account'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="user-info.php">
                <i class='bx bxs-user-account'></i>
                <span class="text">Users</span>
            </a>
        </li>
        <li>
            <a href="recipe-info.php">
                <i class='bx bxs-receipt'></i>
                <span class="text">Recipes</span>
            </a>
        </li>
        <li>
            <a href="recipes-for-sale.php">
                <i class='bx bxs-food-menu'></i>
                <span class="text">Menu</span>
            </a>
        </li>
        <li>
            <a href="admin-products.php">
                <i class='bx bxs-food-menu'></i>
                <span class="text">Food Products</span>
            </a>
        </li>
        <li>
            <a href="admin-orders.php">
                <i class='bx bxs-category'></i>
                <span class="text">Orders</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
    <li>
            <a href="admin-info.php" >
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Adminastration</span>
            </a>
        </li>
        <li>
            <a href="admin-logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
       
    </nav>

    <div class="container">
        <h1>Manage Food Products</h1>

        <!-- Add Product Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="food_name">Food Name</label>
                <input type="text" name="food_name" id="food_name" required>
            </div>

            <div>
                <label for="food_price">Food Price</label>
                <input type="number" name="food_price" id="food_price" step="0.01" required>
            </div>
            <div>
                <label for="delivery_price">Delivery Price</label>
                <input type="number" name="delivery_price" id="delivery_price" step="0.01" required>
            </div>
            <div>
                <label for="food_image">Food Image</label>
                <input type="file" name="food_image" id="food_image" accept="image/*" required>
            </div>
            <button type="submit" name="submit">Add Food</button>
        </form>

        <!-- Product Display Section -->
        <h2>Available Food Products</h2>
        <div>
            <?php
            // Fetch and display all food products from the database
            $query = "SELECT * FROM food_products";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='product-card'>
                        <img src='../{$row['food_image']}' alt='Food Image'>
                        <div class='details'>
                            <h3>{$row['food_name']}</h3>
                            <p>Price: \${$row['food_price']}</p>
                            <p>Delivery Price: \${$row['delivery_price']}</p>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<script src="js-files/deshboard.js"></script>
</body>
</html>
