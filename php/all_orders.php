<?php
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
    <title>All Orders</title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>
    
<div class ="orderList">

<?php
 $sql = "SELECT 
 e.encID,
 e.userID,
 e.precoTotal,
 e.dataEnc,
 e.nomeCliente,
 e.dataNasCliente,
 e.moradaCliente,
 ep.produtoID,
 ep.quantidade,
 ep.precoProduto
FROM 
 encomendas e
JOIN 
 encomenda_produtos ep ON e.encID = ep.encID;
";
 $result = mysqli_query ($conn, $sql);
 if($result) {

 if(mysqli_num_rows($result) !==0) {
?>
<table>
  <div class="tableTitles">
    
    
  </div>
<tr>
    <th> Order nº </th>
    <th> User nº </th>
    <th> User Name </th> 
    <th> User Birth date</th> 
    <th> User address </th>
    <th> Order Total Price </th>
    <th> Order date </th>
    <th> Product nº </th>
    <th> Product quantity </th>
    <th> Product Total Price </th>

    
  </tr>
<?php while($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
      <td> <?php echo $row['encID']; ?></td>
      <td> <?php echo $row['userID']; ?></td>
      <td> <?php echo $row['nomeCliente']; ?></td>
      <td> <?php echo $row['dataNasCliente']; ?> </td> 
      <td> <?php echo $row['moradaCliente']; ?></td>
      <td> <?php echo $row['precoTotal']; ?>€</td>
      <td> <?php echo $row['dataEnc']; ?></td>
      <td> <?php echo $row['produtoID']; ?></td>
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

</body>
</html>