<?php
	if (!function_exists('db_query')) {
		require __DIR__ . '/app/bootstrap.php';
	}

	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	$stmt = db_query(
		"SELECT title, text, tags FROM news WHERE idNews=?",
		array($idNew)
	);
	$news = db_fetch_one($stmt);
?>

<form name="add_news" action="update_new.php?idNew=<?php echo $idNew; ?>" method="post">
	<?php
		$title = $news ? ($news['title'] ?? '') : '';
		$text = $news ? ($news['text'] ?? '') : '';
		$tags = $news ? ($news['tags'] ?? '') : '';
	?>
	Title: <input type="text" name="title" value="<?php echo $title; ?>"><br>
	Text:<br> <textarea name="text" rows="20" cols="60"><?php echo $text; ?></textarea><br>
	Tags: <input type="text" name="tags" value="<?php echo $tags; ?>"><br>
	<button type="submit" name="send_new">Update New</button>
</form>
