<?php
	require "../vendor/autoload.php";
	session_start();

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	$response = $resty->get("news_api.php", "idNews=$idNew");
?>

<form name="add_news" action="update_new.php?idNew=<?php echo $idNew; ?>" method="post">
	<?php
		$news = isset($response['body']) ? $response['body'] : (object)array();
		$title = is_object($news) ? ($news->title ?? '') : ($news['title'] ?? '');
		$text = is_object($news) ? ($news->text ?? '') : ($news['text'] ?? '');
		$tags = is_object($news) ? ($news->tags ?? '') : ($news['tags'] ?? '');
	?>
	Title: <input type="text" name="title" value="<?php echo $title; ?>"><br>
	Text:<br> <textarea name="text" rows="20" cols="60"><?php echo $text; ?></textarea><br>
	Tags: <input type="text" name="tags" value="<?php echo $tags; ?>"><br>
	<button type="submit" name="send_new">Update New</button>
</form>
