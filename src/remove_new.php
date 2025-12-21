<?php
	require "dbconnect.php";

	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	if ($idNew > 0) {
		db_query("DELETE FROM news WHERE idNews=?", array($idNew));
	}
?>
