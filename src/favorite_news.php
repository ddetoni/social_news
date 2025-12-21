<?php
	require "dbconnect.php";
	session_start();

	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	if ($idUser === 0) {
		echo "No favorites.";
		exit;
	}

	$stmt = db_query(
		"SELECT idFavorites, urlNew, titleNew FROM favorites WHERE Users_idUsers=? ORDER BY idFavorites DESC",
		array($idUser)
	);
	$favorites = db_fetch_all($stmt);

	foreach ($favorites as $favorite) {
		$url = $favorite['urlNew'] ?? '';
		$title = $favorite['titleNew'] ?? '';
		echo "<div id='list_favorites'> 
				<a id='favorite' href='$url'><h4>$title</h4></a><br>
			</div> ";
	}

 ?>
