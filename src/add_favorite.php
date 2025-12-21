<?php
	session_start();
	include 'dbconnect.php';
	
	$url = isset($_POST['url']) ? $_POST['url'] : '';
	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	$idNew = isset($_SESSION['idNew']) ? (int)$_SESSION['idNew'] : 0;

	if ($idUser === 0 || $idNew === 0 || $url === '') {
		echo 0;
		exit;
	}

	$data = mysql_query("SELECT title FROM news WHERE idNews=$idNew");
	$titleNew = $data ? mysql_fetch_array($data) : null;
	$title = $titleNew ? $titleNew['title'] : '';
	if ($title === '') {
		echo 0;
		exit;
	}

	$data = mysql_query("SELECT * FROM favorites WHERE titleNew='$title' AND Users_idUsers='$idUser'");
	$exists = $data ? mysql_fetch_array($data) : null;
	
	if(!$exists || $exists['titleNew'] != $title){
		$sqlinsert = "INSERT INTO `favorites` (`urlNew`, `Users_idUsers`, `titleNew`) VALUES ('$url', '$idUser', '$title')";
		$res = mysql_query($sqlinsert) or die (mysql_error());
		echo 1;
	} else {
		echo 0;
	}

	
?>
