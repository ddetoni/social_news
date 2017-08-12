<?php
	session_start();
	include 'dbconnect.php';
	
	$url = $_POST[url];
	$idUser = $_SESSION[idUser];
	
	$data = mysql_query("SELECT title FROM News WHERE idNews=$_SESSION[idNew]");
	$titleNew = mysql_fetch_array($data);
	
	$data = mysql_query("SELECT * FROM Favorites WHERE titleNew='$titleNew[title]' AND Users_idUsers='$idUser'");
	$exists = mysql_fetch_array($data);
	
	if($exists[titleNew]!=$titleNew[title]){
		
		$sqlinsert = "INSERT INTO `Favorites` (`urlNew`, `Users_idUsers`, `titleNew`) VALUES ('$url', '$idUser', '$titleNew[title]')";
		$res = mysql_query($sqlinsert) or die (mysql_error());
		echo true;
	} else {
		echo false;
	}

	
?>