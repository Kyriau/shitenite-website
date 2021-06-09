<?php

	$imdbPage = file_get_contents("https://www.imdb.com/title/tt0338751/?ref_=tt_sims_tt");
	$start = strpos($imdbPage, "<div class=\"poster\">");
	$end = strpos($imdbPage, "</div>", $start);
	$info = substr($imdbPage, $start, $end - $start);
	echo $info;

?>