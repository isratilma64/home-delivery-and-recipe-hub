<?php
session_start(); // Start the session at the very beginning of the file
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
    <title>sign-up-login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/> 
    <link rel="stylesheet" href="./assets/css/sign.css">
</head>
<style>
    section{
      padding: 20px 0px;
    }
   </style>

<body>
     <!--navbar-->
     <nav class="navbar navbar-expand-lg  py-2 sticky-top">
      <div class="container">
          
        <a class="navbar-brand" href="#">
          <img src="./assets/images/LOGO CANVA SMALL 2.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item ms-3 mt-2 me-1">
              <i class="ri-search-line mt-1"  href="searchrecipe.html"></i>
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
                <li class="nav-item ms-3">
                    <a class="nav-link active cart-icon" href="view-cart.php">
                        🛒 Cart 
                        <span id="cart-count" style="background: rgb(59, 10, 10); color: #dbbfa3; border-radius: 50%; padding: 3px 8px; font-size: 0.9em;">
                            <?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?>
                        </span>
                    </a>
                </li>
           
           
          </ul >
          
        </div>
        
      </div>
    </nav>
  


    <section class="log-reg">
    <div class="sign-in-up-box" id="sign-in-up-box">
    <div class="form-box sign-up">
    <form action="register.php" method="POST" onsubmit="return validatePassword()">
    <h1>Create Account</h1>
    <input type="text" name="name" id="signUpName" placeholder="Name" required>
    <input type="email" name="email" id="signUpEmail" placeholder="Email" required>
    <input type="password" name="password" id="signUpPassword" placeholder="Password" required>
    <textarea name="address" class="address" placeholder="Enter Your Address..."  style="background-color: #eee; border: none; margin: 8px 0; padding: 10px 15px; font-size: 13px; border-radius: 8px; width: 100%; outline: none; resize: vertical; min-height: 100px; max-height: 300px;" required></textarea>
    <input type="tel" name="mobile" id="mobile" placeholder="Mobile Number" pattern="[0-9]{11}" required>
   
    <button type="submit" name="signUP">Sign Up</button>
</form>
</div>

<div class="form-box sign-in">
    <form action="login.php" method="POST">
        <h1>Sign In</h1>
        <input type="email" name="email" id="loginEmail" placeholder="Email" required>
        <input type="password" name="password" id="loginPassword" placeholder="Password" required>
        <a href="#">Forget Your Password?</a>
        <button type="submit" name="signIN">Sign In</button>
    </form>
</div>




        <div class="tog-box">
            <div class="tog">
                <div class="tog-panel tog-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to sign in.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="tog-panel tog-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to sign up.</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
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

/*function validatePassword() {
        var password = document.getElementById('signUpPassword').value;
        if (password.length < 8) {
            alert('Password must be at least 8 characters long!');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
*/
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the session message exists
        <?php if (isset($_SESSION['message'])): ?>
            const message = "<?php echo $_SESSION['message']; ?>";
            const messageType = "<?php echo $_SESSION['message_type']; ?>"; // 'success' or 'error'

            if (messageType === "success") {
                alert("✔️ " + message);
            } else if (messageType === "error") {
                alert("❌ " + message);
            }

            // Clear the session message after it's displayed
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>
    });
</script>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>