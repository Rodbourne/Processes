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
		$data = "SELECT FirstName,LastName,Phone,Address,City,State,Zipcode,Nickname,ContactID FROM Contacts";
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
	$dataRes = $conn->query($data);
	if ($dataRes->num_rows > 0)
	{
		while($userData = $result->fetch_assoc())
		{
			if($searchCount > 0)
			{
				$searchResults .= ",";
			}
			$searchCount++;
			$searchResults .= '"' . $row["firstName"] . $row["lastName"] . $row["phone"] . $row["address"] . $row["city"] . $row["state"] . $row["zipcode"] . $row["nickName"] . $row["contactID"] . '"';
		}
	}

	returnWithInfo($id);

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function returnWithInfo($id, $userData)
	{
		//Error is there from professor, should return null
		$retValue = '{"UserID":' . $id . ", " . $userData . "," '"Error:"}';
		sendResultInfoAsJson( $retValue );
	}

?>
