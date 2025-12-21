<?php
	require "../vendor/autoload.php";

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$response = $resty->get("news_api.php", "filter[order]=date%20DESC&filter[limit]=10");
	$news = isset($response['body']) && is_array($response['body']) ? $response['body'] : [];

	foreach ($news as $new) {
		$title = is_object($new) ? ($new->title ?? '') : ($new['title'] ?? '');
		$url = is_object($new) ? ($new->url ?? '') : ($new['url'] ?? '');
		$date = is_object($new) ? ($new->date ?? '') : ($new['date'] ?? '');

		echo "<div id='lastNews'> 
				<a id='new1_link' href='$url'><h4>$title</h4></a> ($date)<br>
			</div> ";
	}
?>
