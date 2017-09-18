<?php
	require "../../vendor/autoload.php";

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	$resty->supportsPatch(TRUE);

	$querydata['comment'] = $_POST[comment];

	$resty->patch("comments/$_POST[idComment]", $querydata);
?>