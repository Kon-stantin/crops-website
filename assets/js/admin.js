$(document).ready(function () {
  $(".btn-edit").click(function () {
    var id = $(this).val();
    var name = $(this).parent().parent().children().eq(2).text();
    var water = parseFloat(
      $(this).parent().parent().children().eq(3).text().split(" ")[0]
    );
    var protein = parseFloat(
      $(this).parent().parent().children().eq(4).text().split(" ")[0]
    );
    var carbs = parseFloat(
      $(this).parent().parent().children().eq(5).text().split(" ")[0]
    );
    var sugar = parseFloat(
      $(this).parent().parent().children().eq(6).text().split(" ")[0]
    );
    var fiber = parseFloat(
      $(this).parent().parent().children().eq(7).text().split(" ")[0]
    );
    var fat = parseFloat(
      $(this).parent().parent().children().eq(8).text().split(" ")[0]
    );
    $("#id").val(id);
    $("#name").val(name);
    $("#water").val(water);
    $("#protein").val(protein);
    $("#carbs").val(carbs);
    $("#sugar").val(sugar);
    $("#fiber").val(fiber);
    $("#fat").val(fat);
  });

  $(".btn-upload").click(function () {
    var url = "/server/admin-ajax.php";
    var id = $("#id").val();
    var name = $("#name").val();
    var water = $("#water").val();
    var protein = $("#protein").val();
    var carbs = $("#carbs").val();
    var sugar = $("#sugar").val();
    var fiber = $("#fiber").val();
    var fat = $("#fat").val();
    var sql = "";

    if ($("#image")[0].value === "") {
      sql =
        "UPDATE crops SET name='" +
        name +
        "', water=" +
        water +
        ", protein=" +
        protein +
        ", carbs=" +
        carbs +
        ", sugar=" +
        sugar +
        ", fiber=" +
        fiber +
        ", fat=" +
        fat +
        " WHERE id=" +
        id;
    } else {
      var image = $("#image").prop("files")[0];
      var form_data = new FormData();
      form_data.append("file", image);
      console.log(image.name);
      sql =
        "UPDATE crops SET image='uploads/" +
        image.name +
        "', name='" +
        name +
        "', water=" +
        water +
        ", protein=" +
        protein +
        ", carbs=" +
        carbs +
        ", sugar=" +
        sugar +
        ", fiber=" +
        fiber +
        ", fat=" +
        fat +
        " WHERE id=" +
        id;

      $.ajax({
        url: url, // point to server-side PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        success: function (php_script_response) {
          alert(php_script_response); // display response from the PHP script, if any
        },
      });
    }
    // $.ajax({
    //   method: "POST",
    //   url: url,
    //   dataType: "json",
    //   data: {
    //     sql: sql,
    //   },
    //   success: function (res) {
    //     location.reload();
    //   },
    //   error: function (err) {
    //     console.error(err);
    //   },
    // });
  });

  $(".btn-remove").click(function () {
    var id = $(this).val();
    var quantity = $(this).parent().prev().text();
    quantity = parseInt(quantity) - 1;
    if (quantity < 0) quantity = 0;
    var sql = "DELETE FROM crops WHERE id =" + id;
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
