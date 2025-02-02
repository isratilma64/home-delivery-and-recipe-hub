<?php
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<style>
  section {
    padding: 80px 0px;
  }
</style>

<body>

  <!-- Navbar -->
  <?php
session_start();
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
                    <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link active" href="contactus.php">Contact Us</a>
                </li>
                <li class="nav-item ms-3">
                    <div class="dropdown">
                  
                        <?php 
                        
                        // Start session to access session variables
                        session_start();
                        if (isset($_SESSION['email'])) {
                          
                            // If logged in, display username
                            $userName = $_SESSION['userName'];
                        } else {
                            // If not logged in, show "Account"
                            $userName = "Account";
                        }
                        ?>
                        <a class="nav-link active" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $userName; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php if (isset($_SESSION['email'])): ?>
                                <li><a class="dropdown-item" href="#"><ion-icon name="person-circle-outline" class="px-2 icon"></ion-icon> <?php echo $userName; ?></a></li>
                                <hr>
                                <li><a class="dropdown-item" href="#"><ion-icon name="person-outline" class="mx-2 px-2 icon"></ion-icon> Edit Profile</a></li>
                                <li><a class="dropdown-item" href="add-recipe.php"><ion-icon name="reader-outline" class="mx-2 px-2 icon"></ion-icon> Share Recipe</a></li>
                                <li><a class="dropdown-item" href="logout.php"><ion-icon name="log-out-outline" class="mx-1 px-2 icon"></ion-icon> Log Out</a></li>
                            <?php else: ?>
                              <lia class="dropdown-item" href="sign-in-up.php"><ion-icon name="log-in-outline" class="mx-1 px-2 icon"></ion-icon> Log In </a></li>
                              <li><a class="dropdown-item" href="sign-in-up.php"><ion-icon name="log-in-outline" class="mx-1 px-2 icon"></ion-icon> sign in</a></li>
                                
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


 





 


  <!--about-->
  <section id="about">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10"   data-aos="fade-up" >
                <h1 class="display-4"  >Nourish Your Body, Share the Goodness</h1>
                <p class="lead py-3">"Embrace the power of wholesome eating and connect with a global community dedicated to delicious, nutritious meals. Share your healthy recipes, discover new ways to fuel your body, and inspire others to live and eat well."
                </p>
              <!-- <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="search recipe" aria-label="search recipe" aria-describedby="button-addon2">
                      <button class="btn btn-brand" type="button" id="button-addon2">Search</button>
                    </div>
                  </div>
                </div> -->
            </div>
        </div>
    </div>
   <div class="bg-image">
   </div>
  </section>


  <!--search food-->

  <setion id="serch-food" >
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-tittle">
            <h2 class="text-center mt-2 mb-4 display-6 fw-bold"  >What whould you like to cook today?</h2>
           
          </div>

          <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="search recipes.." aria-label="search recipes.." aria-describedby="button-addon2">
                <button class="btn btn-brand" type="button" id="button-addon2">Search</button>
              </div>
            </div>
          </div>
         

        </div>
      </div>
    </div>
    <!--slider auto-->


    <div class="slider mt-3">


      <div class="list " >
  
          <div class="item">
              <img src="./assets/images/bt1.jpg" alt="">
              <div class="content">
                <div class="title">Fuel Your Day with Tasty,<br> Balanced Bites.</div>
                </div>
  
              
          </div>
  
          <div class="item">
              <img src="./assets/images/bt2.jpg" alt="">
  
              <div class="content">
                  <div class="title">Eat Clean, Live Vibrantly: <br>Delicious & Nutritious<br> Recipes.</div>
                 
              </div>
          </div>
  
          <div class="item">
              <img src="./assets/images/bt3.jpg" alt="">
  
              <div class="content">
                  <div class="title">From Farm to Fork: Fresh <br>and Healthy Delights.</div>
              </div>
          </div>
  
          <div class="item">
              <img src="./assets/images/bt4.jpg" alt="">
  
              <div class="content">
                  <div class="title">Flavor-Packed Recipes for <br> Mindful Eating.</div>
              </div>
          </div>
  
      </div>
  
  
      <div class="thumbnail">
  
          <div class="item">
              <img src="./assets/images/bt1.jpg" alt="">
          </div>
          <div class="item">
              <img src="./assets/images/bt2.jpg" alt="">
          </div>
          <div class="item">
              <img src="./assets/images/bt3.jpg" alt="">
          </div>
          <div class="item">
              <img src="./assets/images/bt4.jpg" alt="">
          </div>
  
      </div>
  
  
      <div class="nextPrevArrows">
          <button class="prev"> < </button>
          <button class="next"> > </button>
      </div>
  
  
  </div>
  </setion>




  <!--popular recipes-->
