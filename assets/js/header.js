$(document).ready(function () {
  if (location.pathname.includes("about")) {
    $(".header-about").addClass("active");
  } else if (location.pathname.includes("crops")) {
    $(".header-crops").addClass("active");
  } else if (location.pathname.includes("orders")) {
    $(".header-orders").addClass("active");
  }
});
