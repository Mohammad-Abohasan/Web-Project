<?php

@include 'config.php';
session_start();

   if(!isset($_SESSION['admin_id'])) {
      header('location:login_form.php');
   } else {
      $id = $_SESSION['admin_id'];
      $select = "SELECT * FROM user_form WHERE id = '$id'";
      $result = $conn -> query($select);
      $row = $result -> fetch_assoc();
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>

<body>
   <div>
      <div>
         </div><img src="<?php echo 'uploads/'.$row['image_url'] ?>" height="200px" width="200px"></div>
         <h3>hi, admin</h3>
         <h1>welcome <?php echo '<span style="color:red"><b>'.$row['name'].'</b></span>' ?>, you can edit your info: <a href="edit_user.php?id=<?php echo $_SESSION['admin_id']?>">Edit</a></h1>
         <p>this is an admin page</p>
         <div>
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Photo</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Password</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  <tr>
               </thead>
               <tbody>
                  <?php 
                     $result = $conn -> query('SELECT * FROM user_form WHERE user_type="user"');
                     while($row = $result->fetch_assoc()) { 
                        ?>
                        <tr>
                           <td><img src="<?php echo 'uploads/'.$row['image_url'] ?>" height="60px" width="60px"></td>
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['email']; ?></td>
                           <td><?php echo $row['password']; ?></td>
                           <td><a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                           <td><a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                        </tr>
                  <?php
                     }
                  ?>
               </tbody>
            </table>
         </div>
         <a href="add_user.php" class="btn">Add User</a>
         <a href="logout.php" class="btn">logout</a>
      </div>
   </div>
</body>

</html>