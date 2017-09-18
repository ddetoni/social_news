<div id=content>
	<?php
		include 'dbconnect.php';
		
		$query = "SELECT title, text, url FROM News ORDER BY date DESC LIMIT 4";
		$data = mysql_query($query);
		
		$new1= mysql_fetch_assoc($data);
		$new2= mysql_fetch_assoc($data);
		$new3= mysql_fetch_assoc($data);
		$new4= mysql_fetch_assoc($data);
		
		$size_intro = 400;
		
		if($data != null){
			echo "
			<div id='new1'> 
				<h3>$new1[title]</h3><br>
				".substr($new1[text], 0, $size_intro)."... <a href='$new1[url]'>Veja mais.</a><br><br>
			</div> ";
			
			echo "
			<div id='new2'> 
				<h3>$new2[title]</h3><br>
				".substr($new2[text], 0, $size_intro)."... <a href='$new2[url]'>Veja mais.</a><br><br>
			</div> ";
			
			echo "
			<div id='new3'> 
				<h3>$new3[title]</h3><br>
				".substr($new3[text], 0, $size_intro)."... <a href='$new3[url]'>Veja mais.</a><br><br>
			</div> ";
			
			echo "<div id='new4'> 
				<h3>$new4[title]</h3><br>
				".substr($new4[text], 0, $size_intro)."... <a href='$new4[url]'>Veja mais.</a><br><br>
			</div> ";
			}else
			{
				echo "No news.";
			}	
	?>
</div>
