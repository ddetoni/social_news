<?php
	ob_start();

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	include 'dbconnect.php';

	$sql = "SELECT * FROM Users WHERE username='".$username."'";
	$query = mysql_query($sql);
	$sql = mysql_fetch_array($query);

	if ($sql[password] == $password)
	{

		$validation = "1";

		$username = $_POST['username'];

		session_start();

		$_SESSION[username] = $username;
		$_SESSION[validation] = $validation;
		$_SESSION[permitionLevel] = $sql[permitionLevel];
		$_SESSION[idUser] = $sql[idUsers];

		header ("Location: index.php");
	}

	header ("Location: index.php");
?>
