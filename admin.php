<?php
// Include config file
require_once "server/connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // if (file_exists($target_file)) {
  //   echo "Sorry, file already exists.";
  //   $uploadOk = 0;
  // }
  
  // Check file size
  if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    echo($_FILES["image"]["tmp_name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $name = $_POST["name"];
      $water = $_POST["water"];  
      $protein = $_POST["protein"];
      $carbs = $_POST["carbs"];
      $sugar = $_POST["sugar"];
      $fiber = $_POST["fiber"];
      $fat = $_POST["fat"];
      $sql = "INSERT INTO crops (image, name, water, protein, carbs, sugar, fiber, fat)
        VALUES ( '$target_file', '$name', $water, $protein, $carbs, $sugar, $fiber, $fat)";
      mysqli_query($link, $sql);
      header("Location: admin.php");
      exit;   
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
} else {
  $sql = "SELECT * FROM crops ORDER BY id DESC";
  $result = mysqli_query($link, $sql);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/admin.css" />
    <title>Home</title>
  </head>
  <body>
    <?php include ('header.php');?>

    <div class="container">
      <button class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Crop</button>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">water</th>
            <th scope="col">protein</th>
            <th scope="col">carbs</th>
            <th scope="col">sugar</th>
            <th scope="col">fiber</th>
            <th scope="col">fat</th>
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
                  <td style="text-align: center">
                    <button class="btn btn-primary btn-edit mr-2" value="<?php echo $row['id'] ?>" data-toggle="modal" data-target="#editModal">Edit</button>
                    <button class="btn btn-danger btn-remove" value="<?php echo $row['id'] ?>">Remove</button></td>
                </tr><?php $id++; }
            }
            mysqli_close($link);
          ?>
        </tbody>
      </table>

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Add Crop</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">              
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="image" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Water</label>
                      <input type="number" step="0.01" name="water" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Protein</label>
                      <input type="number" step="0.01" name="protein" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Carbs</label>
                      <input type="number" step="0.01" name="carbs" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Sugar</label>
                      <input type="number" step="0.01" name="sugar" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Fiber</label>
                      <input type="number" step="0.01" name="fiber" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Fat</label>
                      <input type="number" step="0.01" name="fat" class="form-control" required>
                    </div>
                  </div>
                </div>              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalLabel">Edit Crop</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">              
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Water</label>
                    <input type="number" step="0.01" name="water" id="water" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Protein</label>
                    <input type="number" step="0.01" name="protein" id="protein" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Carbs</label>
                    <input type="number" step="0.01" name="carbs" id="carbs" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Sugar</label>
                    <input type="number" step="0.01" name="sugar" id="sugar" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Fiber</label>
                    <input type="number" step="0.01" name="fiber" id="fiber" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Fat</label>
                    <input type="number" step="0.01" name="fat" id="fat" class="form-control" required>
                    <input type="hidden" name="id" id="id">
                  </div>
                </div>
              </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-upload">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <?php include ('footer.php');?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/header.js"></script>
    <script src="assets/js/admin.js"></script>
  </body>
</html>