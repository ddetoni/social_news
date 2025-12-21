<?php
	include 'dbconnect.php';
	session_start();

	$idNew = isset($_GET['idNew']) ? (int)$_GET['idNew'] : 0;
	$_SESSION['idNew'] = $idNew;

	$new = null;
	$posted_by = '';
	if ($idNew > 0) {
		$query = "SELECT * FROM news WHERE idNews='$idNew'";
		$data = mysql_query($query);
		if ($data) {
			$new = mysql_fetch_array($data);
		}

		if ($new && isset($new['Users_idUsers'])) {
			$info_user = mysql_query("SELECT name, lastName FROM users WHERE idUsers=" . (int)$new['Users_idUsers']);
			if ($info_user) {
				$user = mysql_fetch_array($info_user);
				$posted_by = ($user['name'] ?? '') . " " . ($user['lastName'] ?? '');
			}
		}
	}
?>

<html>
<head>
	<title> Social News </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="styles/style1.css" type="text/css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
	<script type="text/javascript" src="./js/addNewsValidation.js"></script>
	<script type="text/javascript" src="./js/myNews.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

		$("#last_news").click(function(e) {
		e.preventDefault();
		$("#content").load('last_news.php');
		});

		$("#home").click(function(e) {
		e.preventDefault();
		$("#content").load('content.php');
		});

		$("#register_content").click(function(e) {
		e.preventDefault();
		$("#content").load('register_content.html');
		});

		$("#panel").click(function(e) {
		e.preventDefault();
		$("#content").load('panel.php');
		});

		$("#formComment").submit(function() {

			var commentPost = $("#text_comment").val();
			if(commentPost==""){
				alert("Comment empty.");
				return false;
			}

	        $.post("./comments/add_comment.php", {comment: commentPost}, 'html');
			alert("Comment sent.");

	    });

	    $("#favorite_link").click(function(e) {
	    	var url = window.location.toString();

			$.post("add_favorite.php", {url: url}, function(data){

				if(data==1)
					alert("Favorited new.");
				else
					alert("Already a favorite.");

			}, 'html');
		});
	});

	function editComment(idComment){
		$("#box_edit").append("<br><textarea id='text_edit' rows='3' cols='40'></textarea><button type='submit' id='send_edit'>Update</button>");

		$("#send_edit").click(function() {

				var commentPost = $("#text_edit").val();
				if(commentPost==""){
					alert("Comment empty.");
					return false;
				}

		        $.post("./comments/edit_comment.php", {comment: commentPost, idComment: idComment}, 'html');
				alert("Comment edited.");
		        $("#box_edit").hide();
		        $("#comments_list").load(location.href + " #comments_list > *");
	    });

	};

    </script>
</head>

<body>

	<div id=header>
		<h1>Social News</h1>
	</div>

	<div id=login>

		<?php
		if (!isset($_SESSION['validation']) || $_SESSION['validation'] !== "1")
		{
			echo '<form action="login.php" method="post">
						Login:
						<input type="text" name="username" size="14">
						Password:
						<input type="password" name="password" size="14" >
						<button type="submit" name="send">Send</button>
						<a id="register_content" href="#"><h5>Register</h5></a>
				 </form>';
		} else
		{
			echo 'User: '.$_SESSION['username'].'<br>';
			echo 'Permission: '.$_SESSION['permitionLevel'].'<br><br>';
			echo '<a id="panel" href="#">Panel</a><br>';
			echo '<a href="logout.php">Logout</a>';
		}
		?>
	</div>

	<div id=menu>
		<ul>
			<li><a id="home" href="#">Home</a></li>
			<li><a id="last_news" href="#">Last News</a></li>
		</ul>

	</div>

	<div id=content>
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
			$query = "SELECT idComments, comment, Users_idUsers FROM comments WHERE News_idNews=$idNew ORDER BY idComments DESC";
			$data = mysql_query($query);

			while($data && ($row = mysql_fetch_array($data)))
			{
				$info_user = mysql_query("SELECT name, lastName FROM users WHERE idUsers=".(int)$row['Users_idUsers']);
				$user = mysql_fetch_array($info_user);
				$posted_by = ($user['name'] ?? '')." ".($user['lastName'] ?? '');
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

	</div>

	<div id=footer>
	Social News
	</div>
</body>
</html>
