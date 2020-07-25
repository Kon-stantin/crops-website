<?php
// Initialize the session
session_start();
$auth = true;
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $auth = false;
    // header("location: login.php");
    // exit;
}
?>

<link rel="stylesheet" href="assets/css/header.css" />

<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="/">
    Happy Home Farms
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">        
    <form class="form-inline mr-auto mt-2 mt-lg-0">
    <?php if ($_SESSION && $_SESSION['role'] === 'admin') { ?>
      <a class="nav-link" style="color: white" href="admin.php">admin</a>
    <?php } ?>
      
    </form>
    <ul class="navbar-nav my-2 my-lg-0">
      <li class="header-home nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="header-about nav-item">
        <a class="nav-link" href="/about.php">About</a>
      </li>
      <?php
        if ($auth === true) {
          ?>
          <li class="header-crops nav-item">
            <a class="nav-link" href="/crops.php">Crops</a>
          </li>      
          <li class="header-orders nav-item">
            <a class="nav-link" href="/orders.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign Out</a>
          </li>
          <?php
        } else {
          ?>
          <li class="header-crops nav-item">
            <a class="nav-link" href="login.php">Sign In</a>
          </li>
          <?php
        }
      ?>            
    </ul>
  </div>
</nav>