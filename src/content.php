<?php
	if (!function_exists('db_query')) {
		require __DIR__ . '/app/bootstrap.php';
	}

	$stmt = db_query("SELECT title, text, url FROM news ORDER BY date DESC LIMIT 4");
	$news = db_fetch_all($stmt);

	$size_intro = 400;

	if (count($news) > 0) {
		for ($i = 0; $i < 4; $i++) {
			if (!isset($news[$i])) {
				continue;
			}

			$item = $news[$i];
			$title = $item['title'] ?? '';
			$text = $item['text'] ?? '';
			$url = $item['url'] ?? '';
			$slot = $i + 1;

			echo "
			<div id='new$slot'> 
				<h3>$title</h3><br>
				".substr($text, 0, $size_intro)."... <a href='$url'>Read more.</a><br><br>
			</div> ";
		}
	} else {
		echo "No news.";
	}
?>
