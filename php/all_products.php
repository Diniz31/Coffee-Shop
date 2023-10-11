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
    <title>All Products</title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>
    
<div class ="prodList">

<?php
 $sql = "SELECT * FROM produtos ORDER BY preco ASC";
 $result = mysqli_query ($conn, $sql);
 if($result) {

 if(mysqli_num_rows($result) !==0) {
?>
<table>
  <div class="tableTitles">
    <a href="add_products.php" class="btn_add" title="Add"> Add new product 
    <i class="fa-regular fa-square-plus"></i></a> 
    
  </div>
<tr>
    <th> Image </th>
    <th> Product Name </th>
    <th> Description </th> 
    <th> Price</th> 
    <th> Stock </th>
    <th> Type </th>
    
  </tr>
<?php while($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
      <td> <?php echo "<img style='width:25px; height:30px; object-fit:contain;' src='pics/" .$row['imagemP']."'>"?></td>
      <td> <?php echo $row['produtoNome']; ?></td>
      <td> <?php echo $row['produtoDesc']; ?></td>
      <td> <?php echo $row['preco']; ?> €</td> 
      <td> <?php echo $row['stock']; ?></td>
      <td> <?php echo $row['tipo']; ?></td>
      <td><a href="edit_products.php?produtoID=<?php echo $row['produtoID'];?>" class="btn_edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a></td>
      <td onclick="return confirm(' Do you really want to delete this product ?')"><a href="delete_products.php?produtoID=<?php echo $row['produtoID'];?>" class="btn_delete" title="Delete"><i class="fa-solid fa-ban"></i></a></td>

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