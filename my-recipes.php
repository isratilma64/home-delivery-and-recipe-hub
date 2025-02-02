<?php 
include 'connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in-up.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch the user's recipes
$sql = "SELECT * FROM recipes WHERE user_id = $user_id";
$result = $conn->query($sql);


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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Recipes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link   href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    
    <link rel="stylesheet" href="assets/css/myrecipelist.css">
</head>

<style>
  section{
    padding: 80px 0px;
  }
 </style>

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
    



    <div class="container py-4">
        <h1 class="text-center mb-4">My Recipes</h1>

        <!-- Recipe Grid -->
        <div class="row">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card recipe-card position-relative overflow-hidden">
                    <!-- Recipe Name (Above Image) -->
                    <h5 class="recipe-title text-center py-2"><?php echo $row['r_name']; ?></h5>

                    <!-- Recipe Image -->
                    <div class="image-wrapper position-relative">
                        <?php if (!empty($row['image_path'])): ?>
                            <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Recipe Image">
                        <?php else: ?>
                            <img src="default-image.jpg" class="card-img-top" alt="No image available">
                        <?php endif; ?>

                        <!-- Action Buttons (Over Image) -->
                        <div class="button-overlay">
                            <a href="view-recipe.php?id=<?php echo $row['id']; ?>" class="btn btn-brand btn-sm me-2">View</a>
                            <a href="delete-recipe.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <p class="text-center">You have not shared any recipes yet.</p>
        </div>
    <?php endif; ?>
</div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
