<form name="add_server" action="add_server.php" method="post">
	Server Name: <input type="text" name="serverName"><br>
	Server Url: <input type="text" name="serverUrl"><br>
	<button type="submit" name="send_new">Add Server</button>
</form>
<br><br>
<h3>Server List:</h3>

<?php
	include 'dbconnect.php';
	session_start();
	
	$query = "SELECT * FROM Servers ORDER BY idServers DESC";
	$data = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($data))
	{
		
		echo "<div id='list_servers'> 
				<a id='server' href='$row[urlServer]'><h4>$row[nameServer]</h4></a>
			</div> ";
		
	}

 ?>