<?php
session_start();

// Check if the request is to remove an item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove') {
    $foodId = $_POST['food_id'] ?? '';

    if (isset($_SESSION['cart'][$foodId])) {
        unset($_SESSION['cart'][$foodId]); // Remove item from cart

        echo json_encode([
            'success' => true,
            'redirect_url' => 'view-cart.php'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Item not found in cart.'
        ]);
    }
    exit; // Stop further processing
}


// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$grandTotal = 0;

// Calculate total number of items in the cart
$cartCount = array_sum(array_column($cart, 'quantity'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
   
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/view-cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  

</head>
<body>
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
    

    <h1>Your Cart</h1>
    <div class="container mb-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th>Delivery Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cart)): ?>
                    <?php foreach ($cart as $foodId => $item): ?>
                        <?php
                        $subtotal = ($item['food_price'] * $item['quantity']) + $item['delivery_price'];
                        $grandTotal += $subtotal;
                        ?>
                        <tr data-food-id="<?php echo $foodId; ?>">
                            <td><?php echo htmlspecialchars($item['food_name']); ?></td>
                            <td>$<?php echo number_format($item['food_price'], 2); ?></td>
                            <td>$<?php echo number_format($item['delivery_price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                             <button class="cancel-btn" data-food-id="<?php echo $foodId; ?>">Cancel</button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Total: $<?php echo number_format($grandTotal, 2); ?></h3>
        <button class="btn btn-order mb-4" onclick="window.location.href='order-form.php'">Proceed to Order</button>
    </div>
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

  <script>
    $(document).on('click', '.cancel-btn', function () {
    const foodId = $(this).data('food-id'); // Get the food ID
    console.log('Food ID to remove:', foodId); // Debugging

    // Perform AJAX POST request
    $.ajax({
        url: 'view-cart.php', // Update this to your PHP file handling the request
        type: 'POST',
        data: {
            action: 'remove',
            food_id: foodId
        },
        success: function (response) {
            try {
                const data = JSON.parse(response); // Parse JSON response
                if (data.success) {
                    window.location.href = data.redirect_url; // Reload cart
                } else {
                    alert(data.message || 'Failed to remove item.');
                }
            } catch (error) {
                console.error('Invalid response:', response);
            }
        },
        error: function () {
            alert('Error: Unable to process the request.');
        }
    });
});

  </script>
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>
