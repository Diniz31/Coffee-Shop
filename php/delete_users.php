<?php
include('includes/db.php');
if(!isset($_SESSION['UserId'])=='4'){
    header('location: login_reg.php');
  }
$id=$_GET['userID']; 
$query = "DELETE FROM utilizadores WHERE userID='$id'"; 
$data = mysqli_query($conn, $query);

if ($data){
    echo "<script> confirm('Profile deleted with success!') </script>";
    header('location: adminpage.php');
}
else{
    echo "<script> alert('Please try again') </script>";
    header('location: adminpage.php');
}
?>