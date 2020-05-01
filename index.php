<?php 
	if(isset($_SESSION['userid'])) {
		header("Location: main.php");
		die();
	} else {
		header("Location: login.php");
		die();
	}
?>