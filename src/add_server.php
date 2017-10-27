<?php
	require "../vendor/autoload.php";
	session_start();

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));

	$querydata['urlServer'] = $_POST[serverUrl];
	$querydata['nameServer'] = $_POST[serverName];
	
	$resty->post("servers", $querydata);
	
	header('Location: index.php');
?>