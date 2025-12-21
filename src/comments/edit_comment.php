<?php
	require "../dbconnect.php";

	$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
	$idComment = isset($_POST['idComment']) ? (int)$_POST['idComment'] : 0;

	if ($comment === '' || $idComment === 0) {
		echo 0;
		exit;
	}

	db_query("UPDATE comments SET comment=? WHERE idComments=?", array($comment, $idComment));
	echo 1;
?>
