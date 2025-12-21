<?php
	if (!function_exists('db_query')) {
		require __DIR__ . '/app/bootstrap.php';
	}

	$stmt = db_query("SELECT title, url, date FROM news ORDER BY date DESC LIMIT 10");
	$news = db_fetch_all($stmt);

	foreach ($news as $new) {
		$title = $new['title'] ?? '';
		$url = $new['url'] ?? '';
		$date = $new['date'] ?? '';

		echo "<div id='lastNews'> 
				<a id='new1_link' href='$url'><h4>$title</h4></a> ($date)<br>
			</div> ";
	}
?>
