<?php
	session_start();
	if (!isset($_SESSION['validation']) || $_SESSION['validation'] !== "1") {
		header("Location: index.php");
		exit;
	}
	$permitionLevel = isset($_SESSION['permitionLevel']) ? (int)$_SESSION['permitionLevel'] : 0;
?>

<script type="text/javascript" src="./js/panel.js"></script>
<div id="sidebar">
	<ul>
		<?php
			if ($permitionLevel >= 2) echo "<li><a id='add_news' href='#'>Add News</a></li>";
			if ($permitionLevel >= 1) echo "<li><a id='my_favorites' href='#'>My Favorites</a></li>";
			if ($permitionLevel >= 2) echo "<li><a id='my_news' href='#'>My News</a></li>";
			if ($permitionLevel === 3) echo "<li><a id='add_server' href='#'>Add Server</a></li>";
			if ($permitionLevel === 3) echo "<li><a id='import_news' href='#'>Import News</a></li>";
			if ($permitionLevel === 3) echo "<li><a id='alterate_permition' href='#'>Change Permission</a></li>";
		?>
	</ul>

</div>

<div id="panel_view">
</div>
