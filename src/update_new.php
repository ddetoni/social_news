<?php
	include 'dbconnect.php';
	
	$title = isset($_POST['title']) ? $_POST['title'] : '';
	$text = isset($_POST['text']) ? $_POST['text'] : '';
	$tags = isset($_POST['tags']) ? $_POST['tags'] : '';
	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	db_query(
		"UPDATE news SET title=?, text=?, tags=? WHERE idNews=?",
		array($title, $text, $tags, $idNew)
	);
	
	header("Location: news.php?idNew=$idNew");
?>
