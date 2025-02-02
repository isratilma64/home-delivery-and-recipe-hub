<?php
session_start();
include 'connect.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('You must be logged in to place an order.');
        window.location.href = 'sign-in-up.php';
    </script>";
    exit;
}

// Fetch user details
$userId = $_SESSION['user_id']; // Assuming user ID is stored in session
$query = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $username = $user['name'];
} else {
    echo "<script>
        alert('User not found! Redirecting to login page.');
        window.location.href = 'sign-in-up.php';
    </script>";
    exit;
}

// Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>
        alert('Your cart is empty! Redirecting to products page.');
        window.location.href = 'user-products.php';
    </script>";
    exit;
}

$cart = $_SESSION['cart'];
$totalAmount = 0;

foreach ($cart as $item) {
    $totalAmount += ($item['food_price'] * $item['quantity']) + $item['delivery_price'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceed to Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/order-form.css"> <!-- Custom CSS -->
    <style>
       section{
    padding: 80px 0px;
  }
  .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    margin: 10px 0;
}
.rating input {
    display: none;
}
.rating label {
    font-size: 2em;
    color: #ccc;
    cursor: pointer;
    margin: 0 5px;
}
.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #f39c12; /* Highlight stars */
}

        
    </style>
    
</head>
<body>

<!-- Navbar -->
<?php

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['userName'] : "Account";
?>

<nav class="navbar navbar-expand-lg py-2 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="./assets/images/LOGO CANVA SMALL 2.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ms-3 mt-2 me-1">
                    <a href="./searchrecipe.html"><i class="ri-search-line mt-1"></i></a>
                </li>
            
                <li class="nav-item ms-3">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link active" href="contactus.php">Contact Us</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link active" href="list-recipes.php">Recipes</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link active" href="user-products.php">Order Now</a>
                </li>

              

                <!-- Cart Section -->
               

                <?php if ($isLoggedIn): ?>
                   
                    <li class="nav-item ms-3 dropdown">
                        <a class="nav-link active dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $userName; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="my-recipes.php"><ion-icon name="person-outline" class="px-2 icon"></ion-icon>My Recipes</a></li>
                            <li><a class="dropdown-item" href="user-orders.php"><ion-icon name="person-outline" class="px-2 icon"></ion-icon>My Orders</a></li>
                            <li><a class="dropdown-item" href="logout.php"><ion-icon name="log-out-outline" class="px-2 icon"></ion-icon> Log Out</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-3">
                        <a class="btn btn-brand" href="sign-in-up.php" style="background-color: var(--font-clr); color: var(--color-bg-1); font-weight: 700; border-radius: 100px;" onmouseover="this.style.backgroundColor='var(--color-bg-light)'; this.style.borderColor='#dbbfa3';" onmouseout="this.style.backgroundColor=rgb(59, 10, 10); this.style.borderColor='';">Sign Up & Sign In</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item ms-3">
                    <a class="nav-link active cart-icon" href="view-cart.php">
                        🛒 Cart 
                        <span id="cart-count" style="background: rgb(59, 10, 10); color: #dbbfa3; border-radius: 50%; padding: 3px 8px; font-size: 0.9em;">
                            <?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?>
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>  

<!-- Order Form -->
<section class="contuct-box-info">
    <div class="container-info">
        <h3 class="heading">Proceed to Order</h3>
        <form action="place-order.php" method="POST">
            <p>Ordering as: <strong><?php echo htmlspecialchars($username); ?></strong></p>
            
            <div class="inputbox">
                <textarea name="address" id="address" rows="3" placeholder="Address" required></textarea>
            </div>
            
            <div class="inputbox">
                <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" required>
            </div>
            
            <div class="inputbox">
                <h2>Payment Method:</h2>
                <label>
                    <input type="radio" name="payment_method" value="cash_on_delivery" onclick="toggleBikash()" required> Cash on Delivery
                </label>
                <label>
                    <input type="radio" name="payment_method" value="bikash" onclick="toggleBikash()"> Bikash
                </label>
            </div>
            
            <div id="bikash-info" class="inputbox" style="display: none;">
                <p>Send payment to: <strong>01671300748</strong></p>
                <input type="text" name="bikash_number" id="bikash_number" placeholder="Enter Bikash Transaction Number">
            </div>
            
            <div class="inputbox">
                <h3>Total Amount: $<?php echo number_format($totalAmount, 2); ?></h3>
                <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
                <input type="hidden" name="username" value="<?php echo $username; ?>">
            </div>
            
            <button type="submit" class="btn-2" name="submit">Place Order</button>
        </form>
    </div>
</section>






<!-- Footer -->
<footer class="footer-box mt-2 pt-5">
    <div class="container">
        <div class="row">
           
        
           
          <div class="col-4 col-md-4">
            <h3 class="fw-bold">About Us</h3>
            <p class="pt-2"> <i class="ri-home-wifi-fill"></i> Changoan R/A, Chittagong, Bangladesh.</p>
            <p class="mb-2"><i class="ri-mail-fill"></i>  goodfood@gmail.com</p>
            <p><i class="ri-phone-fill"></i> 1234567890</p>   
          </div>

          <div class="col-4 col-md-4">
            <h3 class="fw-bold">Privacy</h3>
            <ul class="list-unstyled pt-2">
              <li class="py-1">Career</li>
              <li class="py-1">Privacy & policy</li>
              <li class="py-1">Terms</li>
              <li class="py-1">Conditions</li>
          </ul>   
          </div>

              
          <div class="col-4 col-lg-3 ">
            <h4 class="fw-bold  text-start">Follow Us On</h4>
            <div class="social-media pt-2">
              <a href="#" class=" fs-2 social-icon"> <i class="ri-facebook-circle-fill"></i></a>
              <a href="#" class="fs-2 ms-3 social-icon"><i class="ri-twitter-fill"></i></a>
              <a href="#" class="fs-2 ms-3 social-icon"><i class="ri-google-fill"></i></a>
              <a href="#" class=" fs-2 ms-3 social-icon"><i class="ri-youtube-fill"></i></a>
          </div>
        </div>
        </div>
        <hr>
<div class="d-sm-flex justify-content-between py-1">
    <p>2024 © Isart Ilma. All Rights Reserved. </p>
    <p>
      <a href="#" class="text-dark text-decoration-none pe-4">Terms of use</a>
      <a href="#" class="text-dark text-decoration-none"> Privacy policy</a>
  </p>
</div>
    </div>
</footer>
<script>function toggleBikash() {
    const bikashInfo = document.getElementById("bikash-info");
    const bikashPayment = document.querySelector('input[name="payment_method"][value="bikash"]').checked;
    bikashInfo.style.display = bikashPayment ? "block" : "none";
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
