<?php
session_start();
$user= "";

if(isset($_SESSION['LoginUser'])){
    $user = $_SESSION['LoginUser'];
}

include('includes/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tiago Pereira">
    <meta name="description" content="The Dark Side - Talk to us.">
    <title> Contact | The Dark Side </title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>
    
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
            <a href="ourStory.php"> Our Story </a>
            <a href="store.php"> Store </a>
            <a href="/PROJETO FINAL/index.php"> Home</a>
            <?php
          if($user) {
              echo "<a class='logout' href='logout.php'> Logout </a>";
          }
        ?>
        </nav>

        <div class="login-cart" id="login-cart">
            <div class="user_login">
                <?php
                 if(!$user){
                 echo "<a href='login_reg.php'> <i class='fa-solid fa-user'></i> </a>"; 
                 } 
                ?>
            </div>
            <div class="cart" id="cart-btn">
              <a href="cart.php" target="_blank"><i class="fa-solid fa-cart-shopping"></i></a>
              <div class="cartAmount">0</div>
            </div>
            <div class="menu" id="menu-btn" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

    </header>
    
    <section class="contact_home">

        <div class="contact_home-img">
            <img src="images/coffeeOn.jpg" alt="coffeeOn">
        </div>
        <h2> Talk to us </h2> <br>
    </section>

    <section class="contact-container">
        <div class="contact_left">
            <div class="contact_info">
              
                <div class="iconGroup">
                    <div class="icons">
                       <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="icon_detail">
                      <p>+351 911111110</p>
                    </div>
                </div>
                 
                <div class="iconGroup">
                    <div class="icons">
                       <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="icon_detail">
                      <p>thedarkside@mail.com</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="contact_right">
            <form action="#" class="messageForm">

               <div class="input_text">
                <input type="text" name="" placeholder="Name" required>
               </div>

               <div class="input_text">
                <input type="email" name="" placeholder="Email" required>
               </div>

               <div class="input_subject">
                <input type="text" name="" placeholder="Subject" required>
               </div>

               <div class="input_fulltext">
                <textarea name="" id="" cols="30" rows="10" placeholder="Message" required></textarea>
                <button type="submit"> <i class="fa-regular fa-paper-plane"></i> </button>
               </div>

            </form>      
        </div>
    </section>
    <hr>
    <?php  
     include('includes/footer.php') 
    ?>
    
 <script src="javascript/script.js"></script>
    
</body>
</html>