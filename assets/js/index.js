$(document).ready(function () {
  var today = new Date();
  var time =
    today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  $("#current-hour").text(time);
  $("#local-time").text(today);
});
