<?php
	require "../dbconnect.php";
	session_start();

	$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
	$idUser = isset($_SESSION['idUser']) ? (int)$_SESSION['idUser'] : 0;
	$idNew = isset($_SESSION['idNew']) ? (int)$_SESSION['idNew'] : 0;

	if ($comment === '' || $idUser === 0 || $idNew === 0) {
		echo 0;
		exit;
	}

	$query = "INSERT INTO comments (comment, Users_idUsers, News_idNews) VALUES ('$comment', '$idUser', '$idNew')";
	$res = mysql_query($query) or die(mysql_error());

	if ($res) {
		echo 1;
	} else {
		echo 0;
	}
?>
