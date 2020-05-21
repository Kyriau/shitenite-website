<?php

	include "site-init.php";
	
	// If we have an active session, skip to main page
	if(isset($_SESSION['userID'])) {
		header("Location: main.php");
		die();
	}

	if(isset($_GET['registered'])) {
		
		if($_GET['registered'] == 1) {
			$regSuccess = true;
		}
		
	}
	
	if(isset($_POST['password']) && isset($_POST['username'])) {
		
		if(loginUser()) {
			header("Location: main.php");
			die();
		}
		
	}
	
	function loginUser() {
		
		global $loginError;
		
		// Extract POST data
		$username = strtolower($_POST['username']);
		$password = $_POST['password'];
		
		// Validate input
		if(strlen($username) > 32 || strlen($username) <= 0) {
			$loginError = "Invalid username length";
			return false;
		}
		if(preg_match("/^([0-9a-zA-Z]+)$/", $username) != 1) {
			$loginError = "Username contains invalid character";
			return false;
		}
		
		$siteUser = querySiteUserByUsername($username);
		
		// Check that user was found
		if($siteUser === false) {
			$loginError = "Authentication failed";
			return false;
		}
		
		// Check that password matches
		if(!password_verify($password, $siteUser->password)) {
			$loginError = "Authentication failed";
			return false;
		}
		
		// Setup session
		$_SESSION['userID'] = $siteUser->id;
		$_SESSION['username'] = $_POST['username'];
		
		return true;
		
	}
	
?>

<!DOCTYPE html>
<html lang=en>
	<head>
		<title>Shite Nite</title>
		<link rel="icon" href="img/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="main-content">
			<?php include "site-header.php"; ?>
			<div class="center-container-wide">
				<h2>Login</h2>
				<form action="login.php" method="POST">
					<input type="text" name="username" placeholder="Username" required>
					<input type="password" name="password" placeholder="Password" required>
					<button type="submit">Login</button>
				</form>
				<a href="register.php" class="anchor-button">I would like to register</a>
			</div>
			<?php
				if(isset($regSuccess)) {
					echo "<div class=\"center-container-wide\">";
					echo "<h3>Registration successful</h3>";
					echo "</div>";
				}
				if(isset($loginError)) {
					echo "<div class=\"center-container-wide\">";
					echo "<h3 class=\"error\">$loginError</h3>";
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>