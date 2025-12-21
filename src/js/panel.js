$(document).ready(function () {
  $("#add_news").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('index.php?page=add_news&partial=1');
  });

  $("#my_favorites").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('index.php?page=favorite_news&partial=1');
  });

  $("#my_news").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('index.php?page=my_news&partial=1');
  });

  $("#add_server").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('index.php?page=add_server&partial=1');
  });

  $("#import_news").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('index.php?page=import_news&partial=1');
  });

  $("#alterate_permition").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('index.php?page=alterate_permition&partial=1');
  });
});
