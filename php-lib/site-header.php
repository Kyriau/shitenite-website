<?php
	
	echo "<div class=\"site-header\">";
	echo "<h1>Shite Nite Voting</h1>";
	
	if(isset($_SESSION['userID'])) {
		echo "<h3>Logged in as ";
		echo $_SESSION['username'];
		echo "</h3>";
		echo "<a class=\"anchor-button\" href=\"logout.php\">Logout</a>";
	}
	
	echo "</div>";
	
?>