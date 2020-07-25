$(document).ready(function () {
  $(".btn-plus").click(function () {
    var id = $(this).val();
    var quantity = $(this).parent().prev().text();
    quantity = parseInt(quantity) + 1;
    var sql =
      "UPDATE orders SET quantity=" + quantity.toString() + " WHERE id =" + id;
    var url = "/server/orders-ajax.php";

    $.ajax({
      method: "POST",
      url: url,
      dataType: "json",
      data: {
        sql: sql,
      },
      success: function (res) {
        location.reload();
      },
      error: function (err) {
        console.error(err);
      },
    });
  });
  $(".btn-minuse").click(function () {
    var id = $(this).val();
    var quantity = $(this).parent().prev().text();
    quantity = parseInt(quantity) - 1;
    if (quantity < 0) quantity = 0;
    var sql =
      "UPDATE orders SET quantity=" + quantity.toString() + " WHERE id =" + id;
    var url = "/server/orders-ajax.php";

    $.ajax({
      method: "POST",
      url: url,
      dataType: "json",
      data: {
        sql: sql,
      },
      success: function (res) {
        location.reload();
      },
      error: function (err) {
        console.error(err);
      },
    });
  });
  $(".btn-remove").click(function () {
    var id = $(this).val();
    var quantity = $(this).parent().prev().text();
    quantity = parseInt(quantity) - 1;
    if (quantity < 0) quantity = 0;
    var sql = "DELETE FROM orders WHERE id =" + id;
    var url = "/server/orders-ajax.php";

    $.ajax({
      method: "POST",
      url: url,
      dataType: "json",
      data: {
        sql: sql,
      },
      success: function (res) {
        location.reload();
      },
      error: function (err) {
        console.error(err);
      },
    });
  });
});
