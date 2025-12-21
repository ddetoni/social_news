<?php
	require "dbconnect.php";

	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	if ($idNew > 0) {
		$query = "DELETE FROM news WHERE idNews='$idNew'";
		mysql_query($query) or die(mysql_error());
	}
?>
