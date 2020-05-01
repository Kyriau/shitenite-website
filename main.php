<?php
	
	session_start();
	
	if(!isset($_SESSION['userid'])) {
		//header("Location: login.php");
		die();
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
			<h2>Under Construction</h2>
		</div>
	</body>
</html>