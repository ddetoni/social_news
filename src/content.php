<div id=content>
	<?php
		require "../vendor/autoload.php";
	
		use Resty\Resty;
	
		$resty = new Resty();
		$resty->setBaseURL(getenv('API_BASE_URL'));

		$response = $resty->get("news_api.php", "filter[order]=date%20DESC&filter[limit]=4");
		$news = isset($response['body']) && is_array($response['body']) ? $response['body'] : [];

		$size_intro = 400;

		if (count($news) > 0) {
			for ($i = 0; $i < 4; $i++) {
				if (!isset($news[$i])) {
					continue;
				}

				$item = $news[$i];
				$title = is_object($item) ? ($item->title ?? '') : ($item['title'] ?? '');
				$text = is_object($item) ? ($item->text ?? '') : ($item['text'] ?? '');
				$url = is_object($item) ? ($item->url ?? '') : ($item['url'] ?? '');
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
</div>
