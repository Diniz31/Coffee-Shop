<?php

// página do Admin. Só inicia sessão se estiver Logged In como Admin
session_start();
if(!isset($_SESSION['LoginAdmin'])){
    header('location: login_reg.php');
} 
include('includes/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>
<header class="header">
        <a href="index.html" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
            <span style="color:#C09F41; font-size:25px; padding-left: 25px;">Hi, Admin <?php echo $_SESSION['LoginAdmin']; ?></span>

        </a>
        <nav class="navbar" data-visible="false">
            
         <a href="logout.php"> Logout </a>
            
        </nav>
        <div class="login-cart" id="login-cart">
        <div class="menu" id="menu-btn" aria-expanded="false">
              <i class="fa-solid fa-bars"></i>
            </div>
        </div>  
    </header>

    <div class="main">
      <div class="callButtons">
        <a href="#Products" class="callBtn" onclick="showProducts()">
            <span> Products </span>
        </a>
        <a href="#Orders" class="callBtn" onclick="showOrders()">
            <span> Orders </span>
        </a>
        <a href="#Users" class="callBtn" onclick="showUsers()">
            <span> Users </span>
        </a>
      </div>  

        <div class="content-container" id="content-container">

        </div>
    </div>
    

    <script>
        // mostrar todos os produtos
      function showProducts(){
       var xhttp = new XMLHttpRequest();
       var data = document.getElementById('content-container');

       xhttp.onload = function() {
        if (this.status === 200) {
        data.innerHTML = this.responseText;
        } 
        else {
        alert('Something is wrong!')
        }
        };

        xhttp.open('GET', 'all_products.php');
        xhttp.send();
       }


       // mostrar todas as encomendas
      function showOrders(){
       var xhttp = new XMLHttpRequest();
       var data = document.getElementById('content-container');

       xhttp.onload = function() {
        if (this.status === 200) {
        data.innerHTML = this.responseText;
        } 
        else {
        alert('Something is wrong!')
        }
        };

        xhttp.open('GET', 'all_orders.php');
        xhttp.send();
       }

       // mostrar todos os utilizadores
       function showUsers(){
       var xhttp = new XMLHttpRequest();
       var data = document.getElementById('content-container');

       xhttp.onload = function() {
        if (this.status === 200) {
        data.innerHTML = this.responseText;
        } 
        else {
        alert('Something is wrong!')
        }
        };

        xhttp.open('GET', 'all_users.php');
        xhttp.send();
       }
    </script>
    <script src="javascript/script.js"></script> 
</body>
</html>