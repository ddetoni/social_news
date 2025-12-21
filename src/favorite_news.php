<?php
	require "dbconnect.php";
	session_start();

	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	if ($idUser === 0) {
		echo "No favorites.";
		exit;
	}

	$query = "SELECT idFavorites, urlNew, titleNew FROM favorites WHERE Users_idUsers=$idUser ORDER BY idFavorites DESC";
	$data = mysql_query($query);

	while ($data && ($favorite = mysql_fetch_array($data))) {
		$url = $favorite['urlNew'] ?? '';
		$title = $favorite['titleNew'] ?? '';
		echo "<div id='list_favorites'> 
				<a id='favorite' href='$url'><h4>$title</h4></a><br>
			</div> ";
	}

 ?>
