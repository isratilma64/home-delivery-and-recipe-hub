<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$message_sent = false; // Flag to track if the message was sent

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    // Validate form inputs
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Include PHPMailer
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            // SMTP server configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'isratjahanilma501@gmail.com';
            $mail->Password = 'fmvz jojk srzp tptc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Email settings
            $mail->setFrom('isratjahanilma501@gmail.com', 'Website Contact');
            $mail->addAddress('isratilma64@gmail.com', 'Website Admin');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Contact Form Submission';
            $mail->Body = "Sender Name: $name <br> Sender Email: $email <br> Message: $message";

            $mail->send();
            $message_sent = true; // Set success flag
        } catch (Exception $e) {
            $message_sent = false; // Set failure flag if email couldn't be sent
        }
    }
}
?>
<?php
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/> 
    <link rel="stylesheet" href="assets/css/contact.css">
    <title>contuct-us</title>
</head>
<style>
    section{
      padding: 20px 0px;
    }
    .popup {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    margin-top: 10px;
    display: inline-block;
}

.popup-error {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
}

   </style>
<body>
<?php

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['userName'] : "Account";
?>



    <!--navbar-->
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
            <div class="left">
                <h3 class="heading">Get In Touch</h3>
                <p class="text">How can we help you?</p>
                <form id="contactForm" class="form" action="contactus.php" method="POST">
    <div class="inputbox">
        <input type="text" name="name" class="name" placeholder="Enter Your Name"required>
        <span class="error-message"></span>
    </div>
    <div class="inputbox">
        <input type="email" name="email" class="email" placeholder="Enter Your Email"required>
        <span class="error-message"></span>
    </div>
    <div class="inputbox">
        <textarea name="message" class="message" placeholder="Enter Your Message..."required></textarea>
        <span class="error-message"></span>
    </div>
    <button type="submit" class="btn-2" name="send">Send</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($message_sent) {
        echo '<script>console.log("Message sent successfully!");</script>';
    } else {
        echo '<script>console.log("Message sending failed.");</script>';
    }
}
?>


<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div id="popup-container">
        <?php if ($message_sent): ?>
            <div class="popup">Message sent successfully!</div>
        <?php else: ?>
            <div class="popup popup-error">Failed to send the message. Please try again.</div>
        <?php endif; ?>
    </div>
<?php endif; ?>





            </div>

            <div class="right">
              <h3 class="heading">Contact Us</h3>
          
             <div class="contact-us-right-side-first my-5">
              <p class="pt-2 mb-4"> <i class="ri-home-wifi-fill"></i>  Changoan R/A, Chittagong, Bangladesh.</p>
              <p class="mb-4"><i class="ri-mail-fill"></i>   goodfood@gmail.com</p>
              <p><i class="mb-4 ri-phone-fill"></i>  1234567890</p>  
             </div>
             <div class="contact-us-right-side-second py-5 my-5">
              <h4 class="heading  text-start my-3">Follow Us </h4>
              <div class="social-media pt-2">
                <a href="#" class=" fs-2 social-icon"> <i class="ri-facebook-circle-fill"></i></a>
                <a href="#" class="fs-2 ms-3 social-icon"><i class="ri-twitter-fill"></i></a>
                <a href="#" class="fs-2 ms-3 social-icon"><i class="ri-google-fill"></i></a>
                <a href="#" class=" fs-2 ms-3 social-icon"><i class="ri-youtube-fill"></i></a>
             </div>
        
            </div>
         </div>
         <div style="padding: 25px 55px;"></div>
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
    document.addEventListener("DOMContentLoaded", () => {
        const popup = document.querySelector("#popup-container");
        if (popup) {
            setTimeout(() => {
                popup.style.display = "none";
            }, 3000); // Hide after 3 seconds
        }
    });
</script>


     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
 
    <script src="./assets/js/main.js" ></script>

</body>
</html>

