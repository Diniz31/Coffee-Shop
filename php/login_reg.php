<?php 
session_start();

include('includes/db.php');

$message = '';

// Login
if(isset($_POST['btnLogin'])) {
    
    $user_name = $_POST['username'];
    $pass = md5($_POST['password']);

    if(!empty($user_name) && !empty($pass)) {

       $query = " SELECT * FROM utilizadores WHERE username ='$user_name' AND pass='$pass' ";
       $result = mysqli_query($conn, $query);

        if($result && mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
            if($row['role'] == 'Cliente'){
                $_SESSION['Role'] = $row['role'];
                $_SESSION['UserID'] = $row['userID'];
                $_SESSION['LoginUser'] = $row['username'];
                header('location: store.php');
            }
            
            }
        } else {
           echo $message = 'Invalid username ou password!';
        }
    } 
}
// Registo

if(isset($_POST['btnregist'])) {

    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    if(!empty($email) || !empty($pass)) {

    $query = "INSERT INTO utilizadores (username, email, pass) VALUES ('$user_name', '$email', '$pass')";

    mysqli_query($conn, $query);
    echo "<script> alert('Registration made with success!') </script>";
    }
    else{
        echo "<script> alert('Please insert valid data.') </script>";
    }

    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login/Registration </title>
    <link rel="icon" type="image/svg" href="images/mug-hot-solid.svg">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://kit.fontawesome.com/66a8b9b534.js" crossorigin="anonymous"></script>
</head>

<body>

    <header class="header">
        <a href="/PROJETO FINAL/index.php" class="logo">
            <img src="images/logowhite.jpg" alt="logoTheDarkSide">
        </a>

    </header>
    <div class="container">
        <div class="box-form">

            <div class="form log">
                <form action="login_reg.php" name="formLog" method="POST">
                    <h2> Client Login </h2>

                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <p style="color: red; font-size:12px;"><?php echo $message; ?></p>
                    <button type="submit" name="btnLogin" class="ic">
                        Login 
                    </button>
                    <p> Don't have an account? <span onclick="switchLogReg()"> Register Now </span> </p>
                    <p> Admin <a href="AdminLogin.php" style="color: #C09F41;"> Login </a></p>
                </form>
            </div>   


            <div class="form reg">

                <form action="login_reg.php" name="formReg" method="POST">
                    <h2> Client Registration </h2>

                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="btnregist" class="ic">
                      Register 
                    </button>
                    <p> Already have an account? <span onclick="switchRegLog()"> Login </span> </p>
                </form>
            </div>    
            
        </div>
    </div>


    <script>

        let login = document.querySelector('.log');
        let regist = document.querySelector('.reg');
        let loginAdmin = document.querySelector('.logAdmin');

        function switchLogReg() {
            login.style.display = "none";
            regist.style.display = "block";

        }
        function switchRegLog() {
            login.style.display = "block";
            regist.style.display = "none";

        }

    </script>
</body>

</html>