<?php

	// Every webpage should include site-init.php as the first thing
	// it does.

	include "database.php";

	session_start();
	
	/*
	if(isset($_SESSION['siteUserID'])) {
		
		$activeUser = querySiteUserByID($_SESSION['siteUserID']);
		
		if($activeUser === false) {
			// If we reach this code segment, there is a session for
			// a user that doesn't exist, so destroy the session and
			// redirect to the login page.
			session_destroy();
			header("Location: login.php");
			die();
		}
		
	}
	*/
	
?>