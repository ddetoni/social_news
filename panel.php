<?php
	session_start();
	if($_SESSION[validation] != "1")
	{
		header("Location: index.php");
	}
	
	
?>	

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
<script type="text/javascript">  
$(document).ready(function() {
	
	$("#add_news").click(function(e) {
		e.preventDefault();
		$("#panel_view").load('add_news_content.php');
	});
	
	$("#my_favorites").click(function(e) {
		e.preventDefault();
		$("#panel_view").load('favorite_news.php');
	});
	
	$("#my_news").click(function(e) {
		e.preventDefault();
		$("#panel_view").load('my_news.php');
	});
	
	$("#add_server").click(function(e) {
		e.preventDefault();
		$("#panel_view").load('add_server_content.php');
	});
	
	$("#import_news").click(function(e) {
		e.preventDefault();
		$("#panel_view").load('import_news.php');
	});
	
	$("#alterate_permition").click(function(e) {
		e.preventDefault();
		$("#panel_view").load('alterate_permition.php');
	});
	
});
</script>  

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
