<?php
	include 'dbconnect.php';
	
	$nameServer = $_POST[serverName];
	$urlServer = $_POST[serverUrl];
	
	$sqlinsert = "INSERT INTO `Servers` (`urlServer`, `nameServer`) VALUES ('$urlServer', '$nameServer')";
	$res = mysql_query($sqlinsert) or die(mysql_error());
	
	header('Location: index.php');
	
?>