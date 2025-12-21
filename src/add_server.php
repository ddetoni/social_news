<?php
	require "dbconnect.php";
	session_start();

	$urlServer = isset($_POST['serverUrl']) ? $_POST['serverUrl'] : '';
	$nameServer = isset($_POST['serverName']) ? $_POST['serverName'] : '';

	if ($urlServer !== '' && $nameServer !== '') {
		db_query(
			"INSERT INTO servers (urlServer, nameServer) VALUES (?, ?)",
			array($urlServer, $nameServer)
		);
	}

	header('Location: index.php');
	exit;
?>
