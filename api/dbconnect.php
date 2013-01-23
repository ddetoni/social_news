<?php

	$hostname = 'localhost';
	$user = 'root';
	$pass = 'tarifa185';
	$dbase = 'social_news';
	
	$db = mysql_connect($hostname,$user,$pass);

	mysql_select_db($dbase);
	
?>
