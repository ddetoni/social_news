<?php
	include 'dbconnect.php';
	
	$query = "DELETE FROM Comments WHERE News_idNews = '$_GET[idNew]'";
	$res = mysql_query($query) or die(mysql_error());
	
	$query = "DELETE FROM News WHERE idNews = '$_GET[idNew]'";
	$res = mysql_query($query) or die(mysql_error());

?>