<?php

	$inData = getRequestInfo();
	
	$searchResults = "";
	$searchCount = 0;

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{ 
		
		$inData = getRequestInfo();

	   // user to provide data to update
		$FirstName = $inData["FirstName"];
		$LastName = $inData["LastName"];
		$PhoneNumber = $inData["PhoneNumber"];
		$Email = $inData["Email"];
		
		$stmt = $conn->prepare("UPDATE Contacts SET FirstName = 'FirstName', LastName = 'LastName', PhoneNumber = 'PhoneNumber', Email = 'Email' WHERE UserID=?");
		
		if(!$FirstName || !$LastName || !$PhoneNumber || !$Email)
			echo "Sorry, all fields are required."
	
		else
			$stmt->execute();
			echo "Contact updated!"
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
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
