<!DOCTYPE html>
<html>
<head>
	<title>Social News</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="styles/style1.css" type="text/css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="./js/menu.js"></script>
	<script type="text/javascript" src="./js/registerValidation.js"></script>
	<script type="text/javascript" src="./js/addNewsValidation.js"></script>
	<script type="text/javascript" src="./js/myNews.js"></script>
</head>
<body>
	<?php include __DIR__ . '/../../header.php'; ?>
	<div id="content">
		<?php include $view; ?>
	</div>
	<?php include __DIR__ . '/../../footer.html'; ?>
</body>
</html>
