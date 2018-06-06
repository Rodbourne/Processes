<?php
	$inData = getRequestInfo();

	$firstName = $inData["FirstName"];
	$userId = $inData["UserID"];
  $lastName =  $inData["LastName"];
  $phone =  $inData["Phone"];
  $address =  $inData["Address"];
  $city =  $inData["City"];
  $state =  $inData["State"];
  $zipcode =  $inData["Zipcode"];
  $nickname =  $inData["Nickname"];

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error || $userId == null)
	{
		returnWithError($conn->connect_error);
	}
	else
	{
		$sql = "insert INTO Contacts (UserID, FirstName, LastName, Phone, Address, City, State, Zipcode, Nickname) VALUES (' $userId ', ' $firstName  ', '  $lastName  ', '  $phone  ', '  $address  ', ' $city  ', '  $state  ', '  $zipcode  ', '  $nickname  ')";
		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError($conn->error);
		}
		$conn->close();
	}

	returnWithError("");

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson($obj)
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError($err)
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson($retValue);
	}

?>
