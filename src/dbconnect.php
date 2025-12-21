<?php
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$hostname = $url["host"];
	$user = $url["user"];
	$pass = $url["pass"];
	$dbase = substr($url["path"], 1);

	$port = isset($url["port"]) ? $url["port"] : 3306;
	$socket = null;
	if ($hostname === "localhost") {
		$socket = "/run/mysqld/mysqld.sock";
	}

	$db = mysqli_connect($hostname, $user, $pass, $dbase, $port, $socket);
	if (!$db) {
		die("Database connection failed.");
	}

	if (!function_exists('mysql_query')) {
		function mysql_query($query, $link_identifier = null)
		{
			global $db;
			$link = $link_identifier ?: $db;
			return mysqli_query($link, $query);
		}
	}

	if (!function_exists('mysql_fetch_array')) {
		function mysql_fetch_array($result, $result_type = MYSQLI_BOTH)
		{
			return mysqli_fetch_array($result, $result_type);
		}
	}

	if (!function_exists('mysql_insert_id')) {
		function mysql_insert_id($link_identifier = null)
		{
			global $db;
			$link = $link_identifier ?: $db;
			return mysqli_insert_id($link);
		}
	}

	if (!function_exists('mysql_select_db')) {
		function mysql_select_db($dbname, $link_identifier = null)
		{
			global $db;
			$link = $link_identifier ?: $db;
			return mysqli_select_db($link, $dbname);
		}
	}

	if (!function_exists('mysql_connect')) {
		function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0)
		{
			global $db;
			if ($server === null) {
				return $db;
			}
			return mysqli_connect($server, $username, $password);
		}
	}

	if (!function_exists('mysql_error')) {
		function mysql_error($link_identifier = null)
		{
			global $db;
			$link = $link_identifier ?: $db;
			return mysqli_error($link);
		}
	}

?>
