<?php
	require "../vendor/autoload.php";

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$response = $resty->get("news", "filter[order]=date%20DESC&filter[limit]=10");
	
	foreach($response['body'] as $new) {
		echo "<div id='lastNews'> 
				<a id='new1_link' href='$new->url'><h4>$new->title</h4></a> ($new->date)<br>
			</div> ";
	}
?>