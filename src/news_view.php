<?php
	if (!function_exists('db_query')) {
		require __DIR__ . '/app/bootstrap.php';
	}

	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	$_SESSION['idNew'] = $idNew;

	$new = null;
	$posted_by = '';
	if ($idNew > 0) {
		$stmt = db_query(
			"SELECT n.idNews, n.Users_idUsers, n.title, n.text, n.tags, n.date, n.url, u.name, u.lastName
			 FROM news n
			 LEFT JOIN users u ON u.idUsers = n.Users_idUsers
			 WHERE n.idNews = ?",
			array($idNew)
		);
		$new = db_fetch_one($stmt);
		if ($new) {
			$posted_by = trim(($new['name'] ?? '') . " " . ($new['lastName'] ?? ''));
		}
	}
?>

<script type="text/javascript">
$(document).ready(function() {
	$("#formComment").submit(function() {
		var commentPost = $("#text_comment").val();
		if (commentPost == "") {
			alert("Comment empty.");
			return false;
		}

		$.post("./comments/add_comment.php", {comment: commentPost}, 'html');
		alert("Comment sent.");
	});

	$("#favorite_link").click(function(e) {
		var url = window.location.toString();

		$.post("add_favorite.php", {url: url}, function(data){
			if (data == 1)
				alert("Favorited news.");
			else
				alert("Already a favorite.");
		}, 'html');
	});
});

function editComment(idComment){
	$("#box_edit").append("<br><textarea id='text_edit' rows='3' cols='40'></textarea><button type='submit' id='send_edit'>Update</button>");

	$("#send_edit").click(function() {
		var commentPost = $("#text_edit").val();
		if (commentPost == "") {
			alert("Comment empty.");
			return false;
		}

		$.post("./comments/edit_comment.php", {comment: commentPost, idComment: idComment}, 'html');
		alert("Comment edited.");
		$("#box_edit").hide();
		$("#comments_list").load(location.href + " #comments_list > *");
	});
}
</script>

<?php
	if (!$new) {
		echo "News not found.";
	} else {
		echo "<div id='new'><h3>".$new['title']."</h3>";
		echo "<h6>".$new['date']." - ".$posted_by."</h6>";
		if (isset($_SESSION['validation']) && $_SESSION['validation'] === "1") {
			echo "<a id='favorite_link' href='#'>Favorite</a><br><br>";
		} else {
			echo "<br>";
		}
		echo "<p>".$new['text']."</p><br></div>";
	}
?>
<hr color=black size=5>
<h3>Comments:</h3>

<div id='comments_list'>
	<?php
	if (isset($_SESSION['validation']) && $_SESSION['validation'] === "1")
	{
		echo "<form id='formComment' action='#' method='post'>
		<br> <textarea id='text_comment' rows='5' cols='60'></textarea>
		<button type='submit' id='send_comment'>Add Comment</button>
		</form>
		";
	}

	$idNew = isset($_SESSION['idNew']) ? (int)$_SESSION['idNew'] : 0;
	$stmt = db_query(
		"SELECT c.idComments, c.comment, c.Users_idUsers, u.name, u.lastName
		 FROM comments c
		 LEFT JOIN users u ON u.idUsers = c.Users_idUsers
		 WHERE c.News_idNews = ?
		 ORDER BY c.idComments DESC",
		array($idNew)
	);
	$comments = db_fetch_all($stmt);

	foreach ($comments as $row)
	{
		$posted_by = trim(($row['name'] ?? '')." ".($row['lastName'] ?? ''));
		echo "<div id='comment'>
				<h4>$posted_by :</h4>";
				if(isset($_SESSION['idUser']) && ($_SESSION['idUser']==$row['Users_idUsers'] || $_SESSION['idUser']==3))
				{
					echo "<a id='edit_comment' href='#' onclick='editComment(".$row['idComments'].");'>Edit</a><br>";
					echo "<div id='box_edit'></div>";
					echo "<a id='remove_comment' href='./comments/remove_comment.php?idComment=".$row['idComments']."&idNew=$idNew'>Remove</a><br><br>";
				}
				echo $row['comment']."<br><br>
			  </div> ";
	}
	?>

</div>
