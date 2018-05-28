<?php
	//This should transfer with minor changes to fit our fields
	$inData = getRequestInfo();

	$id = 0;
	$firstName = "";
	$lastName = "";

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$sql = "SELECT UserID FROM Users where Username='" . $inData["username"] . "' and Password='" . $inData["password"] . "'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$id = $row["userID"];
			sendResultInfoAsJson("Success! User Logged In");
		}
		else
		{
			sendResultInfoAsJson("ERROR! User or Password Does Not Exist");
		}
		$conn->close();
	}

	returnWithInfo($id);

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function returnWithInfo( $firstName, $lastName, $id )
	{
		//Error is there from professor, should return null
		$retValue = '{"UserID":' . $id . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}

?>
