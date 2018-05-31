<?php
 // Will work on once we decide how were going to search the Data
 // IE by first name or last name ect..
 // Should just be minor changes
	$inData = getRequestInfo();
	$firstName = $inData["firstName"];
	$lastName = $inData["lastName"];
	$searchResults = "";
	$searchCount = 0;

	$conn = new mysqli("localhost", "root_suvrat", "cop4331!", "Contacts_Suvrat");
	if ($conn->connect_error)
	{
		sendResultInfoAsJson( $conn->connect_error );
	}
	else
	{
		$sql = "SELECT FirstName,LastName FROM Contacts WHERE FirstName LIKE '%" . $firstName . "%'" "AND WHERE LastName LIKE '%" . $lastName . "%'"
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				if( $searchCount > 0 )
				{
					$searchResults .= ",";
				}
				$searchCount++;
				$searchResults .= '"' . $row["firstName"] . $row["lastName"] . '"';
			}
		}
		else
		{
			sendResultInfoAsJson("No Records Found");
		}
		$conn->close();
	}

	returnWithInfo($searchResults);

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}

?>
