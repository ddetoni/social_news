<?php
	include 'dbconnect.php';
	
	$title = isset($_POST['title']) ? $_POST['title'] : '';
	$text = isset($_POST['text']) ? $_POST['text'] : '';
	$tags = isset($_POST['tags']) ? $_POST['tags'] : '';
	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	$query = "UPDATE news SET title='$title', text='$text', tags='$tags' WHERE idNews='$idNew'";
	$res = mysql_query($query) or die(mysql_error());
	
	header("Location: news.php?idNew=$idNew");
?>
