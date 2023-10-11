<?php
session_start();
if(!isset($_SESSION['LoginAdmin'])){
  header('location: login_page.php');
}
 include('includes/db.php');
  $id= $_GET['userID'];
  $select = " SELECT * FROM utilizadores WHERE userID = '$id'";
  $data = mysqli_query($conn, $select);
  $row = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit User </title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
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
     <form action="" name="editUser_form" method="POST">
       <div class="input">
       Username: <br>
      <input type="text"  name="username" value="<?php echo $row['username']; ?>" maxlength="50" size="40" style="color:#C09F41;" disabled>
      </div>
        <div class="input">
        Email: <br>
      <input type="email"  name="email" value="<?php echo $row['email']; ?>" maxlength="60" size="50" required="required">
      </div>
        <div class="input">
        Password: <br>
      <input type="password"  name="pass" value="<?php echo $row['pass']; ?>" maxlength="60" size="50" style="color:#C09F41;" disabled>
      </div>
       <div class="input">
       Role: <br>
      <select name="role" id="role" value="<?php echo $row['role']; ?>" required>
        <option value=""> ... </option>
        <option value="Cliente"> Cliente </option>
        <option value="Admin"> Admin </option>
      </select>
      </div>
      
       <input type="submit" value="Save changes" name="btnUpUser" class="addP"> 

    </div>


  <?php
    if(isset($_POST['btnUpUser'])) {
      $role = $_POST['role'];
      $email = $_POST['email'];


      $update = "UPDATE utilizadores SET  email='$email', role='$role' WHERE userID='$id' ";

      mysqli_query($conn, $update);
      
      echo "<script> alert('Updated with success!') </script>";
      header('location: adminpage.php');
    }
 ?>
</body>
</html>