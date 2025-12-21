<?php
	include 'dbconnect.php';
	
	$start_date = isset($_GET['startDate']) ? $_GET['startDate'] : '';
	$end_date = isset($_GET['endDate']) ? $_GET['endDate'] : '';
	$tags = isset($_GET['tags']) ? explode(" ", $_GET['tags']) : array();
	$tags = array_values(array_filter($tags, 'strlen'));
	
	$sizeArray = count($tags);
	$count = 0;
	$stringTag = "";
	
	foreach ($tags as $tag) {
		if ($tag === '') {
			continue;
		}
		$stringTag .= "INSTR(tags, ?) != '0'";
		$count++;
		if ($count != $sizeArray) {
			$stringTag .= " OR ";
		}
	}

	$whereTag = $stringTag !== "" ? " AND ($stringTag)" : "";
	$sql = "SELECT n.idNews, n.title, n.text, n.url, n.date, n.tags, n.Users_idUsers, u.name, u.lastName
		FROM news n
		LEFT JOIN users u ON u.idUsers = n.Users_idUsers
		WHERE n.date >= ? AND n.date <= ?$whereTag";

	$params = array($start_date, $end_date);
	foreach ($tags as $tag) {
		if ($tag === '') {
			continue;
		}
		$params[] = $tag;
	}

	$stmt = db_query($sql, $params);
	$rows = db_fetch_all($stmt);
	foreach ($rows as $new) {
		$tags_list = explode(" ", $new['tags']);
		$posted_by = trim(($new['name'] ?? '') . " " . ($new['lastName'] ?? ''));
		$news[] = array(
			"id" => $new['idNews'],
			"title" => $new['title'],
			"date" => $new['date'],
			"text" => $new['text'],
			"posted_by" => $posted_by,
			"url" => $new['url'],
			"tags" => $tags_list
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
