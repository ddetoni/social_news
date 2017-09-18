function addNewsValidation() {
  var title = addNews.title.value;
  var text = addNews.text.value;
  var tags = addNews.tags.value;

  var erros = "";

  if (title == "") {
    erros = 'Put the Title.';
    addNews.title.focus();
  }

  if (text == "") {
    erros = erros + '\nPut the Text';
    addNews.text.focus();
  }

  if (tags == "") {
    erros = erros + '\nPut any Tags';
    addNews.tags.focus();
  }

  if (erros != "") {
    alert(erros);
    return false;
  }

  return true;
}
