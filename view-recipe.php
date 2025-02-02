<?php 
include 'connect.php';

$id = $_GET['id']; // Get the recipe ID from the query string
$sql = "SELECT * FROM recipes WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $recipe = $result->fetch_assoc();
} else {
    echo "<div class='error'>Recipe not found!</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/> <link rel="stylesheet" href="./assets/css/viewrecipe.css">
</head>
<style>
section{
    padding: 80px 0px;
  }
 </style>
<body>
<?php    
session_start();
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
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item ms-3">
                        <a class="nav-link active" href="add-recipe.php">Share Recipe</a>
                    </li>
                    <li class="nav-item ms-3 dropdown">
                        <a class="nav-link active dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $userName; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="my-recipes.php"><ion-icon name="person-outline" class="px-2 icon"></ion-icon>My Recipes</a></li>
                            <li><a class="dropdown-item" href="logout.php"><ion-icon name="log-out-outline" class="px-2 icon"></ion-icon> Log Out</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                  <li class="nav-item ms-3">
    <a class="btn btn-brand" href="sign-in-up.php" style="background-color: var(--font-clr); color: var(--color-bg-1); font-weight: 700; border-radius: 100px;" onmouseover="this.style.backgroundColor='var(--color-bg-light)'; this.style.borderColor='#dbbfa3';" onmouseout="this.style.backgroundColor=rgb(59, 10, 10); this.style.borderColor='';">Sign Up & Sign In</a>
</li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="recipe-details container">
    <!-- Recipe Name -->
    <h1 class="recipe-title text-center mb-4"><?php echo $recipe['r_name']; ?></h1>
    <hr>

    <!-- Recipe Image -->
    <div class="text-center mb-4">
        <?php if (!empty($recipe['image_path'])): ?>
            <img src="<?php echo $recipe['image_path']; ?>" alt="<?php echo $recipe['r_name']; ?>" class="recipe-image">
        <?php else: ?>
            <p>No image available</p>
        <?php endif; ?>
    </div>

    <!-- Ingredients -->
    <h2 class="section-title"><i class="ri-arrow-right-circle-fill"></i>Ingredients</h2>
    <ul class="ingredients-list">
        <?php 
        $ingredients = explode("\n", $recipe['ingredients']); // Split ingredients into an array
        foreach ($ingredients as $ingredient): ?>
            <li><?php echo htmlspecialchars($ingredient); ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Instructions -->
    <h2 class="section-title"><i class="ri-arrow-right-circle-fill"></i>Instructions</h2>
    <ol class="instructions-list">
        <?php 
        $instructions = explode("\n", $recipe['instructions']); // Split instructions into an array
        foreach ($instructions as $step): ?>
            <li><?php echo htmlspecialchars($step); ?></li>
        <?php endforeach; ?>
        <hr>
    </ol>

    <!-- Back Button -->
  
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>
