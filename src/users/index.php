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

switch ($method) {
	case 'GET':
		$where = array();
		if (isset($_GET['filter']) && isset($_GET['filter']['where']) && is_array($_GET['filter']['where'])) {
			foreach ($_GET['filter']['where'] as $field => $value) {
				$field = preg_replace('/[^a-zA-Z0-9_]/', '', $field);
				$where[] = $field . "='" . escape_value($db, $value) . "'";
			}
		}

		$query = "SELECT idUsers, username, password, name, lastName, birth, email, permitionLevel FROM users";
		if (count($where) > 0) {
			$query .= " WHERE " . implode(' AND ', $where);
		}

		$result = mysqli_query($db, $query);
		$users = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$users[] = $row;
			}
		}

		echo json_encode($users);
		break;

	case 'POST':
		$fields = array(
			'username',
			'password',
			'name',
			'lastName',
			'birth',
			'email',
			'permitionLevel'
		);

		$data = array();
		foreach ($fields as $field) {
			if (isset($_POST[$field])) {
				$data[$field] = escape_value($db, $_POST[$field]);
			}
		}

		if (!isset($data['username']) || !isset($data['password'])) {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'Missing required fields.'));
			break;
		}

		$query = "INSERT INTO users (username, password, name, lastName, birth, email, permitionLevel) VALUES (" .
			"'" . $data['username'] . "'," .
			"'" . $data['password'] . "'," .
			(isset($data['name']) ? "'" . $data['name'] . "'" : "NULL") . "," .
			(isset($data['lastName']) ? "'" . $data['lastName'] . "'" : "NULL") . "," .
			(isset($data['birth']) ? "'" . $data['birth'] . "'" : "NULL") . "," .
			(isset($data['email']) ? "'" . $data['email'] . "'" : "NULL") . "," .
			(isset($data['permitionLevel']) ? "'" . $data['permitionLevel'] . "'" : "1") .
		")";

		if (!mysqli_query($db, $query)) {
			http_response_code(500);
			echo json_encode(array('result' => 'error', 'reason' => mysqli_error($db)));
			break;
		}

		echo json_encode(array('result' => 'success'));
		break;

	case 'PATCH':
		$id = null;
		if (isset($_GET['idUsers'])) {
			$id = $_GET['idUsers'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		} elseif (isset($_POST['idUsers'])) {
			$id = $_POST['idUsers'];
		} elseif (isset($_POST['id'])) {
			$id = $_POST['id'];
		} elseif (!empty($_SERVER['PATH_INFO'])) {
			$id = trim($_SERVER['PATH_INFO'], '/');
		}

		if ($id === null || $id === '') {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'Missing user id.'));
			break;
		}

		$allowed = array('username', 'password', 'name', 'lastName', 'birth', 'email', 'permitionLevel');
		$set = array();
		foreach ($allowed as $field) {
			if (isset($_POST[$field])) {
				$set[] = $field . "='" . escape_value($db, $_POST[$field]) . "'";
			}
		}

		if (count($set) === 0) {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'No fields to update.'));
			break;
		}

		$query = "UPDATE users SET " . implode(', ', $set) . " WHERE idUsers='" . escape_value($db, $id) . "'";
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
