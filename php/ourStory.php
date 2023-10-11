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
    <meta name="description" content="The Dark Side - Like you, we love coffee Our story begins in 2023 when we decided to open this webstore to share our passion for coffee.
    Here in Portugal we love it and we can not live without it.
    Coffee is not just coffee.">
    <title> Our story | The Dark Side </title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
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
            <a href="contact.php"> Contact </a>
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

    <section class="story_home">

        <div class="story_home-img">
            <img src="images/butfirstcoffee.jpg" alt="butfirstcoffee">
        </div>
        <h2> Like you, we love coffee </h2> <br>

       
    </section>

    <section class="mainStory_text">
        <p> Our story begins in 2023 when we decided to open this webstore
            to share our passion for coffee. <br> Here in Portugal we love it and we can not live without it. <br>
            Coffee is not just coffee. <br>Coffee is where conversations begin and creativity ignites. <br>
            In its nature, ceremony, and tradition, coffee brings communities together, stimulates the mind, 
            and unlocks endless potentials.
        </p>

    </section>

    <section class="story_imgGrid">
       
         <img src="images/raw coffee beans.jpg" alt="raw coffee beans">
         <img src="images/roasted coffee.jpg" alt="roasted coffee">
         <img src="images/bags.jpg" alt="bags of coffee">
         <img src="images/coffeeonhands.jpg" alt="coffee on hands">
         <img src="images/cup of coffee.jpg" alt="cup of coffee">
        
    </section>
    <hr>
    <?php  
     include('includes/footer.php') 
    ?>
    
    <script src="javascript/script.js"></script>
</body>
</html>