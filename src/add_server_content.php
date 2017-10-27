<form name="add_server" action="add_server.php" method="post">
	Server Name: <input type="text" name="serverName"><br>
	Server Url: <input type="text" name="serverUrl"><br>
	<button type="submit" name="send_new">Add Server</button>
</form>
<br><br>
<h3>Server List:</h3>

<?php
	require "../vendor/autoload.php";

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));

	$response = $resty->get("servers", "filter[order]=idServers%20DESC");
	
	foreach($response['body'] as $server) {
		echo "<div id='list_servers'> 
				<a id='server' href='$server->urlServer'><h4>$server->nameServer</h4></a>
			</div> ";
	}
 ?>