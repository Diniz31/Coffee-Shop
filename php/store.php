<?php
session_start();

$user= "";

if(isset($_SESSION['LoginUser'])){
    $user = $_SESSION['LoginUser'];
} 
    

include('includes/db.php');


if(!isset($_SESSION['cart'])){
   $_SESSION['cart'] = array();
}

$message_cart="";

if(isset($_POST['add_to_cart'])) {
    $produtoID = $_POST['produtoID'];
    $quantidade = $_POST['qtty'];

    
    
    
    if(!isset($_SESSION['cart'][$produtoID])) {
        // Adicionar o produto uma unidade. Se pretender aumentar a quantidade a comprar, alterar no carrinho
        $_SESSION['cart'][$produtoID] = $quantidade;
        
    }

    header('location: ' .$_SERVER['PHP_SELF']. '?' . SID);
    exit();
}


if(isset($_POST['empty_cart'])) {  // esvaziar totalmente o carrinho
    $_SESSION['cart'] = array();
    header('location: store.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Tiago Pereira">
    <meta name="description" content="The Dark Side - Our coffee and products.">
    <title> Store | The Dark Side </title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>

</head>
<body>

    <header class="header">
        <a href="#" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
        </a>
        <?php
          if($user) {
              echo "<a href='accountpage.php' class='user'> Hi, $user </a>";
          }
        ?>

        <nav class="navbar" data-visible="false">
            <a href="ourStory.php">Our story</a>
            <a href="contact.php">Contact</a>
            <a href="/PROJETO FINAL/index.php">Home</a>
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
             <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
              <div class="cartAmount"> 
                <?php 
                $totalItems = 0;
                foreach ($_SESSION['cart'] as $quantity) {
                    $totalItems += $quantity;
                }
                echo $totalItems; ?></div>
            </div>
            <div class="menu" id="menu-btn" aria-expanded="false">
              <i class="fa-solid fa-bars"></i>
            </div>
        </div>

    </header> 

    <section class="store_home">

        <div class="store_home-img">
            <img src="images/1coffee.jpg" alt="coffee ad">
        </div>
        <h2> Our coffee and products </h2> <br>
    </section>

    <div class="filter">
     <p> Sort by : </p>
     <select name="category" id="category">
        <option value="all">All</option>
        <option value="coffee">Coffee</option>
        <option value="product">Products</option>
     </select>
      <button onclick="applyFilter()" class="applyCat"> <i class="fa-solid fa-check"></i> </button>
    </div>

    
    <section class="products" id="products">
         
        <?php
        $sql = "SELECT * FROM produtos";
        $result = mysqli_query ($conn, $sql);
        if($result) {

        if(mysqli_num_rows($result) !==0) {
        while($row = mysqli_fetch_array($result)) {
            $img = '\PROJETO FINAL/php/pics/'. $row['imagemP'];
            $category = $row['tipo'];
            $stock =$row['stock'];
        ?>

        <div class="item" id="item" data-category ="<?php echo $category; ?>">
            <form action="" method="POST">
            <div class="item-img">
              <img src="<?php echo $img; ?>" alt="<?php echo $row['produtoNome']; ?>" title="<?php echo $row['produtoNome']; ?>">
            </div>
            <div class="details">
                <h5> <?php echo $row['produtoNome']; ?> </h5>
                <p> <?php echo $row['produtoDesc']; ?></p>
                <div class="price-quantity">
                    <h4> <?php echo $row['preco']; ?> €</h4>
                </div>
                <?php if($stock ==0) {
                    echo "<p style='color:red;'>Out of Stock!</p>"; 
                } else{ // desta forma se o stock do produto for ZERO, o botão add to cart não aparece.
                ?>
                <input type="hidden" name="produtoID" value="<?php echo $row['produtoID']; ?>">
                <input type="hidden" name="qtty" value="1">
                <input type="hidden" name="stock" value="<?php echo $row['stock']; ?>">
                <input type="hidden" name="produtoNome" value="<?php echo $row['produtoNome']; ?>">
                <input type="hidden" name="preco" value="<?php echo $row['preco']; ?>">
                <input type="hidden" name="imagemP" value="<?php echo $img ?>">
                <button type="submit" class="addtocart" name="add_to_cart"> 
                 Add to cart <i class="fa-solid fa-arrow-right-long"></i> 
                </button>
                <?php
                }
                ?>
            </div>
            </form>
        </div>
        <?php
        }
        }
        }
        ?>

    </section>

  <hr>
    <?php  include('includes/footer.php'); ?>
    
 <script src="javascript/script.js"></script> 

</body>
</html>