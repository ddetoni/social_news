<?php
	require "../../vendor/autoload.php";

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	$resty->delete("comments/$_GET[idComment]");

	header("Location:../news.php?idNew=$_GET[idNew]");
?>