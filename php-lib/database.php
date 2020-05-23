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
	
	function queryAllMovies() {
		
		global $dbUser, $dbPass, $dbName, $dbError;
		
		// Create database connection
		$conn = new mysqli('localhost', $dbUser, $dbPass, $dbName);
		
		$movieSelect = $conn->prepare("SELECT * FROM Movie ORDER BY name;");
		$movieSelect->execute();
		$movieResult = $movieSelect->get_result();
		
		// Close connection
		$conn->close();
		
		return $movieResult->fetch_all(MYSQLI_ASSOC);
		
	}
	
	function queryMoviesByVoteRound($voteRoundID) {
		
		global $dbUser, $dbPass, $dbName, $dbError;
		
		// Create database connection
		$conn = new mysqli('localhost', $dbUser, $dbPass, $dbName);
		
		// Query database
		$movieSelect = $conn->prepare("SELECT Movie.* FROM Movie JOIN VoteOption ON Movie.id = VoteOption.movieID WHERE voteRoundID = ? ORDER BY Movie.name");
		$movieSelect->bind_param("s", $voteRoundID);
		$movieSelect->execute();
		$movieResult = $movieSelect->get_result();
		
		// Close connection
		$conn->close();
		
		return $movieResult->fetch_all(MYSQLI_ASSOC);
		
	}
	
	function registerSiteUser($username, $passhash, $regKey) {
		
		global $dbUser, $dbPass, $dbName, $dbError, $regError;
		
		// Create database connection
		$conn = new mysqli('localhost', $dbUser, $dbPass, $dbName);
		
		// Prepare statements
		$userSelect = $conn->prepare("SELECT id FROM SiteUser WHERE username = ? LIMIT 1;");
		$regKeySelect = $conn->prepare("SELECT used FROM RegistrationKey WHERE regKey = ? LIMIT 1;");
		$regKeyUpdate = $conn->prepare("UPDATE RegistrationKey SET used = TRUE WHERE regKey = ?;");
		$userInsert = $conn->prepare("INSERT INTO SiteUser(username, password) VALUE (?, ?);");
		
		// Check if user already exists
		$userSelect->bind_param("s", $username);
		$userSelect->execute();
		$userResult = $userSelect->get_result();
		if($userResult->num_rows > 0) {
			$regError = "User already exists";
			$conn->close();
			return false;
		}
		
		// Check if registration key is used
		$regKeySelect->bind_param("s", $regKey);
		$regKeySelect->execute();
		$regKeyResult = $regKeySelect->get_result();
		if($regKeyResult->num_rows == 0) {
			$regError = "Unknown registration key";
			$conn->close();
			return false;
		} else {
			$regRow = $regKeyResult->fetch_object();
			if($regRow->used == 1) {
				$regError = "Registration key already used";
				$conn->close();
				return false;
			}
		}
		
		// Create new user
		$regKeyUpdate->bind_param("s", $regKey);
		$regKeyUpdate->execute();
		$userInsert->bind_param("ss", $username, $passhash);
		$userInsert->execute();
		
		// Close connection
		$conn->close();
		
		return true;
		
	}
	
?>