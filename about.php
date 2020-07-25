<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/about.css" />
    <title>About</title>
  </head>
  <body>
    <?php include ('header.php');?>

    <div class="container">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">About The Farm</h5>
          <p class="card-text">Come visit our farm for local produce and educational tours!</p>
        </div>
        <div class="card-body">
          <h5 class="card-title">Address</h5>
          <img class="card-img-top" src="assets/images/home.png" alt="Card image cap">
          <p class="card-text">12358 W Main Street</p>
          <p class="card-text">Sunnyville, FL 32650</p>
        </div>
        <div class="card-body">
          <h5 class="card-title">Farm hours</h5>
          <p class="card-text">Monday – Friday 9:00 AM-5:00 PM</p>
          <p class="card-text">Saturday 8:00 AM- 8:00 PM</p>
          <p class="card-text">Sunday 8:00AM – 6:00 PM</p>
        </div>
        <div class="card-body">
          <h5 class="card-title">Farm Status</h5>
          <p class="card-text" id="farm-status"></p>
        </div>   
      </div>
    </div>

    <?php include ('footer.php');?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/header.js"></script>
    <script src="assets/js/about.js"></script>
  </body>
</html>