<?php 

	include "site-init.php";

	if(isset($_SESSION['userID'])) {
		header("Location: main.php");
		die();
	} else {
		header("Location: login.php");
		die();
	}
	
?>