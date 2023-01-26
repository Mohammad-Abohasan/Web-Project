<?php

@include 'config.php';

if(isset($_POST['submit'])) {
  $name = test_input($_POST['name']);
  $email = test_input($_POST['email']);
  $pass = $_POST['password'];
  $cpass = $_POST['cpassword'];
  $user_type = $_POST['user_type'];
  $img_url = $_FILES['photo']['name'];

  move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/'.$_FILES['photo']['name']);
  $select = "SELECT * FROM user_form WHERE email = '$email'";
  $result = $conn -> query($select);

  if($result -> num_rows > 0) {
    $error[] = 'email already exist!';
  } else {
    if($pass != $cpass){
      $error[] = 'password not matched!';
    }else{
      $insert = "INSERT INTO user_form(name, email, password, user_type, image_url) VALUES('$name','$email','$pass','$user_type', '$img_url')";
      $conn -> query($insert);
      header('location:login_form.php');
    }
  }
};

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
  </head>

  <body>
    <div>
      <form action="" method="post" enctype="multipart/form-data">
        <h3>register now</h3>
        <label for="photo">Select image:</label>
        <input id="photo" type="file" name="photo" accept=".png, .jpg, .jpeg" required>
        </br> </br>
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" required placeholder="enter your name">
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" required placeholder="enter your email">
        <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $pass : ''; ?>" required placeholder="enter your password">
        <input type="password" name="cpassword" value="<?php echo isset($_POST['cpassword']) ? $cpass : ''; ?>" required placeholder="confirm your password">
        <select name="user_type">
          <option value="user" >user</option>
          <option value="admin" <?php echo isset($_POST['user_type']) && $user_type == 'admin' ? 'selected' : ''; ?> >admin</option>
        </select>
        <input type="submit" name="submit" value="register now">
        <?php
          if(isset($error)){
            foreach($error as $error){
              echo '<div style="color:red"><b>'.$error.'</b></div>';
            };
          };
        ?>
        <p>already have an account? <a href="login_form.php">login now</a></p>
      </form>
    </div>
  </body>

</html>