<?php
	require "../vendor/autoload.php";
	session_start();

	use Resty\Resty;

	$resty = new Resty();
	$resty->setBaseURL(getenv('API_BASE_URL'));
	
	$idNew = $_GET[idNew];
	$response = $resty->get("news/$idNew");
?>

<form name="add_news" action="update_new.php?idNew=<?php echo $idNew; ?>" method="post">
	Title: <input type="text" name="title" value="<?php echo $response['body']->title; ?>"><br>
	Text:<br> <textarea name="text" rows="20" cols="60"><?php echo $response['body']->text; ?></textarea><br>
	Tags: <input type="text" name="tags" value="<?php echo $response['body']->tags; ?>"><br>
	<button type="submit" name="send_new">Update New</button>
</form>