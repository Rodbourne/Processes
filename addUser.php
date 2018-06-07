<?php
	$inData = getRequestInfo();

	$userName = $inData["Username"];
	$passWord = $inData["Password"];
	$firstName = "Default";
  $lastName =  "Default";
  $phone =  "Default";
  $address =  "Default";
  $city =  "Default";
  $state =  "Default";
  $zipcode =  "Default";
  $nickname =  "Default";

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error || $userName == null)
	{
		returnWithError($conn->connect_error);
	}
	else
	{
		$sql = "insert INTO Users (Username, Password) VALUES (' $userName ', ' $passWord ')";
		$sqlPull = "SELECT (UserID,Username) FROM Users where Username='" . $userName . "' and Password='" . $passWord . "'";
		$dataSql = "insert INTO Contacts (UserID, FirstName, LastName, Phone, Address, City, State, Zipcode, Nickname) VALUES (' $id ', ' $firstName  ', '  $lastName  ', '  $phone  ', '  $address  ', ' $city  ', '  $state  ', '  $zipcode  ', '  $nickname  ')";
		if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
		}
	//	$res = $conn->query($sqlPull);
	//		if($res->num_rows > 0)
	//		{
	//			$row = $res->fetch_assoc();
		//		$id = $row["UserID"];
		//		$x = $conn->query($dataSql);
		//	}
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
