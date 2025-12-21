<?php
	include 'dbconnect.php';
	session_start();
	
	$title = $_POST['title'];
	$text = $_POST['text'];
	$tags = $_POST['tags'];
	$date = date('Y').'-'.date('m').'-'.date('d').' '.date('h').':'.date('m').':'.date('s');
	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	
	$stmt = db_query(
		"INSERT INTO news (title, text, tags, date, Users_idUsers) VALUES (?, ?, ?, ?, ?)",
		array($title, $text, $tags, $date, $idUser)
	);
	$idNew = db_insert_id();
	$url = "news.php?idNew=$idNew";
	db_query("UPDATE news SET url=? WHERE idNews=?", array($url, $idNew));
	
	header ("Location: $url");
		
?>
