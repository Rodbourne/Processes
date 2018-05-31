<?php

$userId = $inData["UserID"]
$userContactID = $inData["ContactId"]
//create connection
$conn = new msqli('localhost','root_suvrat','cop4331!','Contacts_Suvrat');

//test connection
if($conn->connect_error) {
  die ("Connection Error: " . $conn->connect_error);
}
//Deletes contact associated with specific userId from the database
$sql = "DELETE FROM Contacts WHERE $ContactId";
$cmp = "SELECT UserID, ContactID FROM Contacts WHERE $userId, $userContactID";
$result = $conn->query($cmp);

  if ($result->num_rows > 0)
  {
    mysqli_query($conn, $sql) {
      sendResultInfoAsJson( "Contact was succesfully deleted." );
    }
  }
  else {
      sendResultInfoAsJson( "ERROR! Contact could not be deleted." );
  }

$conn->close();
?>
