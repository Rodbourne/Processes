<?php

$conn = new mysqli('localhost','root_suvrat','cop4331!','Contacts_Suvrat');

//test connection
if($conn->connect_error) {
  die ("Connection Error: " . $conn->connect_error);
}

if(isset($_POST['user']) && isset($_POST['password'])) {

  $pWord = $_POST['password'];
  $newUser = $_POST['username'];
}

  $checkUsername = mysqli_query("SELECT * FROM Users WHERE Username = '$newUser'");

  if(mysqli_num_rows($checkUsername) >= 1)
  {
    sendResultInfoAsJson("Error! Username already exists.");
  }
  else
      {
        $registerUser = mysqli_query("INSERT INTO Users (Username, Password) VALUES ('$newUser','$pWord')");
      }

  if($registerUser)
      {
        sendResultInfoAsJson("Your account was successfully created!");
      }
  $conn->close();
?>
