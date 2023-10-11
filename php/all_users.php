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
    <title> All users </title>
</head>
<body>
<div class="userTable">
    <?php
     $sql = "SELECT * FROM utilizadores ";
     $result = mysqli_query ($conn, $sql);
     if($result) {
    
     if(mysqli_num_rows($result) !==0) {
    ?>
   
    <table> 
      
        <tr>
            <th> Username </th> 
            <th> Email </th>
            <th> Role </th>
        </tr>
            <?php
              while($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <?php if($_SESSION['UserID'] =='4') : ?>
                <td><a href="edit_users.php?userID=<?php echo $row['userID'];?>" class="btn_edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a></td>
                <td onclick="return confirm(' Are you sure you want to delete this client ?')"><a href="delete_users.php?userID=<?php echo $row['userID'];?>" class="btn_delete" title="Delete"><i class="fa-solid fa-ban"></i></a></td>
                <?php endif; ?>
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