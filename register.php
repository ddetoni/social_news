<?php
	include 'dbconnect.php';
	
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$name = $_POST['name'];
	$lastName = $_POST['lastName'];
	$birth = $_POST['years'].'-'.$_POST['months'].'-'.$_POST['days'];
	$email = $_POST['email'];
	
	$sqlinsert = "INSERT INTO `Users` (`username`, `password`, `name`, `lastName`, `birth`, `email`, `permitionLevel`) VALUES ('".$username."', '".$password."', '".$name."', '".$lastName."','".$birth."', '".$email."','1')";
	echo $sqlinsert;
	mysql_query($sqlinsert) or die (mysql_error());
	
	header ("Location: index.php");
?>