<section id="popular-recipes">
  <div class="container my-2">
    <div class="row">
      <div class="col-12">
        <div class="popular-tittle py-5" >
          <h1 class="display-6 fw-bold text-center "  data-aos="fade-up"><i class="ri-bookmark-line"></i> Populer Recipes  </h1>
        </div>
      </div>
    </div>

    <div class="row gy-4 card-boxs">
      <div class="col-lg-2 col-sm-6" data-aos="fade-up" data-aos-delay="400">
        <div class="card" data-name="p-1">
          <img src="./assets/images/chocolate-mousse-cake.jpg"  class="card-img" alt="">
          <div class="card-img-overlay">
            <h2 class=" m-2 text-white">Chocolate mousse cake</h2>
            <button type="button" class="btn btn-brand-2 ms-lg-3" data-toggle="modal" data-target="#recipeModal1">
             View Recipe
          </button>
          
          </div>
        </div>
       
      </div>

      <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="800">
        <div class="card" data-name="p-2">
          <img src="./assets/images/Vegetable-Momos.webp" class="card-img" alt="">
          <div class="card-img-overlay">
            <h3 class="display-6 text-white">Vegetable momos</h3>
            <button type="button" class="btn btn-brand-2 ms-lg-3 b-0" data-toggle="modal" data-target="#recipeModal2">
              View Recipe
          </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-sm-6" data-aos="fade-up">
        <div class="card" data-name="p-3">
          <img src="./assets/images/dum biriyani 2.jpg" class="card-img" alt="">
          <div class="card-img-overlay">
            <h3 class="display-6 m-2 text-white">Chicken dum biriyani</h3>
            <button type="button" class="btn btn-brand-2 ms-lg-3 " data-toggle="modal" data-target="#recipeModal3">
              View Recipe
          </button>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="1200">
        <div class="card" data-name="p-4">
          <img src="./assets/images/chicken chashew nut salad.png" class="card-img" alt="">
          <div class="card-img-overlay">
            <h3 class="display-6 m-2 text-white">Chicken chashew nut salad</h3>
            <button type="button" class="btn btn-brand-2 ms-lg-3" data-toggle="modal" data-target="#recipeModal4">
              View Recipe
          </button>
          </div>
        </div>
      </div>
    </div>

   <!-- Modal 1 -->
<div class="modal fade" id="recipeModal1" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel1">Chocolate Mousse Cake Recipe</h5>
            
          </div>
          <div class="modal-body">
              <h6><i class="ri-arrow-right-circle-fill"> </i>Ingredients:</h6>
              <ul>
                  <li>200g dark chocolate (chopped)</li>
                  <li>3 eggs (separated)</li>
                  <li>50g sugar</li>
                  <li>300ml heavy cream</li>
                  <li>1 tsp vanilla extract</li>
                  <li>Pinch of salt</li>
                  <li>Chocolate shavings (optional)</li>
              </ul>

              <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
              <ol>
                <li>Melt the chopped chocolate over a double boiler or in the microwave, stirring until smooth. Let it cool slightly.</li>
                <li>In a separate bowl, whisk the egg yolks with sugar until pale and thick, then mix with the melted chocolate.</li>
                <li>In another bowl, whip the heavy cream and vanilla extract until soft peaks form.</li>
                <li>In a clean bowl, beat the egg whites with a pinch of salt until stiff peaks form.</li>
                <li>Gently fold the whipped cream into the chocolate mixture until fully combined.</li>
                <li>Carefully fold the beaten egg whites into the mixture in three parts, being careful not to deflate the mousse.</li>
                <li>Pour the mousse into a cake pan, individual glasses, or serving bowls.</li>
                <li>Refrigerate for at least 4 hours or until set. For best results, refrigerate overnight.</li>
                <li>Before serving, garnish with chocolate shavings, fresh berries, or whipped cream, if desired.</li>
                <li>Slice and serve with extra chocolate sauce for added decadence.</li>
            </ol>
            
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="recipeModal2" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel2">Vegetable Momos Recipe</h5>
             
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>2 cups all-purpose flour</li>
                <li>1 cup finely chopped mixed vegetables (carrots, cabbage, peas)</li>
                <li>1 tsp ginger-garlic paste</li>
                <li>2 tbsp soy sauce</li>
                <li>1 tsp sesame oil</li>
                <li>Salt to taste</li>
                <li>Water (for dough)</li>
                <li>Oil (for greasing)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>In a bowl, mix the flour with a pinch of salt and enough water to form a smooth dough. Let it rest for 30 minutes.</li>
                <li>In another bowl, heat oil and sauté the ginger-garlic paste for a minute.</li>
                <li>Add the chopped vegetables, soy sauce, sesame oil, and salt. Cook until vegetables are slightly tender. Let the filling cool.</li>
                <li>Roll out the dough into small circles, about 3 inches in diameter.</li>
                <li>Place a spoonful of filling in the center of each circle and fold to seal, pinching the edges.</li>
                <li>Steam the momos in a steamer for about 15-20 minutes until cooked.</li>
                <li>Serve hot with chili sauce or soy sauce.</li>
            </ol>
        </div>
        
          <div class="modal-footer">
              <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- Modal 3 -->
