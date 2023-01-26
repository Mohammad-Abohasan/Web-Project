<?php

@include 'config.php';
session_start();

   if(!isset($_SESSION['user_id'])) {
      header('location:login_form.php');
   } else {
      $id = $_SESSION['user_id'];
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
   <title>user page</title>
</head>

<body>
   <div>
      </div><img src="<?php echo 'uploads/'.$row['image_url'] ?>" height="200px" width="200px"></div>
      <h3>hi, user</h3>
      <h1>welcome <?php echo '<span style="color:red"><b>'.$row['name'].'</b></span>' ?>, you can edit your info: <a href="edit_user.php?id=<?php echo $_SESSION['user_id']?>">Edit</a></h1>
      <p>this is an user page</p>
      <a href="logout.php" class="btn">logout</a>
   </div>
</body>

</html>