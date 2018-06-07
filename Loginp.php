<?php

	$inData = getRequestInfo();

	$id = 0;
	$userName = $inData["Username"];
	$counter = count($inData);
	$searchResults = "";
	$searchCount = 0;

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$sql = "SELECT UserID,Username FROM Users where Username='" . $inData["Username"] . "' and Password='" . $inData["Password"] . "'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$id = $row["UserID"];
			$data = "SELECT UserID,FirstName,LastName,Phone,Address,City,State,Zipcode,Nickname,ContactID FROM Contacts where UserID='" . $id . "'";
			$dataSql = $conn->query($data);
			if($dataSql->num_rows > 0)
			{
			 while($userData = $dataSql->fetch_assoc())
			 {
				if($searchCount > 0)
					{
						$name .='" "';
					}
					$searchCount++;
					$name .='"' . $userData["UserID"] . ", " . $inData["Username"] . ", " . $userData["FirstName"] . ", " . $userData["LastName"] . ", " . $userData["Phone"] . ", " . $userData["Address"] . ", " . $userData["City"] . ", " . $userData["State"] .
						", " . $userData["Zipcode"] . ", " . $userData["Nickname"] . ", " . $userData["ContactID"] . '"';
				}
			}
			returnWithInfo($id, $userName, $name);
		}
		else
		{
			returnWithError($userName, $counter, "No User Found");
		}
		$conn->close();
	}



	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson($obj)
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError($userName, $counter, $str)
	{
		$retValue = '{"id":0,"Username":"'. $userName .'","Counter":"' . $counter . '""Error":"' . $str . '"}';
		sendResultInfoAsJson($retValue);
	}

	function returnWithInfo($id, $userName, $str)
	{
		//$retValue = '{"id":' . $id . ',"Username":"' . $userName . '","Data": '. $str .'}';
		$retValue = json_encode($str);

		sendResultInfoAsJson($retValue);
	}

?>
