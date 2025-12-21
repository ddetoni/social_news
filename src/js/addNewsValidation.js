function addNewsValidation() {
  var title = addNews.title.value;
  var text = addNews.text.value;
  var tags = addNews.tags.value;

  var errors = "";

  if (title == "") {
    errors = 'Enter a title.';
    addNews.title.focus();
  }

  if (text == "") {
    errors = errors + '\nEnter the text.';
    addNews.text.focus();
  }

  if (tags == "") {
    errors = errors + '\nEnter at least one tag.';
    addNews.tags.focus();
  }

  if (errors != "") {
    alert(errors);
    return false;
  }

  return true;
}
