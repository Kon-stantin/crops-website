$(document).ready(function () {
  var today = new Date();
  var weekday = today.getDay();
  var time = today.getHours();
  openStatus(weekday, time);
});

function openStatus(day, time) {
  var status = "Close !";
  console.log(day, time);
  if (day === 0) {
    if (time >= 8 && time <= 18) {
      status = "Open !";
    }
  } else if (day > 0 && day < 6) {
    if (time >= 9 && time <= 17) {
      status = "Open !";
    }
  } else if (day === 6) {
    if (time >= 8 && time <= 20) {
      status = "Open !";
    }
  }
  $("#farm-status").text(status);
}
