<?php

	include "site-init.php";
	
	if(isset($_SESSION['userID'])) {
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
		$regKey = $_POST['regkey'];
		
		// Validate input
		if(strlen($username) > 32 || strlen($username) <= 0) {
			$regError = "Invalid username length";
			return false;
		}
		if(preg_match("/^([0-9a-zA-Z]+)$/", $username) != 1) {
			$regError = "Username contains invalid character";
			return false;
		}
		
		return registerSiteUser($username, $passhash, $regKey);
		
	}
	
?>

<!DOCTYPE html>
<html lang=en>
	<head>
		<title>Shite Nite</title>
		<link rel="icon" href="img/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	<body>
		<?php include "site-header.php"; ?>
		<div class="center-container-wide">
			<h2>Registration</h2>
			<h3>You'll need a registration key from Jeff</h3>
			<form action="register.php" method="POST">
				<input type="text" name="username" placeholder="Username" pattern="^[0-9a-zA-Z]+$" maxlength="32" required>
				<input type="password" name="password" placeholder="Password" required>
				<input type="text" name="regkey" placeholder="Registration Key" required>
				<button type="submit">Register</button>
			</form>
		</div>
		<?php
			if(isset($regError)) {
				echo "<div class=\"center-container-wide\">";
				echo "<h3 class=\"error\">$regError</h3>";
				echo "</div>";
			}
		?>
	</body>
</html>