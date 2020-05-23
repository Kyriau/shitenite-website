<?php
	
	include "site-init.php";
	
	$movies = queryAllMovies();
	$maxVotes = ceil(count($movies) / 3);
	
	function echoMovieInfo($movie) {
		
		$name = $movie['name'];
		$imgSrc = $movie['imgSrc'];
		$description = $movie['description'];
		
		echo "<h2>$name</h2>";
		echo "<img src=\"$imgSrc\" class=\"movie-poster\">";
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
		
			var maxVotes = <?php echo $maxVotes; ?>;
			var votesUsed = 0;
			
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
				<h3>For this round of voting, you have <?php echo $maxVotes; ?> votes.</h3>
			</div>
			<?php echoAllMovies(); ?>
			<form method="POST" action="applyvotes.php" class="hidden">
				<?php
					for($i = 0, $size = count($movies); $i < $size; $i++) {
						$movieID = $movies[$i]['id'];
						echo "<input type=\"hidden\" id=\"vote-$movieID\" value=\"0\">";
					}
				?>
			</form>
		</div>
	</body>
</html>