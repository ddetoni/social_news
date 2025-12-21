function editNew(idNew) {
  $("#panel_view").load('index.php?page=edit_news&partial=1&idNew=' + idNew);
};

function removeNew(idNew) {
  $("#panel_view").load('remove_new.php?idNew=' + idNew, function () {
    $("#panel_view").load('index.php?page=my_news&partial=1');
  });
};