<!-- Modal 3 -->
<div class="modal fade" id="recipeModal3" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel3" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel3">Chicken dum biriyani</h5>
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>500g chicken (cut into medium pieces)</li>
                <li>1 cup yogurt</li>
                <li>1 tbsp ginger-garlic paste</li>
                <li>1 tsp red chili powder</li>
                <li>1/2 tsp turmeric powder</li>
                <li>1 tsp garam masala powder</li>
                <li>Salt to taste</li>
                <li>1/4 cup chopped coriander leaves</li>
                <li>1/4 cup chopped mint leaves</li>
                <li>1-2 tbsp lemon juice</li>
                <li>2 cups basmati rice</li>
                <li>4 cups water</li>
                <li>1 bay leaf</li>
                <li>3-4 green cardamoms</li>
                <li>3-4 cloves</li>
                <li>1 small cinnamon stick</li>
                <li>1/2 cup saffron milk (a pinch of saffron soaked in warm milk)</li>
                <li>2 large onions (thinly sliced and fried until golden brown)</li>
                <li>2-3 tbsp ghee (clarified butter)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>In a large bowl, mix yogurt, ginger-garlic paste, red chili powder, turmeric, garam masala, salt, coriander, mint, and lemon juice. Add the chicken pieces, mix well, and marinate for at least 1 hour.</li>
                <li>Rinse and soak the rice in water for 30 minutes, then drain.</li>
                <li>Boil water with bay leaf, cardamoms, cloves, cinnamon, and salt. Add the soaked rice and cook until 70-80% done. Drain and set aside.</li>
                <li>In a heavy-bottomed pot, spread a layer of marinated chicken on the bottom.</li>
                <li>Layer half of the cooked rice over the chicken. Sprinkle half of the fried onions, mint, coriander leaves, and a few drops of saffron milk.</li>
                <li>Add the remaining rice as a second layer, followed by the rest of the fried onions, mint, coriander, saffron milk, and ghee.</li>
                <li>Cover the pot with a lid or foil to seal. Cook on high heat for 5-7 minutes, then reduce to low heat and cook for 30-35 minutes.</li>
                <li>Carefully fluff up the biryani, keeping the layers intact. Serve hot with raita.</li>
            </ol>
        </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>

<!--modal 4-->
<!-- Modal 4 -->
<div class="modal fade" id="recipeModal4" tabindex="-1" aria-labelledby="recipeModalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel4">Chicken chashew nut salad recipe</h5>
             
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>2 cups cooked chicken breast (shredded or diced)</li>
                <li>1 cup mixed salad greens (lettuce, spinach, or arugula)</li>
                <li>1/2 cup roasted cashew nuts</li>
                <li>1/2 cup cherry tomatoes (halved)</li>
                <li>1/4 cup cucumber (sliced)</li>
                <li>1/4 cup shredded carrots</li>
                <li>1/4 cup red bell pepper (thinly sliced)</li>
                <li>2 tbsp fresh cilantro or parsley (chopped)</li>
                <li>1/4 cup shredded cheese (optional)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Dressing:</h6>
            <ul>
                <li>2 tbsp olive oil</li>
                <li>1 tbsp lemon juice</li>
                <li>1 tbsp honey or maple syrup</li>
                <li>1 tsp soy sauce</li>
                <li>1 clove garlic (minced)</li>
                <li>Salt and pepper to taste</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>In a small bowl, whisk together the olive oil, lemon juice, honey, soy sauce, garlic, salt, and pepper to make the dressing.</li>
                <li>In a large salad bowl, combine the chicken, mixed salad greens, roasted cashew nuts, cherry tomatoes, cucumber, carrots, red bell pepper, and cilantro or parsley.</li>
                <li>Pour the dressing over the salad and toss to combine.</li>
                <li>Top with shredded cheese if desired, and serve immediately. Enjoy!</li>
            </ol>
        </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>
 
  </div>


