<?php
  require_once "connection.php";
  $sql = $_POST['sql'];
  $result = mysqli_query($link, $sql);
  $arr = explode(' ',trim($sql));
  if ($arr[0] == "UPDATE") {
    if ($result) {
        $selectData = "Success";
    } else {
        $selectData = "Error";
    }
  } else {
    $selectData = "Success";
  } 

  mysqli_close($link);
  echo json_encode($selectData);
?>