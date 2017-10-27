<?php
	require "../vendor/autoload.php";
	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	$resty->supportsPatch(TRUE);

	if($_POST[name]!="") {
		$name = $_POST[name];
		$lastName = $_POST[lastName];
		$response = $resty->get("users", "filter[where][name]=$name&filter[where][lastName]=$lastName");

		$idUsers = $response['body'][0]->idUsers;
		$querydata[permitionLevel] = $_POST[permition];
		$resty->patch("users/$idUsers", $querydata);
		
		header('Location: index.php');
		exit();
	}
?>

<form name="alterate_permition" action="alterate_permition.php" method="post">
	Name: <input type="text" name="name"><br>
	Last Name: <input type="text" name="lastName"><br>
	Permition Level: 
	<select name="permition">
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
	</select>
	<button type="submit" name="send_permition">Alterate</button>
</form>
