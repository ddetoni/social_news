<?php
	require "../vendor/autoload.php";
	session_start();
	
	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	$response = $idUser ? $resty->get("news_api.php", "filter[where][Users_idUsers]=$idUser&filter[order]=date%20DESC") : array();
	$news = (isset($response['body']) && is_array($response['body'])) ? $response['body'] : array();

	foreach($news as $new) {
		$idNews = is_object($new) ? ($new->idNews ?? 0) : (isset($new['idNews']) ? $new['idNews'] : 0);
		$title = is_object($new) ? ($new->title ?? '') : (isset($new['title']) ? $new['title'] : '');
		$url = is_object($new) ? ($new->url ?? '') : (isset($new['url']) ? $new['url'] : '');
		echo "<div id='my_new'> 
				<a id='new' href='$url'><h4>$title</h4></a>
				<a id='edit_new' href='#' onclick='editNew($idNews)'>Edit</a> <br>
				<a id='edit_new' href='#' onclick='removeNew($idNews)'>Remove</a>
				<br>
			</div> ";
	}
?>
