<?php
	require "../vendor/autoload.php";
	
	use Resty\Resty;
	
	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	$resp = $resty->delete("news/$_GET[idNew]");
?>