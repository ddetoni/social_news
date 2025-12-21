<form name="add_server" action="request_news.php" method="post">
	Start Date: <input type="text" name="startDate"> (yyyy-mm-dd hh:mm:ss)<br>
	End Date: <input type="text" name="endDate"> (yyyy-mm-dd hh:mm:ss)<br>
	Tags: <input type="text" name="tags"> Separated by spaces.<br>
	<h4>Server List:</h4>
	<select name="serverUrl">
	<?php
		include 'dbconnect.php';
		
		$query = "SELECT * FROM servers ORDER BY idServers DESC";
		$data = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_array($data))
		{
			
			echo "<option value='".$row['urlServer']."'>".$row['nameServer']."</option>";
			
		}

 	?>
	</select>
	
	<button type="submit" name="send_new">Import News</button>
</form>
<br><br>
