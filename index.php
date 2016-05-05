<html>
<head>
	<title> Social News </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="styles/style1.css" type="text/css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
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
		$("#content").load('register_content.php');
		});

		$("#panel").click(function(e) {
		e.preventDefault();
		$("#content").load('panel.php');
		});

	});
    </script>
</head>

<body>

	<div id=header>
		<h1>Social News</h1>
	</div>

	<div id=login>

		<?php
		require('vendor/autoload.php');

		session_start();
		if($_SESSION[validation] != "1")
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
			echo 'User: '.$_SESSION[username].'<br>';
			echo 'Permition: '.$_SESSION[permitionLevel].'<br><br>';
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
		<?php include "content.php";?>
	</div>

	<div id=footer>
	Social News
	</div>
</body>
</html>