</section>






<!--desserts and smoothy-->
<section class="desserts-and-smoothy mb-5">
  <div class="container my-2">
    <div class="row">
      <div class="col-12">
        <div class="popular-tittle py-3" >
          <h1 class="display-6 fw-bold text-center "  data-aos="fade-up"><i class="ri-cake-3-line"></i>  Desserts and smoothies <i class="ri-drinks-2-fill"></i></h1>
        </div>
      </div>
    </div>

    <div class="row gy-4 my-4 card-boxs">
      <div class="col-lg-2 col-sm-6" data-aos="fade-up" data-aos-delay="400">
        <div class="card" data-name="p-4">
          <img src="./assets/images/close-up-fancy-dessert_23-2150527580.avif"  class="card-img" alt="">
          <div class="card-img-overlay">
            <h2 class=" m-2 text-white">Pudding cake</h2>
            <button type="button" class="btn btn-brand-2 ms-lg-3" data-toggle="modal" data-target="#recipeModal5">
              View Recipe
          </button>
          </div>
        </div>
        
      </div>

      <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="800">
        <div class="card" data-name="p-2">
          <img src="./assets/images/Cantaloupe-Smoothie-12-scaled-purple.jpg" class="card-img" alt="">
          <div class="card-img-overlay">
            <h3 class="display-6 text-white">Cantaloupe Smoothie</h3>
            <button type="button" class="btn btn-brand-2 ms-lg-3 b-0" data-toggle="modal" data-target="#recipeModal6">
              View Recipe
          </button>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-sm-6" data-aos="fade-up">
        <div class="card" data-name="p-3">
          <img src="./assets/images/Fried-Ice-Cream-Dessert-Bars-.jpg" class="card-img" alt="">
          <div class="card-img-overlay">
            <h3 class="display-6 m-2 text-white">Ice Cream Dessert</h3>
            <button type="button" class="btn btn-brand-2 ms-lg-3 " data-toggle="modal" data-target="#recipeModal7">
              View Recipe
          </button>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="1200">
    <div class="card" data-name="p-4">
        <img src="./assets/images/vegan-tropical-smoothie-simple-green-smoothies-7.jpg" class="card-img" alt="Vegan Tropical Smoothie">
        <div class="card-img-overlay">
            <h3 class="display-6 m-2 text-white">Vegan Tropical Smoothie</h3>
            <button type="button" class="btn btn-brand-2 ms-lg-3" data-toggle="modal" data-target="#recipeModal8">
                View Recipe
            </button>
        </div>
    </div>
</div>
    </div>
     <!-- Modal 5 -->
<div class="modal fade" id="recipeModal5" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel5" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel5">Pudding Cake</h5>
            
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>1 cup all-purpose flour</li>
                <li>1 cup sugar</li>
                <li>2 teaspoons baking powder</li>
                <li>1/4 teaspoon salt</li>
                <li>1/2 cup milk</li>
                <li>1/2 cup unsweetened cocoa powder</li>
                <li>1/2 cup butter (melted)</li>
                <li>1 teaspoon vanilla extract</li>
                <li>1 cup hot water</li>
                <li>Powdered sugar (for dusting, optional)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>Preheat your oven to 350°F (175°C).</li>
                <li>In a large bowl, whisk together the flour, sugar, baking powder, and salt.</li>
                <li>Add the milk, melted butter, and vanilla extract, and mix until smooth.</li>
                <li>In a separate bowl, combine the cocoa powder with hot water and stir until smooth.</li>
                <li>Gradually add the cocoa mixture to the batter, mixing until well combined.</li>
                <li>Pour the batter into a greased 9-inch baking dish.</li>
                <li>Bake for 30-35 minutes, or until a toothpick inserted in the center comes out clean.</li>
                <li>Let it cool for a few minutes, then dust with powdered sugar if desired.</li>
                <li>Serve warm with whipped cream or vanilla ice cream.</li>
            </ol>
        </div>
        
          <div class="modal-footer">
              <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- Modal 6 -->
