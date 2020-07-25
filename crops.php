<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/crops.css" />
    <title>Crops</title>
  </head>
  <body>
    <?php include ('header.php');
    // Include config file
    require_once "server/connection.php";
    $sql = "SELECT * FROM crops ORDER BY id DESC";
    $result = mysqli_query($link, $sql);
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $id = $_POST['id'];
      $sql="SELECT * FROM crops WHERE id=$id ORDER BY id DESC";  
      $prod_result = mysqli_query($link, $sql);
    
      if(mysqli_num_rows($prod_result) > 0) {
        while($row = mysqli_fetch_assoc($prod_result)) {
          $prod_sql = "SELECT id FROM orders WHERE name='" . $row['name'] . "'";
          $exist = mysqli_query($link, $prod_sql);
          if (mysqli_num_rows($exist) === 0) {
            $user_id = $_SESSION['id'];
            $order_image = $row['image'];
            $order_name = $row['name'];
            $order_water = $row['water'];
            $order_protein = $row['protein'];
            $order_carbs = $row['carbs'];
            $order_sugar = $row['sugar'];
            $order_fiber = $row['fiber'];
            $order_fat = $row['fat'];
            $order_sql="INSERT INTO orders (user_id, image, name, water, protein, carbs, sugar, fiber, fat, quantity)
              VALUES ($user_id, '" .$order_image. "', '" .$order_name. "', $order_water, $order_protein, $order_carbs, $order_sugar, $order_fiber, $order_fat, 1)";
            echo($order_sql);
            mysqli_query($link, $order_sql);
            header("Location: crops.php");
            exit;
          } else {
            header("Location: crops.php");
            exit;
          }    
        }
      }
    }
    ?>

    <div class="container">
      <div class="row">
        <h1>Our Crops</h1>
        <p>
          Here at Farm we produce a great variety of fresh organic vegetables, delicious juicy fruits, and rich and creamy dairy and eggs.
          Below, you can find all of the products we grow and produce in our farm.
        </p>
        <?php
          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {?>
              <div class="col-md-4">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="card">                  
                    <img class="card-img-top" src=<?php echo $row['image'];?> alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['name']; ?></h5>
                      <p class="card-text">Water: <span><?php echo $row['water']; ?> grams</span></p>
                      <p class="card-text">Protein: <span><?php echo $row['protein']; ?> grams</span></p>
                      <p class="card-text">Carbs: <span><?php echo $row['carbs']; ?> grams</span></p>
                      <p class="card-text">Sugar: <span><?php echo $row['sugar']; ?> grams</span></p>
                      <p class="card-text">Fiber: <span><?php echo $row['fiber']; ?> grams</span></p>
                      <p class="card-text">Fat: <span><?php echo $row['fat']; ?> grams</span></p>
                    </div>
                    <input type="hidden" name="id" value=<?php echo $row['id'] ?> />
                    <button type="submit" class="btn btn-primary card-btn">Add to cart</button>                  
                  </div>
                </form>
              </div>
            <?php }
          }
          mysqli_close($link);
        ?>
      </div>
    </div>

    <?php include ('footer.php');?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/header.js"></script>
  </body>
</html>