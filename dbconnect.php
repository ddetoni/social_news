<?php
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$hostname = $url["host"];
	$user = $url["user"];
	$pass = $url["pass"];
	$dbase = substr($url["path"], 1);

	$db = mysql_connect($hostname,$user,$pass);

	mysql_select_db($dbase);

?>
