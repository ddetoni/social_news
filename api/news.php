<?php
	include 'dbconnect.php';
	
	$start_date = $_GET[start_date];
	$end_date = $_GET[end_date];
	$tags = explode(" ",$_GET[tags]);
	
	$sizeArray = count($tags);
	$count = 0;
	$stringTag = "";
	
	foreach ($tags as $tag)
	{
		$stringTag = $stringTag."INSTR(tags, '$tag') !='0'";
		$count++;
		if($count != $sizeArray)
		{
			$stringTag = $stringTag." OR ";
		}
	}

	$query = "SELECT idNews, title, text, url, date, tags, Users_idUsers FROM News WHERE date >= '$start_date' AND date <= '$end_date' AND $stringTag";

	$data = mysql_query($query) or die (mysql_error());
	
	while($new = mysql_fetch_array($data))
	{
		$tags = explode(" ", $new[tags]);
		$info_user = mysql_query("SELECT name, lastName FROM Users WHERE idUsers=$new[Users_idUsers]");
		$user = mysql_fetch_array($info_user);
		$posted_by = $user[name]." ".$user[lastName];
		
		$news[] = array(
			"id" => $new[idNews],
			"title" => $new[title],
			"date" => $new[date],
			"text" => $new[text],
			"posted_by" => $posted_by,
			"url" => $new[url],
			"tags" => $tags
		);
	}
	
	if($news != null)
	{
		
		$json = array(
			"result" => "sucess",
			"server_name" => "Detoni",
			"data" => $news
		);
		
		echo json_encode($json);
	}else
	{
		$json = array(
			"result" => "error",
			"reason" => "His research is incorrect or no news found.",
			"code" => 1
		);
		
		echo json_encode($json);
	}
	
?>