<?php
session_start();
if(!isset($_SESSION['LoginUser'])){
  header('location: login_reg.php');
}

include('includes/db.php');

$userAtual = $_SESSION['LoginUser'];
$sql = "SELECT * FROM utilizadores WHERE username ='$userAtual' ";
$result = mysqli_query ($conn, $sql);
$row = mysqli_fetch_array($result);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
  <title> Your account </title>
</head>
<body>

<header class="header">
        <a href="store.php" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide" style="width:50px;">
            <span style="color:#C09F41; font-size:25px; padding-left: 25px;"><?php echo $_SESSION['LoginUser']; ?></span>
        </a>
        <div class="logout">
        <a href="store.php"> <i class="fa-solid fa-arrow-left"></i> Back </a>
        </div>
    </header>


    <div class="form edit">
      <h2> Edit profile </h2>
      <form action="" name="formReg" method="POST">
        <label> Username </label>
       <input type="text" name="username" placeholder="Username" value="<?php echo $row['username']; ?>" style="color:#C09F41;" disabled>
       <label> Email</label>
       <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
       <label> Password</label>
       <input type="password" name="password" placeholder="Password" value="<?php echo $row['pass']; ?>" required> <br>
       <button type="submit" name="btnUserUpdate" class="btn_update"> Save changes </button>
      </form>
    </div>
    
    <div class="seeOrders">
      
      <h2> Your orders </h2>

      <div class="userOrders">

     <?php

     $userID = $_SESSION['UserID'];
              $sql = "SELECT 
              e.encID,
              e.precoTotal,
              e.dataEnc,
              e.nomeCliente,
              ep.produtoID,
              ep.quantidade,
              ep.precoProduto,
              p.produtoNome
              FROM 
              encomendas e
              JOIN /* através das foreign keys conseguimos ter acesso à informação de outras tabelas
              e conseguimos disponibilizar ao cliente a informação que realmente lhe interessa perceber. */
              encomenda_produtos ep ON e.encID = ep.encID
              JOIN 
              produtos p ON ep.produtoID = p.produtoID 
              WHERE 
              e.userID = '$userID'
              ";
              $result = mysqli_query ($conn, $sql);
              if($result) {

              if(mysqli_num_rows($result) !==0) {
              ?>
              <table>
              <tr>
                  <th> Order nº </th>
                  <th> User Name </th> 
                  <th> Order date </th>
                  <th> Order Total Price </th>
                  <th> Product Name </th>
                  <th> Product quantity </th>
                  <th> Product Total Price </th>

                  
                </tr>
              <?php while($row = mysqli_fetch_array($result)) {
                  ?>
                  <tr>
                    <td> <?php echo $row['encID']; ?></td>
                    <td> <?php echo $row['nomeCliente']; ?></td>
                    <td> <?php echo $row['dataEnc']; ?></td>
                    <td> <?php echo $row['precoTotal']; ?>€</td>
                    <td> <?php echo $row['produtoNome']; ?></td>
                    <td> <?php echo $row['quantidade']; ?></td>
                    <td> <?php echo $row['precoProduto']; ?>€</td>

                  </tr>
                  <?php
                }
              ?>
              </table>
              <?php
              }
              }
              ?>

      </div>

    </div>


    <?php
    if(isset($_POST['btnUserUpdate'])) {
     
      $email = $_POST['email'];
      $pass = md5($_POST['pass']);

      $update = "UPDATE utilizadores SET  email='$email', pass='$pass' WHERE username='$userAtual' ";

      mysqli_query($conn, $update);
      
      echo "<script> alert('Registo alterado com sucesso!') </script>";
      
    } 
      
    ?>
  
</body>
</html>