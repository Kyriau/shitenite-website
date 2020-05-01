<?php

	session_start();
	
	if(isset($_SESSION['userid'])) {
		header("Location: main.php");
		die();
	}

	if(isset($_GET['registered'])) {
		
		if($_GET['registered'] == 1) {
			$regSuccess = true;
		}
		
	}
	
	if(isset($_POST['password']) && isset($_POST['username'])) {
		
		if(login_user()) {
			header("Location: main.php");
			die();
		}
		
	}
	
	function login_user() {
		
		global $loginError;
		
		// Extract POST data
		$username = strtolower($_POST['username']);
		$password = $_POST['password'];
		
		// Validate input
		if(strlen($username) > 32 || strlen($username) <= 0) {
			$loginError = "Invalid username length";
			return false;
		}
		if(preg_match("^[0-9a-zA-Z]+$", $username) == 1) {
			$loginError = "Username contains invalid character";
			return false;
		}
		
		// Setup database connection
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'votingsite';
		$db = new mysqli('localhost', $dbuser, $dbpass, $dbname);
		
		// Query database
		$userSelect = $db->prepare("SELECT * FROM SiteUser WHERE username = ? LIMIT 1;");
		$userSelect->bind_param("s", $username);
		$userSelect->execute();
		$userResult = $userSelect->get_result();
		
		// Check that user was found
		if($userResult->num_rows == 0) {
			$loginError = "Authentication failed";
			$db->close();
			return false;
		}
		
		// Check that password matches
		$siteuser = $userResult->fetch_object();
		if(!password_verify($password, $siteuser->password)) {
			$loginError = "Authentication failed";
			$db->close();
			return false;
		}
		
		$_SESSION['userid'] = $siteuser->id;
		
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
			<form action="login.php" method="POST">
				<input type="text" name="username" placeholder="Username" required>
				<input type="password" name="password" placeholder="Password" required>
				<button type="submit">Login</button>
			</form>
			<a href="register.php" class="button">I would like to register</a>
		</div>
		<?php
			if(isset($regSuccess)) {
				echo "<div class=\"center-container\">";
				echo "<h2>Registration successful</h2>";
				echo "</div>";
			}
			if(isset($loginError)) {
				echo "<div class=\"center-container\">";
				echo "<h2 class=\"error\">$loginError</h2>";
				echo "</div>";
			}
		?>
	</body>
</html>