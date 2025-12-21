$(document).ready(function () {
  $("#last_news").click(function (e) {
    e.preventDefault();
    $("#content").load('index.php?page=last_news&partial=1');
  });

  $("#home").click(function (e) {
    e.preventDefault();
    $("#content").load('index.php?page=home&partial=1');
  });

  $("#register_content").click(function (e) {
    e.preventDefault();
    $("#content").load('index.php?page=register&partial=1');
  });

  $("#panel").click(function (e) {
    e.preventDefault();
    $("#content").load('index.php?page=panel&partial=1');
  });
});
