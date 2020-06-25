<?php
	
	include "site-init.php";
	
	if(!isset($_SESSION['userID'])) {
		header("Location: login.php");
		die();
	}
	
	$movies = queryAllMovies();
	
	function echoMovieInfo($movie) {
		
		$name = $movie['name'];
		$imgSrc = $movie['imgSrc'];
		$description = $movie['description'];
		
		echo "<h2>$name</h2>";
		echo "<img src=\"$imgSrc\" class=\"movie-poster\">";
		echo "<h3>$description</h3>";
		
	}
	
	function echoAllMovies() {
		
		global $movies;
		
		foreach($movies as $movie) {
			echo "<div class=\"center-container\">";
			echoMovieInfo($movie);
			echo "</div>";
		}
		
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
				<h2>Movie Nomination</h2>
				<h3>Your Current Nomination: None</h3>
				<form action="nominate.php" method="POST">
					<input type="text" name="imdbUrl" placeholder="IMDB URL" class="wide-text">
					<button type="submit">Nominate</button>
				</form>
			</div>
			<div class="center-container-wide">
				<h2>Current Nominations</h2>
			</div>
			<?php echoAllMovies(); ?>
		</div>
	</body>
</html>