<?php
	require "../vendor/autoload.php";
	
	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));

	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	
	$response = $resty->get("users", "filter[where][username]=$username");

	$user = $response['body'][0];

	if ($user->password == $password)
	{
		$validation = "1";
		$username = $user->username;

		session_start();

		$_SESSION['username'] = $user->username;
		$_SESSION['validation'] = $validation;
		$_SESSION['permitionLevel'] = $user->permitionLevel;
		$_SESSION['idUser'] = $user->idUsers;

		header ("Location: index.php");
	}

	header ("Location: index.php");
?>
