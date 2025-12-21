<?php
	require "../dbconnect.php";

	$idComment = isset($_GET['idComment']) ? (int)$_GET['idComment'] : 0;
	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;

	if ($idComment > 0) {
		$query = "DELETE FROM comments WHERE idComments='$idComment'";
		mysql_query($query) or die(mysql_error());
	}

	header("Location:../news.php?idNew=$idNew");
?>
