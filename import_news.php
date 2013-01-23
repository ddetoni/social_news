<form name="add_server" action="request_news.php" method="post">
	Start Date: <input type="text" name="startDate"> (aaaa-mm-dd hh:mm:ss)<br>
	End Date: <input type="text" name="endDate"> (aaaa-mm-dd hh:mm:ss)<br>
	Tags: <input type="text" name="tags"> Separadas por espaço.<br>
	<h4>Server List:</h4>
	<select name="serverUrl">
	<?php
		include 'dbconnect.php';
		session_start();
		
		$query = "SELECT * FROM Servers ORDER BY idServers DESC";
		$data = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_array($data))
		{
			
			echo "<option value='$row[urlServer]'>$row[nameServer]</option>";
			
		}

 	?>
	</select>
	
	<button type="submit" name="send_new">Import News</button>
</form>
<br><br>

