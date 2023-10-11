<?php 
session_start();

include('includes/db.php');

$messageA= '';

// Admin Login

if(isset($_POST['btnLoginAdmin'])) {
    
    $user_name = $_POST['username'];
    $pass = md5($_POST['password']);

    if(!empty($user_name) && !empty($pass)) {

       $query = " SELECT * FROM utilizadores WHERE username ='$user_name' AND pass='$pass' ";
       $result = mysqli_query ($conn, $query);

        if($result && mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                
                if($row['role'] == 'Admin'){
                 $_SESSION['LoginAdmin'] = $row['username'];
                 $_SESSION['Role'] = $row['role'];
                 $_SESSION['UserID'] = $row['userID'];
                  header('location: adminpage.php');
                } 
                else{
                    echo $messageA = ' You do not have access! <br> Please LOGIN on the client side.';
                }
            }
        } else {
           echo $messageA = 'Username ou Password inválidos!';
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Login </title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>
<body>

<header class="header">
        <a href="/PROJETO FINAL/index.html" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
        </a>

    </header>
    <div class="container">
        <div class="box-form">

            <div class="form logAdmin">
                <form action="AdminLogin.php" name="formLog" method="POST">
                    <h2> Admin / Owner </h2>

                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <p style="color: red; font-size:12px;"><?php echo $messageA; ?></p>
                    <button type="submit" name="btnLoginAdmin" class="ic">
                      Login 
                    </button>
                    <p> Client <a href="login_reg.php" style="color: #C09F41;"> Login</a></p>
                </form>
            </div> 
    
</body>
</html>