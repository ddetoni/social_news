<?php
	include 'dbconnect.php';
	session_start();
	
	$title = $_POST['title'];
	$text = $_POST['text'];
	$tags = $_POST['tags'];
	$date = date('Y').'-'.date('m').'-'.date('d').' '.date('h').':'.date('m').':'.date('s');
	$idUser = $_SESSION[idUser];
	
	$query = "INSERT INTO `News` (`title`, `text`, `tags`, `date`, `Users_idUsers`) VALUES ('$title', '$text', '$tags', '$date','$idUser')";
	
	mysql_query($query) or die ("Não foi possível inserir");
	$idNew = mysql_insert_id();
	$url = "news.php?idNew=$idNew";
	$query = "UPDATE `News` SET `url`='$url' WHERE `idNews`='$idNew'";
	mysql_query($query);
	
	header ("Location: $url");
		
?>