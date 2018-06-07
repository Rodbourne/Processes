<?php
	$inData = getRequestInfo();
	$userName = $inData["Username"];
	$passWord = $inData["Password"];
	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error || $userName == null)
	{
		returnWithError($conn->connect_error);
	}
	else
	{
		$sql = "insert INTO Users (Username, Password) VALUES (' $userName ', ' $passWord ')";
		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError($conn->error);
		}
		$conn->close();
	}
	//returnWithError("");
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