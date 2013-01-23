<?php
	
	include 'dbconnect.php';
	
	$query = "SELECT title, date, url FROM News ORDER BY date DESC LIMIT 10";
	$data = mysql_query($query);
	
	while($row = mysql_fetch_array($data))
	{
		
		echo "<div id='lastNews'> 
				<a id='new1_link' href='$row[url]'><h4>$row[title]</h4></a> ($row[date])<br>
			</div> ";
		
	}
	
?>