<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function test_input($data) { 
  $data = htmlspecialchars($data);
  $data = trim($data);
  $data = stripslashes($data);
  return $data; 
}
?>