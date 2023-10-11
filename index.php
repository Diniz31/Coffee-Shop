<?php
session_start();

$user= "";

if(isset($_SESSION['LoginUser'])){
    $user = $_SESSION['LoginUser'];
} 

include('php/includes/db.php');


if(!isset($_SESSION['cart'])){
   $_SESSION['cart'] = array();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Dark Side - For those who love coffee Explore our site if you love roasting and making your own coffee.">
    <meta name="author" content="Tiago Pereira">
    <title> The Dark Side - Coffee Shop </title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <header class="header">
        <a href="#" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
            <?php
          if($user) {
              echo "<a href='accountpage.php' class='user'> Hi, $user </a>";
          }
        ?>
        </a>

        <nav class="navbar" data-visible="false">
            <a href="#shop">Store</a>
            <a href="#story">Our story</a>
            <a href="#contact">Contact</a>
        </nav>

        <div class="login-cart" id="login-cart">
        <div class="user_login">
                <?php
                 if(!$user){
                 echo "<a href='php/login_reg.php'> <i class='fa-solid fa-user'></i> </a>"; 
                 } 
                ?>
            </div>
            <div class="cart" id="cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="cartAmount">0</div>
            </div>
            <div class="menu" id="menu-btn" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

    </header> 
     <!-- Home section -->
    <section class="home" id="home">
        <div class="homeText">
            <h1>FOR THOSE WHO <br>LOVE COFFEE</h1> <br>
            <h3>Explore our site if you love roasting <br>and making your own coffee.</h3> <br>
            <a href="php/store.php" >Buy now <i class="fa-solid fa-right-long"></i></a>
        </div>
        <div class="homeIcon">
            <img src="images/alaskacoffee.png" alt="home_coffee">
        </div>
    </section>
    <hr>
      <!-- Shop section -->
    <div class="shop_title">   <h2> Shop with us our coffee & products </h2>  </div>

    <section class="shop" id="shop">
        <div class="item">
            <div class="item-img">
                <img src="pics_products/lioncoffee.png" alt="lion coffee" title="lion coffee">
            </div>
            <div class="details">
                <h5> Lion Coffee </h5>
                <p> A combination of Mocha, Java and Rio.</p>
                <div class="price-quantity">
                  <h4> 15.99€</h4>
                </div>
            </div>
            
        </div>
        <div class="item">
            <div class="item-img">
                <img src="pics_products/logevitycoffee.png" alt="logevity coffee" title="logevity coffee">
            </div>
            <div class="details">
                <h5> Longevity Coffee </h5>
                <p> Organic - Low acid superfood coffee.</p>
                <div class="price-quantity">
                    <h4> 17.54€</h4>
                </div>
            </div>
            
        </div>
        <div class="item">
            <div class="item-img">
                <img src="pics_products/coffeejug.png" alt="Chemex Coffee Maker" title="Chemex Coffee Maker">
            </div>
            <div class="details">
                <h5> Coffee Maker </h5>
                <p> Chemex Coffee Maker 6 cups</p>
                <div class="price-quantity">
                    <h4> 45.55€</h4>
                </div>
            </div>

        </div>

    </section>
    
    <div class="view_all">  <a href="php/store.php"> VIEW ALL PRODUCTS </a> </div>
    <!-- About section -->
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
               <a href="php/ourStory.php" > Learn more </a>
           </div> 
           <div class="talk" id="contact">
               <p>Contact us by clicking <span> <a href="php/contact.php" >here</a></span> </p>
            </div>
        </div>
    </section>
        <!-- Footer -->
    <hr>
    <footer>
        <div class="logo_footer">
          <a href="#"> <img src="images/logowhite.jpg" alt="logoTheDarkSide"> </a>
        </div>

        <div class="social"> 
            <a href=""> <img src="images/facebook-icon-16.png" alt="facebook"> Facebook</a>
            <a href=""> <img src="images/instagram-icon-16.png" alt="instagram"> Instagram</a>
            <a href=""> <img src="images/twitter-icon-16.png" alt="twitter"> Twitter</a>
            <a href=""> <img src="images/linkedin-icon-16.png" alt="linkedin"> LinkedIn</a> 
        </div>

        <div class="copy-pay">
            <img src="images/visa.png" alt="visa" width="20"> 
            <img src="images/mastercard.png" alt="mastercard" width="20">
            <img src="images/googlepay.png" alt="googlepay" width="36">
            <p> &copy; 2023 Copyright The Dark Side </p>
          
        </div>
        
    </footer>
    <script src="js/script.js"></script>
</body>
</html>