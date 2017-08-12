<?php
	include 'dbconnect.php';
	
	$query = "DELETE FROM Comments WHERE idComments = $_GET[idComment]";
	$res = mysql_query($query);
	
	header("Location:news.php?idNew=$_GET[idNew]");

?>