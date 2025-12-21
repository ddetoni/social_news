<?php
	require "../vendor/autoload.php";
	
	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));

	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? sha1($_POST['password']) : '';
	
	$response = $resty->get("users.php", "filter[where][username]=$username");

	$user = (isset($response['body']) && is_array($response['body']) && isset($response['body'][0]))
		? $response['body'][0]
		: null;

	if ($user && $password !== '' && $user->password == $password)
	{
		$validation = "1";

		session_start();

		$_SESSION['username'] = $user->username;
		$_SESSION['validation'] = $validation;
		$_SESSION['permitionLevel'] = $user->permitionLevel;
		$_SESSION['idUser'] = $user->idUsers;

		header ("Location: index.php");
		exit;
	}

	header ("Location: index.php");
	exit;
?>
