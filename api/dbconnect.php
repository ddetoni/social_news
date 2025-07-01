<?php
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$hostname = $url["host"];
	$user = $url["user"];
	$pass = $url["pass"];
	$dbname = substr($url["path"], 1);

	// Create a new MySQLi instance
	$mysqli = new mysqli($hostname, $user, $pass, $dbname);

	// Check the connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	mysql_select_db($dbase);
?>
