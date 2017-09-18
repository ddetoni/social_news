<?php
	require('../vendor/autoload.php');
	session_start();
?>

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
		<?php
			include('header.php');
			include("content.php");
			include('footer.php');
		?>
	</body>
</html>
