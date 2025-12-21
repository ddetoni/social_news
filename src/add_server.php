<?php
	require "dbconnect.php";
	session_start();

	$urlServer = isset($_POST['serverUrl']) ? $_POST['serverUrl'] : '';
	$nameServer = isset($_POST['serverName']) ? $_POST['serverName'] : '';

	if ($urlServer !== '' && $nameServer !== '') {
		$query = "INSERT INTO servers (urlServer, nameServer) VALUES ('$urlServer', '$nameServer')";
		mysql_query($query) or die(mysql_error());
	}

	header('Location: index.php');
	exit;
?>
