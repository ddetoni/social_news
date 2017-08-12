<?php
	include 'dbconnect.php';
	session_start();
	
	$idUser = $_SESSION[idUser];
	$idNew = $_SESSION[idNew];
	$comment = $_POST[comment];
	
	$sqlinsert = "INSERT INTO `Comments` (`comment`, `News_idNews`, `Users_idUsers`) VALUES ('$comment', '$idNew', '$idUser')";
	$res = mysql_query($sqlinsert) or die (mysql_error());
	
	if($res) echo 1;
	else echo 0;
?>