$(document).ready(function () {
  $("#last_news").click(function (e) {
    e.preventDefault();
    $("#content").load('last_news.php');
  });

  $("#home").click(function (e) {
    e.preventDefault();
    $("#content").load('content.php');
  });

  $("#register_content").click(function (e) {
    e.preventDefault();
    $("#content").load('register_content.html');
  });

  $("#panel").click(function (e) {
    e.preventDefault();
    $("#content").load('panel.php');
  });
});
