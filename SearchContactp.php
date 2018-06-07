<?php

	$inData = getRequestInfo();
  $id = 0;
	$firstName = $inData["FirstName"];
	$lastName = $inData["LastName"];

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
	  $sql = "select UserID,ContactID,FirstName,LastName,Phone,Address,City,State,Zipcode,Nickname from Contacts where FirstName like '%" . $inData["FirstName"] . "%' and LastName like '%" . $inData["LastName"] . "%'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$id = $row["UserID"];
      $contactID = $row["ContactID"];
      $firstName = $row["FirstName"];
    	$lastName = $row["LastName"];
			$phone = $row["Phone"];
			$address = $row["Address"];
			$city = $row["City"];
			$state = $row["State"];
			$zipcode = $row["Zipcode"];
			$nickname = $row["Nickname"];
      returnWithInfo($firstName, $lastName, $id, $contactID, $phone, $address, $city, $state, $zipcode, $nickname);
		}
		else
		{
			returnWithError("Cant Find Contact");
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

	function returnWithError($err)
	{
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

	function returnWithInfo($firstName, $lastName, $id, $contactID, $phone, $address, $city, $state, $zipcode, $nickname)
	{
		$retValue = '{"id":' . $id . ',"firstName":"' . $firstName . '","lastName":"' . $lastName . '","ContactID":"' . $contactID . '","Phone":"' . $phone .'","Address":"' . $address .
			 '","City":"' . $city . '","State":"' . $state . '","Zipcode":"' . $zipcode . '","Nickname":"' . $nickname . '"}';
		sendResultInfoAsJson( $retValue );
	}

?>
