<?php
	require "../vendor/autoload.php";
	session_start();

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));

	$querydata['comment'] = $_POST[comment];
	$querydata['Users_idUsers'] = $_SESSION[idUser];
	$querydata['News_idNews'] = $_SESSION[idNew];
	
	$resp = $resty->post("comments", $querydata);
	
	if($resp) echo 1;
	else echo 0;
?>