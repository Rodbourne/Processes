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
	$conn = new mysqli("localhost", "userName", "passWord", "databaseName");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{                              /* Data fields */
		$sql = "insert into Contact (UserId,FirstName,LastName,Phone,State,City,Address,Zipcode,NickName) VALUES (" . $userId . ",'" . $contactFName . ",'" . $contactLName . ",'" . $contactPhone . ",'"
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
