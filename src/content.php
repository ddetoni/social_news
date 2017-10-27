<div id=content>
	<?php
		require "../vendor/autoload.php";
	
		use Resty\Resty;
	
		$resty = new Resty();
		$resty->setBaseURL(getenv('API_BASE_URL'));

		$response = $resty->get("news", "filter[order]=date%20DESC&filter[limit]=4");
		
		$new1= $response['body'][0];
		$new2= $response['body'][1];
		$new3= $response['body'][2];
		$new4= $response['body'][3];
		
		$size_intro = 400;
		
		if($response['body'] != null){
			echo "
			<div id='new1'> 
				<h3>$new1->title</h3><br>
				".substr($new1->text, 0, $size_intro)."... <a href='$new1->url'>Veja mais.</a><br><br>
			</div> ";
			
			echo "
			<div id='new2'> 
				<h3>$new2->title</h3><br>
				".substr($new2->text, 0, $size_intro)."... <a href='$new2->url'>Veja mais.</a><br><br>
			</div> ";
			
			echo "
			<div id='new3'> 
				<h3>$new3->title</h3><br>
				".substr($new3->text, 0, $size_intro)."... <a href='$new3->url'>Veja mais.</a><br><br>
			</div> ";
			
			echo "<div id='new4'> 
				<h3>$new4->title</h3><br>
				".substr($new4->text, 0, $size_intro)."... <a href='$new4->url'>Veja mais.</a><br><br>
			</div> ";
			} else {
				echo "No news.";
			}	
	?>
</div>
