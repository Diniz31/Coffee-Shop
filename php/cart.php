<?php
session_start();
include('includes/db.php');

$user= "";

if(isset($_SESSION['LoginUser'])){
    $user = $_SESSION['LoginUser'];
}



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


if (isset($_GET['empty'])) {   // esvaziar totalmente o carrinho
    unset($_SESSION['cart']);
    header('location: cart.php');
    exit();
}

if (isset($_GET['remove']) && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    header('location: cart.php');
    exit();
}

if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $product_id => $new_quantity) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = max(1, intval($new_quantity));  // Garante que a quantidade seja no mínimo 1
        }
    }
    header('location: cart.php');
    exit();
}


$product_ids = array_keys($_SESSION['cart']);  // Array dos IDs dos produtos no carrinho
$items_name = array();
$price = array();
$img = array();
$stock = array();
$quantities = $_SESSION['cart'];  // Array associativo com IDs dos produtos como chave e quantidades como valor

if (!empty($product_ids)) {
    $product_ids_string = implode(',', $product_ids);  // Converte os IDs em strings separada por vírgulas para a consulta SQL
    $sql = "SELECT * FROM produtos WHERE produtoID IN ($product_ids_string)";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items_name[$row['produtoID']] = $row['produtoNome'];
            $price[$row['produtoID']] = $row['preco'];
            $img[$row['produtoID']] = $row['imagemP'];
            $stock[$row['produtoID']] = $row['stock'];
        }
    }
}

$total= 0;

$_SESSION['cart_items'] = array(
    'items_name' => $items_name,
    'price' => $price,
    'img' => $img,
    'stock' => $stock,
    'quantities' => $quantities,
    'total' => $total
);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
    <title> Your cart </title>
</head>
<body>

 <header class="header">
    <!-- username aparece se não for guest -->
   <?php if($user){  echo "<span class='user' style='font-size:25px;'>  $user's cart: </span> "; } ?>
 </header> 

 <div class="cart_container"> 
    
     <div class="cart_container_item">
         <form action="cart.php" method="POST">
             
            <?php
             $total = 0;
             foreach ($quantities as $product_id => $product_qtty) {
                $product_name = $items_name[$product_id];
                $product_price = $price[$product_id];
                $product_img = $img[$product_id];
                $product_stock = $stock[$product_id];
                $total_price = $product_price * $product_qtty;
                      
                echo '<div class="cart_item">';
                echo '<div class="cart_pic">';
                echo ' <img src="pics/' . $product_img . '"> ';
                echo '</div>';
                echo '<div class="cart_pic_info">';
                echo '<div class="pro_name"> <label> Name :</label> ' . $product_name . '</div>';
                echo '<div class="pro_price"> <label> Price :</label> ' . number_format($product_price, 2) . '€</div>';
            // coloquei um max com valor igual ao stock para que não seja possivel ao cliente pedir uma quantidade superior ao stock existente.
                echo '<div class="pro_qtty"> <label> Quantity :</label> <input type="number" name="quantities[' . $product_id . ']" class="btn_qt" value="' . $product_qtty . '" min="1" max="' . $product_stock . '"></div>';
                echo '<div class="pro_stock"> <label> Stock :</label> ' . $product_stock . '</div>';
                echo '<div class="pro_total_price"> <label> Total price :</label> ' . number_format($total_price, 2) . '€</div>';
                echo '</div>';
                echo '<div class="btn_cart_event">';
                echo '<button type="submit" name="update_cart" class="btn_event"> Update</button>';
                echo '</div>';
                echo '</div>';
      
                $total += $total_price;
             }
            ?>
      
       </form>
       <div> <p style="color:#C09F41; margin-top: 15px; font-size:12px;"> Total purchase price: <?php echo  number_format($total, 2); ?>€ </p> </div>
    </div>
    <div class="cart_item_remover">
     <?php
       foreach ($quantities as $product_id => $product_qtty) {
       echo '<div class="remove">';
       echo '<a href="cart.php?remove=&id='. $product_id .'"> Remove </a>';
       echo '</div>';
       }
     
     ?>
    </div>
</div>
<div class="cart-events">
    <button type="submit">
        <a href="store.php"> <i class="fa-solid fa-angle-left"></i> Continue shopping </a>
    </button>
        <!-- esvaziar carrinho -->
    <button type="submit">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1"> Empty the cart </a>
    </button>
   <button type="submit">
    <a href="checkout.php"> Proceed to checkout <i class="fa-solid fa-angle-right"></i> </a>
   </button>
</div>


</body>
</html>