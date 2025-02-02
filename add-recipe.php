
<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $name = $_POST['r_name'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $is_for_sale = isset($_POST['is_for_sale']) ? intval($_POST['is_for_sale']) : 0;
    $availability = $_POST['availability'];  // New availability field
    $price = $is_for_sale ? $_POST['price'] : NULL;
    $address = $is_for_sale ? $_POST['address'] : NULL;
    $mobile_num = $is_for_sale ? $_POST['mobile_num'] : NULL;
    $user_id = $_SESSION['user_id']; // Assuming user authentication

    // Handle image upload
    $image_path = NULL;
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image_name = time() . '_' . $_FILES["image"]["name"]; // Unique filename
        $image_path = $target_dir . $image_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    }

    // Insert recipe into the database, including the availability column
    $query = "INSERT INTO recipes (r_name, image_path, ingredients, instructions, is_for_sale, price, address, mobile_num, availability, user_id)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssissssi", $name, $image_path, $ingredients, $instructions, $is_for_sale, $price, $address, $mobile_num, $availability, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Recipe added successfully!'); window.location.href='my-recipes.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

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
    <title>Add Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/addrecipe.css"> <!-- Link to your CSS file -->
    <script>
        // Toggle additional fields based on the "sell" option
        function toggleAdditionalFields() {
            const sellYes = document.getElementById('sell-yes').checked;
            const additionalFields = document.getElementById('additional-fields');
            additionalFields.style.display = sellYes ? 'block' : 'none';
        }

        // Validate form fields for selling
        function validateForm(event) {
            const sellYes = document.getElementById('sell-yes').checked;
            const price = document.querySelector('input[name="price"]');
            const address = document.querySelector('input[name="address"]');
            const contact = document.querySelector('input[name="contact"]');

            if (sellYes) {
                if (!price.value || !address.value || !contact.value) {
                    alert('Please fill in all fields related to selling the food.');
                    event.preventDefault(); // Prevent form submission
                }
            }
        }

        // Attach validation function to the form
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('form').addEventListener('submit', validateForm);
        });
    </script>
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
    


<section class="contuct-box-info">
    <div class="container-info">
        <h3 class="heading">Add New Recipe</h3>
        <form action="add-recipe.php" method="POST" enctype="multipart/form-data">
            <div class="inputbox">
                <input type="text" name="r_name" placeholder="Recipe Name" required>
            </div>
            <div class="inputbox">
                <textarea name="ingredients" placeholder="Ingredients (comma-separated)" required></textarea>
            </div>
            <div class="inputbox">
                <textarea name="instructions" placeholder="Instructions" required></textarea>
            </div>
            <div class="inputbox">
                <input type="file" name="image" accept="image/*" required>
            </div>
            <div class="inputbox">
                <h2>Do you want to sell the food?</h2>
                <label>
                    <input type="radio" name="is_for_sale" value="1" onclick="toggleAdditionalFields(true)" required> Yes
                </label>
                <label>
                    <input type="radio" name="is_for_sale" value="0" onclick="toggleAdditionalFields(false)"> No
                </label>
            </div>
            <div id="additional-fields" style="display: none;">
                <div class="inputbox">
                    <input type="number" name="price" placeholder="Price of the food" step="0.01">
                </div>
                <div class="inputbox">
                    <input type="text" name="address" placeholder="Delivery Address">
                </div>
                <div class="inputbox">
                    <input type="tel" name="mobile_num" placeholder="Contact Number" pattern="[0-9]{11}">
                </div>
            </div>
            <button type="submit" class="btn-2" name="submit">Add Recipe</button>
        </form>
    </div>
</section>
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
    function toggleAdditionalFields(isForSale) {
        const fields = document.getElementById("additional-fields");
        if (isForSale) {
            fields.style.display = "block";
        } else {
            fields.style.display = "none";
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>
