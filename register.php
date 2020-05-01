<?php

	session_start();
	
	if(isset($_SESSION['userid'])) {
		header("Location: main.php");
		die();
	}
	
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['regkey'])) {
		
		if(register_user()) {
			header("Location: login.php?registered=1");
			die();
		}
		
	}
	
	function register_user() {
		
		global $regError;
		
		// Extract POST data
		$username = strtolower($_POST['username']);
		$password = $_POST['password'];
		$passhash = password_hash($password, PASSWORD_DEFAULT);
		$regkey = $_POST['regkey'];
		
		// Validate input
		if(strlen($username) > 32 || strlen($username) <= 0) {
			$regError = "Invalid username length";
			return false;
		}
		if(preg_match("/^([0-9a-zA-Z]+)$/", $username) != 1) {
			$regError = "Username contains invalid character";
			return false;
		}
		
		// Setup database connection
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'votingsite';
		$db = new mysqli('localhost', $dbuser, $dbpass, $dbname);
		
		// Prepare statements
		$userSelect = $db->prepare("SELECT id FROM SiteUser WHERE username = ? LIMIT 1;");
		$regkeySelect = $db->prepare("SELECT used FROM RegistrationKey WHERE regKey = ? LIMIT 1;");
		$regkeyUpdate = $db->prepare("UPDATE RegistrationKey SET used = TRUE WHERE regKey = ?;");
		$userInsert = $db->prepare("INSERT INTO SiteUser(username, password) VALUE (?, ?);");
		
		// Check if user already exists
		$userSelect->bind_param("s", $username);
		$userSelect->execute();
		$userResult = $userSelect->get_result();
		if($userResult->num_rows > 0) {
			$regError = "User already exists";
			$db->close();
			return false;
		}
		
		// Check if registration key is used
		$regkeySelect->bind_param("s", $regkey);
		$regkeySelect->execute();
		$regkeyResult = $regkeySelect->get_result();
		if($regkeyResult->num_rows == 0) {
			$regError = "Unknown registration key";
			$db->close();
			return false;
		} else {
			$row = $regkeyResult->fetch_row();
			if($row[0] == 1) {
				$regError = "Registration key already used";
				$db->close();
				return false;
			}
		}
		
		// Create new user
		$regkeyUpdate->bind_param("s", $regkey);
		$regkeyUpdate->execute();
		$userInsert->bind_param("ss", $username, $passhash);
		$userInsert->execute();
		
		// Close database
		$db->close();
		
		return true;
		
	}
	
?>

<!DOCTYPE html>
<html lang=en>
	<head>
		<title>Shite Nite</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	<body>
		<div class="center-container">
			<h1>Shite Nite Voting</h1>
			<h2>You'll need a registration key from Jeff</h2>
			<form action="register.php" method="POST">
				<input type="text" name="username" placeholder="Username" pattern="^[0-9a-zA-Z]+$" maxlength="32" required>
				<input type="password" name="password" placeholder="Password" required>
				<input type="text" name="regkey" placeholder="Registration Key" required>
				<button type="submit">Register</button>
			</form>
		</div>
		<?php
			if(isset($regError)) {
				echo "<div class=\"center-container\">";
				echo "<h2 class=\"error\">$regError</h2>";
				echo "</div>";
			}
		?>
	</body>
</html>