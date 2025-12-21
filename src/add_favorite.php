<?php
	session_start();
	include 'dbconnect.php';
	
	$url = isset($_POST['url']) ? $_POST['url'] : '';
	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	$idNew = isset($_SESSION['idNew']) ? (int)$_SESSION['idNew'] : 0;

	if ($idUser === 0 || $idNew === 0 || $url === '') {
		echo 0;
		exit;
	}

	$stmt = db_query("SELECT title FROM news WHERE idNews=?", array($idNew));
	$titleNew = db_fetch_one($stmt);
	$title = $titleNew ? $titleNew['title'] : '';
	if ($title === '') {
		echo 0;
		exit;
	}

	$stmt = db_query(
		"SELECT idFavorites, titleNew FROM favorites WHERE titleNew=? AND Users_idUsers=?",
		array($title, $idUser)
	);
	$exists = db_fetch_one($stmt);
	
	if(!$exists || $exists['titleNew'] != $title){
		db_query(
			"INSERT INTO favorites (urlNew, Users_idUsers, titleNew) VALUES (?, ?, ?)",
			array($url, $idUser, $title)
		);
		echo 1;
	} else {
		echo 0;
	}

	
?>
