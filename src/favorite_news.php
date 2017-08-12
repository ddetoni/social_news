<?php
	include 'dbconnect.php';
	session_start();
	
	$query = "SELECT urlNew, titleNew FROM Favorites WHERE Users_idUsers=$_SESSION[idUser] ORDER BY idFavorites DESC";
	$data = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($data))
	{
		
		echo "<div id='list_favorites'> 
				<a id='favorite' href='$row[urlNew]'><h4>$row[titleNew]</h4></a><br>
			</div> ";
		
	}

 ?>