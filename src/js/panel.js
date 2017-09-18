$(document).ready(function () {
  $("#add_news").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('add_news_content.php');
  });

  $("#my_favorites").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('favorite_news.php');
  });

  $("#my_news").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('my_news.php');
  });

  $("#add_server").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('add_server_content.php');
  });

  $("#import_news").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('import_news.php');
  });

  $("#alterate_permition").click(function (e) {
    e.preventDefault();
    $("#panel_view").load('alterate_permition.php');
  });
});
