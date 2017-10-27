<?php
	require "../vendor/autoload.php";
	session_start();

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$idUser = $_SESSION[idUser];
	$response = $resty->get("favorites", "filter[where][Users_idUsers]=$idUser&filter[order]=idFavorites%20DESC");

	foreach ($response['body'] as $favorite) {
		echo "<div id='list_favorites'> 
				<a id='favorite' href='$favorite->urlNew'><h4>$favorite->titleNew</h4></a><br>
			</div> ";
	}

 ?>