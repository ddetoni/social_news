<?php
	require "../dbconnect.php";

	$idComment = isset($_GET['idComment']) ? (int)$_GET['idComment'] : 0;
	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;

	if ($idComment > 0) {
		db_query("DELETE FROM comments WHERE idComments=?", array($idComment));
	}

	header("Location:../news.php?idNew=$idNew");
?>
