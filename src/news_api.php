<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$hostname = $url["host"];
$port = isset($url["port"]) ? $url["port"] : 3306;
$socket = null;
if ($hostname === "localhost") {
	$socket = "/run/mysqld/mysqld.sock";
}
$user = $url["user"];
$pass = $url["pass"];
$dbase = substr($url["path"], 1);

$db = mysqli_connect($hostname, $user, $pass, $dbase, $port, $socket);
if (!$db) {
	http_response_code(500);
	echo json_encode(array('result' => 'error', 'reason' => 'Database connection failed.'));
	exit;
}

header('Content-Type: application/json');

$method = isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : 'GET';
$override = isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) ? strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) : '';
if ($override === 'PATCH') {
	$method = 'PATCH';
}

function escape_value($db, $value)
{
	return mysqli_real_escape_string($db, $value);
}

function sanitize_field($field)
{
	return preg_replace('/[^a-zA-Z0-9_]/', '', $field);
}

$allowed_fields = array('idNews', 'Users_idUsers', 'title', 'text', 'tags', 'date', 'url');

switch ($method) {
	case 'GET':
		$id = null;
		if (isset($_GET['idNews'])) {
			$id = $_GET['idNews'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		} elseif (!empty($_SERVER['PATH_INFO'])) {
			$id = trim($_SERVER['PATH_INFO'], '/');
		}

		if ($id !== null && $id !== '') {
			$query = "SELECT idNews, Users_idUsers, title, text, tags, date, url FROM news WHERE idNews='" . escape_value($db, $id) . "'";
			$result = mysqli_query($db, $query);
			$row = $result ? mysqli_fetch_assoc($result) : null;
			echo json_encode($row ? $row : array());
			break;
		}

		$where = array();
		if (isset($_GET['filter']) && isset($_GET['filter']['where']) && is_array($_GET['filter']['where'])) {
			foreach ($_GET['filter']['where'] as $field => $value) {
				$field = sanitize_field($field);
				if (in_array($field, $allowed_fields, true)) {
					$where[] = $field . "='" . escape_value($db, $value) . "'";
				}
			}
		}

		$order = '';
		if (isset($_GET['filter']) && isset($_GET['filter']['order'])) {
			$order_value = trim($_GET['filter']['order']);
			if (preg_match('/^([a-zA-Z0-9_]+)\\s*(ASC|DESC)?$/i', $order_value, $matches)) {
				$field = sanitize_field($matches[1]);
				$direction = isset($matches[2]) ? strtoupper($matches[2]) : 'ASC';
				if (in_array($field, $allowed_fields, true)) {
					$order = " ORDER BY " . $field . " " . ($direction === 'DESC' ? 'DESC' : 'ASC');
				}
			}
		}

		$limit = '';
		if (isset($_GET['filter']) && isset($_GET['filter']['limit'])) {
			$limit_value = (int)$_GET['filter']['limit'];
			if ($limit_value > 0) {
				$limit = " LIMIT " . $limit_value;
			}
		}

		$query = "SELECT idNews, Users_idUsers, title, text, tags, date, url FROM news";
		if (count($where) > 0) {
			$query .= " WHERE " . implode(' AND ', $where);
		}
		$query .= $order . $limit;

		$result = mysqli_query($db, $query);
		$news = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$news[] = $row;
			}
		}

		echo json_encode($news);
		break;

	case 'DELETE':
		$id = null;
		if (isset($_GET['idNews'])) {
			$id = $_GET['idNews'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		} elseif (!empty($_SERVER['PATH_INFO'])) {
			$id = trim($_SERVER['PATH_INFO'], '/');
		}

		if ($id === null || $id === '') {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'Missing news id.'));
			break;
		}

		$query = "DELETE FROM news WHERE idNews='" . escape_value($db, $id) . "'";
		if (!mysqli_query($db, $query)) {
			http_response_code(500);
			echo json_encode(array('result' => 'error', 'reason' => mysqli_error($db)));
			break;
		}

		echo json_encode(array('result' => 'success'));
		break;

	default:
		http_response_code(405);
		echo json_encode(array('result' => 'error', 'reason' => 'Method not allowed.'));
		break;
}
?>
