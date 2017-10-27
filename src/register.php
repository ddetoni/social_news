<?php
	require "../vendor/autoload.php";
	
	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$querydata[username] = $_POST['username'];
	$querydata[password] = sha1($_POST['password']);
	$querydata[name] = $_POST['name'];
	$querydata[lastName] = $_POST['lastName'];
	$querydata[birth] = $_POST['years'].'-'.$_POST['months'].'-'.$_POST['days'];
	$querydata[email] = $_POST['email'];
	$querydata[permitionLevel] = 1;
	
	$resty->post("users", $querydata);
		
	header ("Location: index.php");
?>
