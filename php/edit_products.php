<?php
session_start();
if(!isset($_SESSION['LoginAdmin'])){
  header('location: login_reg.php');
}
include('includes/db.php');
$id = $_GET['produtoID'];
$sql = "SELECT * FROM produtos WHERE produtoID = '$id' ";
$result = mysqli_query ($conn, $sql);
$row = mysqli_fetch_array($result);
    
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>

<header class="header">
        <a href="#" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
        </a>

        <div class="logout">
         <a href="adminpage.php"> <i class="fa-solid fa-arrow-left"></i> Back </a>
        </div>
    </header>
    <span class="user"> Hi, Admin <?php echo $_SESSION['LoginAdmin']; ?> </span>


    <div class="add">
        <h2>Edit Product</h2>
     <form action="" name="newPro_form" method="POST">
       <div class="input">
        Product name: <br>
      <input type="text" id="produtoNome" name="produtoNome" value="<?php echo $row['produtoNome']; ?>" maxlength="50" size="40" required="required">
      </div>
        <div class="input">
        Product description: <br>
      <input type="text" id="produtoDesc" name="produtoDesc" value="<?php echo $row['produtoDesc']; ?>" maxlength="60" size="50" required="required">
      </div>
      <div class="input">
        Price: <br>
        <input type="text" id="preco" name="preco" value="<?php echo $row['preco']; ?>" required="required">
      </div>
      <div class="input">
        Stock: <br>
        <input type="text" id="stock" name="stock" value="<?php echo $row['stock']; ?>" required="required">
      </div>
       <div class="input">
       Type: <br>
      <select name="tipo" id="tipo" value="<?php echo $row['tipo']; ?>" disabled>
        <option value=""> ... </option>
        <option value="coffee"> Coffee </option>
        <option value="product"> Product </option>
      </select>
      </div>
       <div class="input">
       Image: <br>
      <input type="file" id="imagemP" name="imagemP" value="<?php echo $row['imagemP']; ?>"  disabled>
       </div>
      
       <input type="submit" value="Save changes" name="btnUpProduct" class="addP"> 
      </form>
    </div>

    <?php
    if(isset($_POST['btnUpProduct'])) {
        $name = $_POST['produtoNome'];
        $desc = $_POST['produtoDesc'];
        $price = $_POST['preco'];
        $stock = $_POST['stock'];
        $type = $_POST['tipo'];
        $image = $_POST['imagemP'];


      $update = "UPDATE produtos SET produtoNome ='$name', produtoDesc ='$desc', preco ='$price', stock ='$stock' WHERE produtoID='$id' ";

      mysqli_query($conn, $update);
      
      echo "<script> alert('Registo alterado com sucesso!') </script>";
      header('location: adminpage.php');
    }
    ?>
      
      
</body>
</html>