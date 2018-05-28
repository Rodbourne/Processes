<?php
	$inData = getRequestInfo();
	$contactFName = $inData["contactFName"];
  $contactLName = $inData["contactLName"];
  $contactPhone = $inData["phone"];
  $contactAddress = $inData["address"];
  $contactCity = $inData["city"];
  $contactState = $inData["state"];
  $contactZipcode = $inData["zipcode"];
  $contactNickName = $inData["nickName"];
	$userId = $inData["userId"];

  //Not sure what to put in these fields
	//port = 3306
	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{                              /* Data fields */
		$sql = "insert into Contacts (UserID,FirstName,LastName,Phone,State,City,Address,Zipcode,Nickname) VALUES (" . $userId . ",'" . $contactFName . ",'" . $contactLName . ",'" . $contactPhone . ",'"
     . $contactState . ",'" . $contactCity .  ",'" . $contactAddress . ",'" $contactZipcode ",'" . $contactNickName ."')";
		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError( $conn->error );
		}
		$conn->close();
	}
  // Everything here should transfer without error
	returnWithError("");

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

?>