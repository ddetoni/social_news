<?php
	require "../dbconnect.php";

	$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
	$idComment = isset($_POST['idComment']) ? (int)$_POST['idComment'] : 0;

	if ($comment === '' || $idComment === 0) {
		echo 0;
		exit;
	}

	$query = "UPDATE comments SET comment='$comment' WHERE idComments='$idComment'";
	$res = mysql_query($query) or die(mysql_error());

	if ($res) {
		echo 1;
	} else {
		echo 0;
	}
?>
