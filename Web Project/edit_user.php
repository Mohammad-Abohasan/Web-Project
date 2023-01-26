<?php

@include 'config.php';
session_start();

  $id = $_GET['id'];
  $result = $conn -> query("SELECT * from user_form WHERE id='$id'");
  $row = $result -> fetch_assoc();
  if(isset($_POST['submit'])) {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $pass = $_POST['password'];
    if(!empty($img_url = $_FILES['photo']['name'])){
      $conn -> query("UPDATE user_form SET image_url='$img_url' WHERE id='$id'");
      move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/'.$_FILES['photo']['name']);
    }
    $conn -> query("UPDATE user_form SET name='$name', email='$email', password='$pass' WHERE id='$id'");
    if(isset($_SESSION['admin_id']))
      header('location:admin_page.php');
    else
      header('location:user_page.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit user</title>
  </head>

  <body>
    <div>
      <form action="" method="post" enctype="multipart/form-data">
        <h3>Edit</h3> 
        <label for="photo">Select image (<span style="color:red">if you need to edit it</span>):</label>
        <input id="photo" type="file" name="photo" accept=".png, .jpg, .jpeg">
        </br> </br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required placeholder="enter your name">
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required placeholder="enter your email">
        <input type="password" name="password" value="<?php echo $row['password']; ?>" required placeholder="enter your password">
        <input class="form-btn" type="submit" name="submit" value="Edit">
      </form>
    </div>
  </body>

</html>