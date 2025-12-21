<?php
	include 'dbconnect.php';
	session_start();
	
	$title = $_POST['title'];
	$text = $_POST['text'];
	$tags = $_POST['tags'];
	$date = date('Y').'-'.date('m').'-'.date('d').' '.date('h').':'.date('m').':'.date('s');
	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	
	$query = "INSERT INTO `news` (`title`, `text`, `tags`, `date`, `Users_idUsers`) VALUES ('$title', '$text', '$tags', '$date','$idUser')";
	
	mysql_query($query) or die ("Unable to insert news.");
	$idNew = mysql_insert_id();
	$url = "news.php?idNew=$idNew";
	$query = "UPDATE `news` SET `url`='$url' WHERE `idNews`='$idNew'";
	mysql_query($query);
	
	header ("Location: $url");
		
?>
