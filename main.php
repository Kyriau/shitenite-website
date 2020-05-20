<?php
	
	include "site-init.php";
	
	if(!isset($_SESSION['userID'])) {
		header("Location: login.php");
		die();
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
		<?php include "site-header.php" ?>
		<div class="center-container">
			<h2>Under Construction</h2>
		</div>
	</body>
</html>