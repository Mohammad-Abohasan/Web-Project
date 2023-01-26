<?php

@include 'config.php';
  $id = $_GET['id'];
  $conn -> query("DELETE FROM user_form WHERE id='$id'");
  header('location:admin_page.php');
?>