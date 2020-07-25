<?php
  require_once "connection.php";
  if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
  }
  else {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
  }
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