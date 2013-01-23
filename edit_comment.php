<?php
	include 'dbconnect.php';
	
	$editComment = $_POST[comment];
	$idComment = $_POST[idComment];
	
	$query = "UPDATE Comments SET comment='$editComment' WHERE idComments='$idComment'";
	$res = mysql_query($query) or die(mysql_error());
	
	echo $res;
?>