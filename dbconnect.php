<?php

	$hostname = 'us-cdbr-iron-east-03.cleardb.net';
	$user = 'b3c1054bc0b5c8';
	$pass = 'd7a39280';
	$dbase = 'heroku_93a35212af060ff';

	$db = mysql_connect($hostname,$user,$pass);

	mysql_select_db($dbase);

?>
