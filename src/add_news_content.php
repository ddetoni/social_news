<script language="javascript" type="text/javascript">
	function validar() {
		var title = add_news.title.value;
		var text = add_news.text.value;
		var tags = add_news.tags.value;
		
		var erros="";
		
		if (title == "") {
			erros = 'Put the Title.';
			formRegister.name.focus();
		}
		
		if (text == "") {
			erros = erros +'\nPut the Text';
			formRegister.lastName.focus();
		}
		
		if (tags == "") {
			erros = erros +'\nPut any Tags';
			formRegister.days.focus();
		}
		
		if(erros != "")
		{			
			alert(erros);
			return false;
		}
		
		return true;
	}
</script>

<form name="add_news" action="add_new.php" method="post" onSubmit="return validar()">
	Title: <input type="text" name="title"><br>
	Text:<br> <textarea name="text" rows="20" cols="60"></textarea><br>
	Tags: <input type="text" name="tags"><br>
	<button type="submit" name="send_new">Add New</button>
</form>

