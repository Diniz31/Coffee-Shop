<?php
session_start();
if(isset($_SESSION['LoginAdmin'])){
 // header('location: add_products.php');
} else{
  header('location: login_reg.php');
}
include('includes/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $nome = $_POST['produtoNome'];
  $desc = $_POST['produtoDesc'];
  $price = $_POST['preco'];
  $stock = $_POST['stock'];
  $type = $_POST['tipo'];
  $imagem = $_FILES['imagemP']['name'];
  $folder = "pics/";
  $target_file = $folder .basename($_FILES['imagemP']['name']);
  
  if(move_uploaded_file($_FILES['imagemP']['tmp_name'], $target_file)){

   $query = "INSERT INTO produtos (produtoNome, produtoDesc, preco, stock, tipo, imagemP) VALUES ('$nome', '$desc', '$price', '$stock', '$type','$imagem')";

    mysqli_query($conn, $query);
    echo "<script> alert('Adicionado com sucesso!') </script>";
    header('location:add_products.php');
  }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>

<header class="header">
        <a href="index.html" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
        </a>

        <div class="logout">
         <a href="adminpage.php"> <i class="fa-solid fa-arrow-left"></i> Back </a>
        </div>
    </header>
    <span class="user"> Hi, Admin <?php echo $_SESSION['LoginAdmin']; ?> </span>


    <div class="add">
        <h2>Add Product</h2>
     <form action="add_products.php" name="newPro_form" method="POST" enctype="multipart/form-data">
       <div class="input">
        Product name <br>
      <input type="text" id="produtoNome" name="produtoNome" value="" maxlength="50" size="40" required="required">
      </div>
        <div class="input">
        Product description <br>
      <input type="text" id="produtoDesc" name="produtoDesc" value="" maxlength="60" size="50" required="required">
      </div>
      <div class="input">
        Price <br>
        <input type="text" id="preco" name="preco" value="" required="required">
      </div>
      <div class="input">
        Stock <br>
        <input type="text" id="stock" name="stock" value="" required="required">
      </div>
       <div class="input">
       Type <br>
      <select name="tipo" id="tipo" required>
        <option value=""> ... </option>
        <option value="coffee"> Coffee </option>
        <option value="product"> Product </option>
      </select>
      </div>
       <div class="input">
       Image <br>
      <input type="file" id="imagemP" name="imagemP" value="" >
       </div>
      
       <input type="submit" value="Add" name="btnAddProduct" class="addP"> 

    </div>
      
      
      
      
</body>
</html>