function editNew(idNew) {
  $("#panel_view").load('edit_news.php?idNew=' + idNew);
};

function removeNew(idNew) {
  $("#panel_view").load('remove_new.php?idNew=' + idNew);
  $("#panel_view").load('my_news.php');
};
