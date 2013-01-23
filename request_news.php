<?php
	include 'dbconnect.php';
	
	$request = "$_POST[serverUrl]?startDate=$_POST[startDate]&endDate=$_POST[endDate]&tags=$_POST[tags]";
	
	$json = file_get_contents($request);
	
	$decoded = json_decode($json, true) or die("Decode fail.");

	if($decodec[result]!="error"){
		$cont = 0;
		foreach ($decoded[data] as $new) {
			session_start();
	
			$title = $new[title];
			$text = $new[text];
			$tags = $new[tags];
			$date = $new[date];
			$idUser = $_SESSION[idUser];
			
			$query = "INSERT INTO `News` (`title`, `text`, `tags`, `date`, `Users_idUsers`) VALUES ('$title', '$text', '$tags', '$date','$idUser')";
			
			mysql_query($query) or die (mysql_error());
			$idNew = mysql_insert_id();
			$url = "news.php?idNew=$idNew";
			$query = "UPDATE `News` SET `url`='$url' WHERE `idNews`='$idNew'";
			mysql_query($query) or die(mysql_error());
			
			$cont++;
		}
			
		header("Location: $url");
	}
	else {
		echo "Error.";
	}
	
?>