<?php
	include 'dbconnect.php';
	
	$idNew = $_GET[idNew];
	
	$query = "SELECT title, text, tags FROM News WHERE idNews=$idNew";
	$data = mysql_query($query);
	
	$new = mysql_fetch_array($data);
?>

<form name="add_news" action="update_new.php?idNew=<?php echo $idNew; ?>" method="post">
	Title: <input type="text" name="title" value="<?php echo $new[title]; ?>"><br>
	Text:<br> <textarea name="text" rows="20" cols="60"><?php echo $new[text]; ?></textarea><br>
	Tags: <input type="text" name="tags" value="<?php echo $new[tags]; ?>"><br>
	<button type="submit" name="send_new">Update New</button>
</form>