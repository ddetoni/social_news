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

$allowed_fields = array('idComments', 'comment', 'Users_idUsers', 'News_idNews');

switch ($method) {
	case 'GET':
		$id = null;
		if (isset($_GET['idComments'])) {
			$id = $_GET['idComments'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		} elseif (!empty($_SERVER['PATH_INFO'])) {
			$id = trim($_SERVER['PATH_INFO'], '/');
		}

		if ($id !== null && $id !== '') {
			$query = "SELECT idComments, comment, Users_idUsers, News_idNews FROM comments WHERE idComments='" . escape_value($db, $id) . "'";
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

		$query = "SELECT idComments, comment, Users_idUsers, News_idNews FROM comments";
		if (count($where) > 0) {
			$query .= " WHERE " . implode(' AND ', $where);
		}
		$query .= $order . $limit;

		$result = mysqli_query($db, $query);
		$comments = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$comments[] = $row;
			}
		}

		echo json_encode($comments);
		break;

	case 'POST':
		$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
		$user_id = isset($_POST['Users_idUsers']) ? (int)$_POST['Users_idUsers'] : 0;
		$news_id = isset($_POST['News_idNews']) ? (int)$_POST['News_idNews'] : 0;

		if ($comment === '' || $user_id === 0 || $news_id === 0) {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'Missing required fields.'));
			break;
		}

		$query = "INSERT INTO comments (comment, Users_idUsers, News_idNews) VALUES (" .
			"'" . escape_value($db, $comment) . "'," .
			"'" . escape_value($db, $user_id) . "'," .
			"'" . escape_value($db, $news_id) . "'" .
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
		if (isset($_GET['idComments'])) {
			$id = $_GET['idComments'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		} elseif (isset($_POST['idComments'])) {
			$id = $_POST['idComments'];
		} elseif (isset($_POST['id'])) {
			$id = $_POST['id'];
		} elseif (!empty($_SERVER['PATH_INFO'])) {
			$id = trim($_SERVER['PATH_INFO'], '/');
		}

		if ($id === null || $id === '') {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'Missing comment id.'));
			break;
		}

		$set = array();
		if (isset($_POST['comment'])) {
			$set[] = "comment='" . escape_value($db, $_POST['comment']) . "'";
		}

		if (count($set) === 0) {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'No fields to update.'));
			break;
		}

		$query = "UPDATE comments SET " . implode(', ', $set) . " WHERE idComments='" . escape_value($db, $id) . "'";
		if (!mysqli_query($db, $query)) {
			http_response_code(500);
			echo json_encode(array('result' => 'error', 'reason' => mysqli_error($db)));
			break;
		}

		echo json_encode(array('result' => 'success'));
		break;

	case 'DELETE':
		$id = null;
		if (isset($_GET['idComments'])) {
			$id = $_GET['idComments'];
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];
		} elseif (!empty($_SERVER['PATH_INFO'])) {
			$id = trim($_SERVER['PATH_INFO'], '/');
		}

		if ($id === null || $id === '') {
			http_response_code(400);
			echo json_encode(array('result' => 'error', 'reason' => 'Missing comment id.'));
			break;
		}

		$query = "DELETE FROM comments WHERE idComments='" . escape_value($db, $id) . "'";
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
