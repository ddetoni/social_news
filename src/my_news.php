<?php
	require "../vendor/autoload.php";
	session_start();
	
	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$idUser = $_SESSION[idUser];
	$response = $resty->get("news", "filter[where][Users_idUsers]=$idUser&filter[order]=date%20DESC");

	foreach($response['body'] as $new) {
		echo "<div id='my_new'> 
				<a id='new' href='$new->url'><h4>$new->title</h4></a>
				<a id='edit_new' href='#' onclick='editNew($new->idNews)'>Edit</a> <br>
				<a id='edit_new' href='#' onclick='removeNew($new->idNews)'>Remove</a>
				<br>
			</div> ";
	}
?>