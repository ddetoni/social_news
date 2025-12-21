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

	$DB_CONN = mysqli_connect($hostname, $user, $pass, $dbase, $port, $socket);
	if (!$DB_CONN) {
		die("Database connection failed.");
	}

	function db_query($sql, $params = array())
	{
		global $DB_CONN;

		$stmt = mysqli_prepare($DB_CONN, $sql);
		if (!$stmt) {
			die("Database query failed.");
		}

		if (!empty($params)) {
			$types = '';
			$values = array();
			foreach ($params as $param) {
				if (is_int($param)) {
					$types .= 'i';
				} elseif (is_float($param)) {
					$types .= 'd';
				} else {
					$types .= 's';
				}
				$values[] = $param;
			}

			mysqli_stmt_bind_param($stmt, $types, ...$values);
		}

		if (!mysqli_stmt_execute($stmt)) {
			die("Database query failed.");
		}

		return $stmt;
	}

	function db_fetch_all($stmt)
	{
		$result = mysqli_stmt_get_result($stmt);
		if (!$result) {
			return array();
		}

		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
?>
