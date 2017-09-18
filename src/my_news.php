<?php
	session_start();
	include 'dbconnect.php';
	
	$query = "SELECT idNews, title, url FROM News WHERE Users_idUsers='$_SESSION[idUser]' ORDER BY date DESC";
	$data = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($data))
	{
		
		echo "<div id='my_new'> 
				<a id='new' href='$row[url]'><h4>$row[title]</h4></a>
				<a id='edit_new' href='#' onclick='editNew($row[idNews])'>Edit</a> <br>
				<a id='edit_new' href='#' onclick='removeNew($row[idNews])'>Remove</a>
				<br>
			</div> ";
		
	}
?>