<?php
	if (!function_exists('db_query')) {
		require __DIR__ . '/app/bootstrap.php';
	}

	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	$news = array();
	if ($idUser > 0) {
		$stmt = db_query(
			"SELECT idNews, title, url FROM news WHERE Users_idUsers=? ORDER BY date DESC",
			array($idUser)
		);
		$news = db_fetch_all($stmt);
	}

	foreach($news as $new) {
		$idNews = isset($new['idNews']) ? $new['idNews'] : 0;
		$title = isset($new['title']) ? $new['title'] : '';
		$url = isset($new['url']) ? $new['url'] : '';
		echo "<div id='my_new'> 
				<a id='new' href='$url'><h4>$title</h4></a>
				<a id='edit_new' href='#' onclick='editNew($idNews)'>Edit</a> <br>
				<a id='edit_new' href='#' onclick='removeNew($idNews)'>Remove</a>
				<br>
			</div> ";
	}
?>
