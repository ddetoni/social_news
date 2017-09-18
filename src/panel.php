<?php
	session_start();
	if($_SESSION[validation] != "1")
	{
		header("Location: index.php");
	}
?>

<script type="text/javascript" src="./js/panel.js"></script>
<div id="sidebar">
	<ul>
		<?php
			session_start();

			if($_SESSION[permitionLevel]>=2) echo "<li><a id='add_news' href='#'>Add News</a></li>";
			if($_SESSION[permitionLevel]>=1) echo "<li><a id='my_favorites' href='#'>My Favorites</a></li>";
			if($_SESSION[permitionLevel]>=2) echo "<li><a id='my_news' href='#'>My News</a></li>";
			if($_SESSION[permitionLevel]==3) echo "<li><a id='add_server' href='#'>Add Server</a></li>";
			if($_SESSION[permitionLevel]==3) echo "<li><a id='import_news' href='#'>Import News</a></li>";
			if($_SESSION[permitionLevel]==3) echo "<li><a id='alterate_permition' href='#'>Alterate Permition</a></li>";
		?>
	</ul>

</div>

<div id="panel_view">
</div>
