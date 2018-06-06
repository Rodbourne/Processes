<?php

	$inData = getRequestInfo();

	$userID = $inData["UserID"];
	$contactID = $inData["ContactID"];

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$sql = "SELECT UserID,ContactID FROM Contacts WHERE UserID='" . $inData["UserID"] . "' AND ContactID='" . $inData["ContactID"] . "'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
      $data = "DELETE FROM Contacts WHERE UserID='" . $inData["UserID"] . "' AND ContactID='" . $inData["ContactID"] . "'";
      $x = $conn->query($data);
			returnWithInfo($userID, $contactID, "Contact Deleted");
		}
		else
		{
			returnWithError( "No Records Found" );
		}
		$conn->close();
	}

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
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

	function returnWithInfo($userID, $contactID, $str)
	{
		$retValue = '{"id":' . $userID . ',"Contact":' . $contactID . '"Error":"' . $str . '"}';
		sendResultInfoAsJson($retValue);
	}

?>
