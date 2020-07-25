<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/orders.css" />
    <title>Home</title>
  </head>
  <body>
    <?php include ('header.php');
    // Include config file
    require_once "server/connection.php";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      echo('DFDFDFDFDF');
    } else {
      $user_id = $_SESSION["id"];
      $sql = "SELECT * FROM orders WHERE user_id=$user_id ORDER BY id DESC";
      $result = mysqli_query($link, $sql);
    }
    
    ?>

    <div class="container">
      <table class="table table-responsive">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th style="text-align: center" scope="col">image</th>
            <th style="text-align: center" scope="col">name</th>
            <th style="text-align: center" scope="col">water</th>
            <th style="text-align: center" scope="col">protein</th>
            <th style="text-align: center" scope="col">carbs</th>
            <th style="text-align: center" scope="col">sugar</th>
            <th style="text-align: center" scope="col">fiber</th>
            <th style="text-align: center" scope="col">fat</th>
            <th style="text-align: center" scope="col">quantity</th>
            <th style="text-align: center" scope="col">action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(mysqli_num_rows($result) > 0) {
              $id = 1;
              while($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><img class="row-img" src =<?php echo $row['image'];?> /></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['water']; ?> %</td>
                  <td><?php echo $row['protein']; ?> grams</td>
                  <td><?php echo $row['carbs']; ?> grams</td>
                  <td><?php echo $row['sugar']; ?> grams</td>
                  <td><?php echo $row['fiber']; ?> grams</td>
                  <td><?php echo $row['fat']; ?> grams</td>
                  <td style="text-align: center"><?php echo $row['quantity']; ?></td>
                  <td style="text-align: center">
                    <button class="btn btn-primary btn-plus mr-2" value="<?php echo $row['id'] ?>">+</button>
                    <button class="btn btn-primary btn-minuse mr-2" value="<?php echo $row['id'] ?>">-</button>
                    <button class="btn btn-danger btn-remove" value="<?php echo $row['id'] ?>">Remove</button>
                  </td>
                </tr>              
              <?php $id++; }
            }
            mysqli_close($link);
          ?>
        </tbody>
      </table>

    </div>

    <?php include ('footer.php');?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/header.js"></script>
    <script src="assets/js/orders.js"></script>
  </body>
</html>