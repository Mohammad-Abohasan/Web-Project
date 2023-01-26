<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
   $email = test_input($_POST['email']);
   $pass = $_POST['password'];

   $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
   $result = $conn -> query($select);

   if($result -> num_rows > 0) {
      $row = $result -> fetch_assoc(); 
      if($row['user_type'] == 'admin') {
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      } elseif($row['user_type'] == 'user') {
         $_SESSION['user_id'] = $row['id'];
         header('location:user_page.php');
      }
   } else {
      $error[] = 'incorrect email or password!';
   }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
</head>

<body>
   <div>
      <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" required placeholder="enter your email">
      <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $pass : ''; ?>" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now">
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<div style="color:red"><b>'.$error.'</b></div>';
            };
         };
      ?>
      <p>don't have an account? <a href="register_form.php">register now</a></p>
      </form>
   </div>
</body>

</html>