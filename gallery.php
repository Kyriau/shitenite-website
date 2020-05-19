<!DOCTYPE html>
<html lang=en>
	<head>
	
		<title>Shite Nite</title>
		<link rel="icon" href="img/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/voting.css">
	
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
		<div class="center-container">
			<h1>The Room</h1>
			<div class="movie-info">
				<img src="img/theroom.jpg">
			</div>
			<button id="vote-button-1" onclick="vote(1)">Use Vote</button>
		</div>
		<div class="center-container">
			<h1>The Great Wall</h1>
			<div class="movie-info">
				<img src="img/thegreatwall.jpg">
			</div>
			<button id="vote-button-2" onclick="vote(2)">Use Vote</button>
		</div>
		<div class="center-container">
			<h1>Starship Troopers</h1>
			<div class="movie-info">
				<img src="img/starshiptroopers.jpg">
			</div>
			<button id="vote-button-3" onclick="vote(3)">Use Vote</button>
		</div>
		<form method="POST" action="applyvotes.php" class="hidden">
			<input type="hidden" id="vote-1" value="0">
			<input type="hidden" id="vote-2" value="0">
			<input type="hidden" id="vote-3" value="0">
		</form>
	</body>
</html>