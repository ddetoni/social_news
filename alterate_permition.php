
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
<?php
	
	if($_POST[name]!="") {
		include 'dbconnect.php';
		
		$name = $_POST[name];
		$lastName = $_POST[lastName];
		$permition = $_POST[permition];
		
		$query = "UPDATE Users SET permitionLevel='$permition' WHERE name='$name' AND lastName='$lastName'";
		$res = mysql_query($query) or die(mysql_error());
		
		header('Location: index.php');
		
	}
?>