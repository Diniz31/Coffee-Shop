<?php
session_start();
if(!isset($_SESSION['LoginUser'])){
  header('location: login_reg.php');
}

include('includes/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Dark Side - Coffee Shop</title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <header class="header">
        <a href="#" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
        </a>
        
        <nav class="navbar" data-visible="false">
            <a href="store.php">Store</a>
            <a href="ourStory.php">Our story</a>
            <a href="contact.php">Contact</a>
            <a class="logout" href="logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i></a>
        </nav>
        
        <div class="login-cart" id="login-cart">
            <div class="cart" id="cart-btn">
              <a href="cart.php" target="_blank"><i class="fa-solid fa-cart-shopping"></i></a>
              <div class="cartAmount">0€</div>
            </div>
            <div class="menu" id="menu-btn" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        
        <div class="cart-container">
            
        </div>
            
        </header> 
        
        <a href="accountpage.php" class="user"> 
            Hi,<?php echo $_SESSION['LoginUser']; ?>!
        </a>
   
        <section class="home" id="home">
        <div class="homeText">
            <h1>FOR THOSE WHO <br>LOVE COFFEE</h1> <br>
            <h3>Explore our site if you love roasting <br>and making your own coffee.</h3> <br>
            <a href="store.php" target="_blank">Buy now <i class="fa-solid fa-right-long"></i></a>
        </div>
        <div class="homeIcon">
            <img src="images/alaskacoffee.png" alt="home_coffee">
        </div>
    </section>
    <hr>
      
    <div class="shop_title">   <h2> Shop with us our coffee & products </h2>  </div>

    <section class="shop" id="shop">
        <div class="item">
            <div class="item-img">
                <img src="pics_products/lioncoffee.png" alt="lioncoffee">
            </div>
            <div class="details">
                <h5> Lion Coffee </h5>
                <p> A successful combination of Mocha, Java and Rio.</p>
                <div class="price-quantity">
                  <h4> 15.99€</h4>
                    <div class="plus-minus">
                      <i class="fa-solid fa-minus"></i>
                      <div class="quantity">0</div>
                      <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <button class="addtocart" id="add"> <i class="fa-solid fa-cart-plus"></i> </button>
            </div>
            
        </div>
        <div class="item">
            <div class="item-img">
                <img src="pics_products/logevitycoffee.png" alt="logevitycoffee">
            </div>
            <div class="details">
                <h5> Longevity Coffee </h5>
                <p> Organic - Low acid superfood coffee.</p>
                <div class="price-quantity">
                    <h4> 17.54€</h4>
                    <div class="plus-minus">
                        <i class="fa-solid fa-minus"></i>
                        <div class="quantity">0</div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <button class="addtocart" id="add"> <i class="fa-solid fa-cart-plus"></i> </button>
            </div>
            
        </div>
        <div class="item">
            <div class="item-img">
                <img src="pics_products/coffeejug.png" alt="coffeejug">
            </div>
            <div class="details">
                <h5> Coffee Maker </h5>
                <p> Chemex Coffee Maker 6 cups</p>
                <div class="price-quantity">
                    <h4> 45.55€</h4>
                    <div class="plus-minus">
                        <i class="fa-solid fa-minus"></i>
                        <div class="quantity">0</div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <button class="addtocart" id="add"> <i class="fa-solid fa-cart-plus"></i> </button>
            </div>

        </div>

    </section>
    
    <div class="view_all">  <a href="store.php" target="_blank"> VIEW ALL PRODUCTS </a> </div>
    
    <hr>
    <div class="story_title">  <h2> Our story </h2>  </div>
    <section class="story" id="story">
       <div class="story-img">
        <img src="images/teacup.png" alt="teacup">
       </div>
       <div class="story-text">
         <h2> Like you, we love coffee.</h2> <br>
         <p> Our story begins in 2023 when we <br>decided to open this webstore <br>
            to share our passion for coffee... </p>
           <div class="learn_more">
               <a href="ourStory.php" target="_blank"> Learn more </a>
           </div> 
           <div class="talk" id="contact">
               <p>Contact us by clicking <span> <a href="contact.php" target="_blank">here</a></span> </p>
            </div>
        </div>
    </section>
        
    <hr>
    <?php  
     include('includes/footer.php') 
    ?>

    <script src="javascript/script.js"></script>
</body>
</html>