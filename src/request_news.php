<?php
	include 'dbconnect.php';
	session_start();
	
	$serverUrl = isset($_POST['serverUrl']) ? trim($_POST['serverUrl']) : '';
	$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
	$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
	$tags = isset($_POST['tags']) ? $_POST['tags'] : '';

	if ($serverUrl === '') {
		echo "Error.";
		exit;
	}

	$parsed = parse_url($serverUrl);
	$path = isset($parsed['path']) ? $parsed['path'] : '';
	if ($path === '' || $path === '/') {
		$serverUrl = rtrim($serverUrl, '/') . '/api/news.php';
	}

	$query = http_build_query(array(
		'startDate' => $startDate,
		'endDate' => $endDate,
		'tags' => $tags
	));
	$request = $serverUrl . '?' . $query;
	
	$json = @file_get_contents($request);
	if ($json === false) {
		echo "Error.";
		exit;
	}
	
	$decoded = json_decode($json, true) or die("Decode failed.");

	if(isset($decoded['result']) && $decoded['result'] != "error"){
		$cont = 0;
		foreach ($decoded['data'] as $new) {
	
			$title = isset($new['title']) ? $new['title'] : '';
			$text = isset($new['text']) ? $new['text'] : '';
			$tags = isset($new['tags']) ? $new['tags'] : '';
			$date = isset($new['date']) ? $new['date'] : '';
			$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
			
			$query = "INSERT INTO `news` (`title`, `text`, `tags`, `date`, `Users_idUsers`) VALUES ('$title', '$text', '$tags', '$date','$idUser')";
			
			mysql_query($query) or die (mysql_error());
			$idNew = mysql_insert_id();
			$url = "news.php?idNew=$idNew";
			$query = "UPDATE `news` SET `url`='$url' WHERE `idNews`='$idNew'";
			mysql_query($query) or die(mysql_error());
			
			$cont++;
		}
			
		header("Location: $url");
	}
	else {
		echo "Error.";
	}
	
?>
