<?php
	
	// Database variables
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'votingsite';
	
	function querySiteUserByID($id) {
		
		global $dbUser, $dbPass, $dbName, $dbError;
		
		// Create database connection
		$conn = new mysqli('localhost', $dbUser, $dbPass, $dbName);
		
		// Query database
		$userSelect = $conn->prepare("SELECT * FROM SiteUser WHERE id = ? LIMIT 1;");
		$userSelect->bind_param("s", $id);
		$userSelect->execute();
		$userResult = $userSelect->get_result();
		
		// Close connection
		$conn->close();
		
		// Check that user was found
		if($userResult->num_rows == 0) {
			$dbError = "SiteUser not found: id=$id";
			return false;
		}
		
		return $userResult->fetch_object();
		
	}
	
	function querySiteUserByUsername($username) {
		
		global $dbUser, $dbPass, $dbName, $dbError;
		
		// Create database connection
		$conn = new mysqli('localhost', $dbUser, $dbPass, $dbName);
		
		// Query database
		$userSelect = $conn->prepare("SELECT * FROM SiteUser WHERE username = ? LIMIT 1;");
		$userSelect->bind_param("s", $username);
		$userSelect->execute();
		$userResult = $userSelect->get_result();
		
		// Close connection
		$conn->close();
		
		// Check that user was found
		if($userResult->num_rows == 0) {
			$dbError = "SiteUser not found: username=$username";
			return false;
		}
		
		return $userResult->fetch_object();
		
	}
	
?>