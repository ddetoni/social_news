<form name="add_server" action="add_server.php" method="post">
	Server Name: <input type="text" name="serverName"><br>
	Server Url: <input type="text" name="serverUrl"><br>
	<button type="submit" name="send_new">Add Server</button>
</form>
<br><br>
<h3>Server List:</h3>

<?php
	require "dbconnect.php";

	$query = "SELECT idServers, urlServer, nameServer FROM servers ORDER BY idServers DESC";
	$data = mysql_query($query);

	while ($data && ($server = mysql_fetch_array($data))) {
		$url = $server['urlServer'] ?? '';
		$name = $server['nameServer'] ?? '';
		echo "<div id='list_servers'> 
				<a id='server' href='$url'><h4>$name</h4></a>
			</div> ";
	}
 ?>
