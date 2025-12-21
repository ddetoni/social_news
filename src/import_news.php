<form name="add_server" action="request_news.php" method="post">
	Start Date: <input type="text" name="startDate"> (yyyy-mm-dd hh:mm:ss)<br>
	End Date: <input type="text" name="endDate"> (yyyy-mm-dd hh:mm:ss)<br>
	Tags: <input type="text" name="tags"> Separated by spaces.<br>
	<h4>Server List:</h4>
	<select name="serverUrl">
	<?php
		include 'dbconnect.php';
		
		$stmt = db_query("SELECT idServers, urlServer, nameServer FROM servers ORDER BY idServers DESC");
		$servers = db_fetch_all($stmt);
		foreach ($servers as $row) {
			echo "<option value='".$row['urlServer']."'>".$row['nameServer']."</option>";
		}

 	?>
	</select>
	
	<button type="submit" name="send_new">Import News</button>
</form>
<br><br>