<div class="modal fade" id="recipeModal6" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel6" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel6">Cantaloupe Smoothie</h5>
             
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>2 cups ripe cantaloupe, diced</li>
                <li>1 banana, sliced</li>
                <li>1/2 cup Greek yogurt (or any yogurt of your choice)</li>
                <li>1 cup milk (dairy or non-dairy)</li>
                <li>1 tablespoon honey or maple syrup (optional)</li>
                <li>1/2 teaspoon vanilla extract</li>
                <li>Ice cubes (optional, for a thicker texture)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>In a blender, combine the diced cantaloupe, banana, Greek yogurt, and milk.</li>
                <li>Add honey or maple syrup and vanilla extract, if desired.</li>
                <li>If you prefer a thicker smoothie, add a few ice cubes.</li>
                <li>Blend on high speed until smooth and creamy.</li>
                <li>Taste and adjust sweetness if needed.</li>
                <li>Pour into glasses and serve immediately.</li>
                <li>Garnish with cantaloupe slices or mint leaves if desired.</li>
            </ol>
        </div>
        
          <div class="modal-footer">
              <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- Modal 7-->
<div class="modal fade" id="recipeModal7" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel7" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel7">Ice Cream Dessert</h5>
              
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>4 cups vanilla ice cream (softened)</li>
                <li>2 cups cornflakes, crushed</li>
                <li>1 cup all-purpose flour</li>
                <li>2 large eggs</li>
                <li>1 cup milk</li>
                <li>1 teaspoon cinnamon</li>
                <li>1 teaspoon vanilla extract</li>
                <li>Oil for frying</li>
                <li>Chocolate sauce (for drizzling)</li>
                <li>Whipped cream (for serving, optional)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>Line a baking dish with parchment paper and scoop the softened ice cream into the dish, spreading it evenly. Freeze until firm, about 2 hours.</li>
                <li>Once firm, remove the ice cream from the dish and cut it into squares.</li>
                <li>In a bowl, whisk together the flour, eggs, milk, cinnamon, and vanilla extract until smooth.</li>
                <li>Heat oil in a deep pan over medium heat.</li>
                <li>Dip each square of ice cream in the batter, allowing excess to drip off.</li>
                <li>Carefully place the battered ice cream in the hot oil and fry until golden brown, about 30 seconds on each side.</li>
                <li>Remove from oil and drain on paper towels.</li>
                <li>Drizzle with chocolate sauce and serve with whipped cream if desired.</li>
            </ol>
          </div>
        
        
        
                  <div class="modal-footer">
                    <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
                </div>
      </div>
    
    </div>
  </div>
</div>
<!--modal 8-->
<div class="modal fade" id="recipeModal8" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel8" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="recipeModalLabel8">Vegan Tropical Smoothie</h5>
              
          </div>
          <div class="modal-body">
            <h6><i class="ri-arrow-right-circle-fill"></i> Ingredients:</h6>
            <ul>
                <li>1 ripe banana</li>
                <li>1 cup frozen mango chunks</li>
                <li>1 cup coconut milk (or any plant-based milk)</li>
                <li>1/2 cup pineapple chunks</li>
                <li>1 tablespoon chia seeds</li>
                <li>1 teaspoon agave syrup (optional)</li>
                <li>Ice cubes (optional, for thickness)</li>
            </ul>
        
            <h6><i class="ri-arrow-right-circle-fill"></i> Instructions:</h6>
            <ol>
                <li>In a blender, combine the banana, mango, coconut milk, pineapple, chia seeds, and agave syrup.</li>
                <li>Blend until smooth, adding ice cubes if desired for a thicker consistency.</li>
                <li>Taste and adjust sweetness if necessary.</li>
                <li>Pour into a glass and enjoy your refreshing smoothie!</li>
            </ol>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-brand ms-lg-3 " data-dismiss="modal">Close</button>
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





<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>
