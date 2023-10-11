<?php
include('includes/db.php');
if(!isset($_SESSION['LoginAdmin'])){
    header('location: login_reg.php');
  }
$id=$_GET['produtoID'];  
$query = "DELETE FROM produtos WHERE produtoID ='$id' "; 
$data = mysqli_query($conn, $query);

if ($data){
    echo "<script> confirm('Product deleted with success!') </script>";
    header('location: adminpage.php');
}
else{
    echo "<script> alert('Please try again') </script>";
    header('location: adminpage.php');
}
?>