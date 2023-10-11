<?php
session_start();
include('includes/db.php');

if(isset($_SESSION['LoginUser'])){
    $user = $_SESSION['LoginUser'];
}else {
    header('location:login_reg.php');
}

$cart_items = isset($_SESSION['cart_items']) ? $_SESSION['cart_items'] : null;

// verifica se os items estão dispoviveis
if ($cart_items){    
    $items_name = $cart_items['items_name'];
    $price = $cart_items['price'];
    $img = $cart_items['img'];
    $stock = $cart_items['stock'];
    $quantities = $cart_items['quantities'];
    $total = $cart_items['total'];
} else {
    // se não tiver info disponivel
    echo "Cart information not found.";
}



if(isset($_POST['checkout_btn'])){
    $user_id = $_SESSION['UserID'];
    $name = $_POST['nomeCliente'];
    $dateB = $_POST['dataNasCliente'];
    $address = $_POST['moradaCliente'];
    $dataPedido = date('Y-m-d');
    $total = $_POST['total'];
  
    // Inserir na tabela "encomendas"
    $query = "INSERT INTO encomendas (userID, precoTotal, dataEnc, nomeCliente, dataNasCliente, moradaCliente) 
    VALUES ('$user_id', '$total', '$dataPedido', '$name', '$dateB', '$address') ";
    mysqli_query($conn, $query);
    $encomenda_id = mysqli_insert_id($conn); // Obtém o ID da encomenda inserida
  
    // Inserir os produtos da encomenda na tabela "encomenda_produtos"
    
    foreach ($quantities as $product_id => $product_qtty){
        $product_total_price = $price[$product_id] * $product_qtty;
  
        $query_produto = "INSERT INTO encomenda_produtos (encID , produtoID, quantidade, precoProduto) 
        VALUES ('$encomenda_id', '$product_id', '$product_qtty', '$product_total_price') ";
        mysqli_query($conn, $query_produto);

        $new_stock = $stock[$product_id] - $product_qtty;
        $update_stock_query = "UPDATE produtos SET stock = '$new_stock' WHERE produtoID = '$product_id'";
        mysqli_query($conn, $update_stock_query);

    }
  

    $success_message = "Success!\n You've completed your order.\n The order will be prepared and shipped\n 
    as quickly as possible.\n Thank you for buying with The Dark Side.\n See you soon!";
    
    if (!empty($success_message)) {
        echo '<div class="success_message_container" style="width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: #0E0E0E;
        text-align: center;">';
        echo '<div class="success_message" style="max-width: 320px;
        height: auto;
        font-size: 20px;
        color: #C09F41;
        margin-bottom: 10px;">';
        echo '<p>' . $success_message . '</p>';
        echo '</div>';
        echo '</div>';
        unset($_SESSION['cart_items']); // Zera o carrinho nesta pagina.
        unset($_SESSION['cart']); // Zera o carrinho na pagina cart.php
        header("refresh:6;url=store.php"); // Redireciona após 3 segundos para store.php
        exit();
    }

}

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
    <title>Checkout</title>
</head>
<body>

   <header class="header">
        <a href="#">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide" style="width:60px; height:60px;">
            <!-- username aparece se não for guest -->
            <?php if($user){  echo "<span class='user'>  $user's cart: </span> "; } ?>
        </a>
    </header> 

    <!-- permite editar o carrinho e voltar à Store -->
    <div class="keep_buying">
      <a href="store.php"> <i class="fa-solid fa-angle-left"></i> Keep shopping </a>
      <a href="cart.php"> <i class="fa-solid fa-angle-left"></i> Edit cart </a>
    </div>


 <div class="checkout_box">
    <div class="checkout_cart">
     <?php
  
     if($cart_items){
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
            echo '<div class="pro_name">  ' . $product_name . '</div>';
            echo '<div class="pro_price">  ' . number_format($product_price, 2) . '€</div>';
            echo '<div class="pro_qtty"> <p> ' . $product_qtty . '</p></div>';
            echo '<div class="pro_total_price"> ' . number_format($total_price, 2) . '€</div>';
            echo '</div>';
            echo '</div>';

            $total += $total_price;
        }
          
    }
  ?>
  </div>
    <div class="total_price"> <p style="color:#C09F41; margin-top: 15px; font-size:12px;"> Total purchase price: <?php echo number_format($total,2); ?>€ </p> </div>
</div>

        <div class="payment">
            <i class="fa-solid fa-euro-sign" style="font-size:25px; color:#000;"></i>
            <h3 style="font-size:12px"> Easy payment </h3>
        </div>
      
        <div class="pay">
          <h3> Payment Method </h3> <br>
          <div class="pay_img">
            <input type="radio">
            <h5 style="font-size: 10px; margin-right:15px;"> Credit cart : </h5>
            <img src="images/visa.png" alt="visa" width="20"> 
            <img src="images/mastercard.png" alt="mastercard" width="20">
          </div>
          <div class="g_pay">
            <input type="radio">
            <h5 style="font-size: 10px; margin-right:25px;"> Buy with </h5>
            <img src="images/googlepay.png" alt="googlepay" width="36">
          </div>

          <div class="cash">
            <input type="radio">
            <h5 style="font-size: 10px;"> Cash on delivery <i class="fa-solid fa-hand-holding-dollar"></i> <i class="fa-solid fa-truck"></i> </h5>
          </div>

            <div class="credit_pay">
                <h5 style="margin-bottom: 10px;"> Pay securely using your credit card </h5>
                <p style="font-size:8px;"> Card Number *</p>
                <div class="credit_box">
                  <input type="text" placeholder="**** **** **** ****">  <i class="fa-regular fa-credit-card"></i>
                </div>
                <p style="font-size:8px;"> Expiration (MM/YY)* </p>
                <div class="expiration_box">
                <input type="text" placeholder=" MM/YY ">
                </div>
                <p style="font-size:8px;"> Card Security Code*</p>
                <div class="security_box">
                <input type="text" placeholder="***">
                </div>
                <p style="font-size:8px;"> Name on Card </p>
                <div class="name_on_card">
                <input type="text" placeholder=" Name ">
                </div>
            </div>
        </div> 

        <div class="delivery">
            <i class="fa-solid fa-truck-fast" style="font-size:25px; color:white;"></i>
            <h3 style="font-size:12px"> Free & Fast Delivery </h3>
        </div>

         <!-- Formulario para o registo da informação para o envio -->
         <div class="ship_details_title"><h3> Shipping details </h3></div>
        <div class="shipping">
          <!-- a utilização de required em cada input, obriga ao preenchimento de cada uma delas -->
        <form action="checkout.php" method="POST" class="shipping_form">
         <input type="text" name="nomeCliente" placeholder="Your name" required>
         <input type="text" name="moradaCliente" placeholder="Your address" required>
          <!-- Desta forma o cliente so poderá colocar uma data de nascimento válida a partir de 18 anos atrás. 
           O htmlspecialchars() - serve para escapar qualquer entrada do utilizador que será exibida no HTML, 
          evitando a saida de PHP.  Desta forma evita a execução de código javascript  -->
          <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
          <h4> <i class="fa-solid fa-circle-exclamation"></i> To complete the purchase you need to be over 18 </h4>
          <input type="date" name="dataNasCliente" class="dateB" required max="<?php echo htmlspecialchars(date('Y-m-d', strtotime('-18 years'))); ?>">
          <br> <button type="submit" name="checkout_btn" class="checkout_btn"> Place Order 
            <i class="fa-regular fa-circle-check"></i></button>
        </form>
        </div>


</body>
</html>

