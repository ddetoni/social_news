<?php
	include 'dbconnect.php';
	
	$query = "UPDATE News SET title='$_POST[title]', text='$_POST[text]', tags='$_POST[tags]' WHERE idNews='$_GET[idNew]'";
	$res = mysql_query($query) or die(mysql_error());
	
	header("Location: news.php?idNew=$_GET[idNew]");
?>