<?php
	
	include "site-init.php";
	
	$movies = queryAllMovies();
	$votes = ceil(count($movies) / 3);
	
	function echoMovieInfo($movie) {
		
		$name = $movie['name'];
		$imgSrc = $movie['imgSrc'];
		$imdbHref = $movie['imdbHref'];
		$description = $movie['description'];
		
		echo "<a href=\"$imdbHref\" target=\"_blank\">";
		echo "<h2>$name</h2>";
		echo "</a>";
		echo "<a href=\"$imdbHref\" target=\"_blank\">";
		echo "<img src=\"$imgSrc\" class=\"movie-poster\">";
		echo "</a>";
		echo "<h3>$description</h3>";
		
	}
	
	function echoVoteButton($movie) {
		
		$id = $movie['id'];
		echo "<button id=\"vote-button-$id\" onclick=\"vote($id)\">Use Vote</button>";
		
	}
	
	function echoAllMovies() {
		
		global $movies;
		
		foreach($movies as $movie) {
			echo "<div class=\"center-container\">";
			echoMovieInfo($movie);
			echoVoteButton($movie);
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
	
		<script>
		
			maxVotes = 2;
			votesUsed = 0;
			
			function vote(id) {
				if(votesUsed < maxVotes) {
					votesUsed++;
					var button = document.getElementById("vote-button-" + id);
					button.classList.add("has-vote");
					button.innerHTML = "Take Back";
					button.setAttribute("onClick", "unvote(" + id + ")");
					document.getElementById("vote-" + id).value = "1";
				}
			}
			
			function unvote(id) {
				if(votesUsed > 0) {
					votesUsed--;
					var button = document.getElementById("vote-button-" + id);
					button.classList.remove("has-vote");
					button.innerHTML = "Use Vote";
					button.setAttribute("onClick", "vote(" + id + ")");
					document.getElementById("vote-" + id).value = "0";
				}
			}
			
			function submitVotes() {
				
			}
			
		</script>
		
	</head>
	<body>
		<div class="main-content">
			<?php include "site-header.php"; ?>
			<div class="center-container-wide">
				<h3>For this round of voting, you have 2 votes.</h3>
			</div>
			<!--
			<div class="center-container">
				<h2>The Room</h2>
				<div class="movie-info">
					<img src="img/theroom.jpg" class="movie-poster">
				</div>
				<button id="vote-button-1" onclick="vote(1)">Use Vote</button>
			</div>
			<div class="center-container">
				<a href="https://www.imdb.com/title/tt2034800/" target="_blank">
					<h2>The Great Wall</h2>
				</a>
				<a href="https://www.imdb.com/title/tt2034800/" target="_blank">
					<img src="img/thegreatwall.jpg" class="movie-poster">
				</a>
				<h3>In ancient China, a group of European mercenaries encounters a secret army that maintains and defends the Great Wall of China against a horde of monstrous creatures.</h3>
				<button id="vote-button-2" onclick="vote(2)">Use Vote</button>
			</div>
			<div class="center-container">
				<h2>Starship Troopers</h2>
				<div class="movie-info">
					<img src="img/starshiptroopers.jpg" class="movie-poster">
				</div>
				<button id="vote-button-3" onclick="vote(3)">Use Vote</button>
			</div>
			-->
			<?php echoAllMovies(); ?>
			<form method="POST" action="applyvotes.php" class="hidden">
				<input type="hidden" id="vote-1" value="0">
				<input type="hidden" id="vote-2" value="0">
				<input type="hidden" id="vote-3" value="0">
			</form>
		</div>
	</body>
</html>