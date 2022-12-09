<?php
session_start();
include "utilities/db_connect.php";
//Get car info
// $sql = "SELECT * FROM vehicles WHERE 'user_id'= '$_SESSION[userID]';  ";
$sql="SELECT * FROM `vehicles` WHERE `user_id`='$_SESSION[userID]';";
$result = mysqli_query($conn, $sql);
$cars = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')</script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>


  <script src="js/javaScript.js"></script>
  <link rel="stylesheet" href="css/styles.css">

  <title>Your car information</title>
  <style>
  .btn1{
    padding: 8px;
    width:150px;
    border: 1px solid #083c5c;
    background-color: #083c5c;
    color:white;
    font-size: 15px;
    border-radius: 5px;
  }
  </style>
  <body>
    <header>
      <div>
        <div class="container-fluid">
          <div style="float:right;margin:20px">
            <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="logout.php">Log out</a>
          </div>
          <h3><img src="images/gw_logo.png" alt="GW Logo" width="80" height="60" style="float:left">Parking System</h3>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reservations.php">Reservations</a>
          </li>

        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact Us</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              My Account
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="password.php">Update Password</a>
              <a class="dropdown-item" href="payment_info.php">My Payments</a>
              <a class="dropdown-item  active" href="car_info.php">My Vehicles</a>
            </div>
          </li>

        </ul>
      </div>
    </nav>

    <div class="pt-4">
        <div class="container">
          <h3>Your Car Info</h3>
          <hr />

          <?php foreach ($cars as $car) { ?>


            <div>
              <label style="font-weight: bold"><?php echo $car['plate_number']; ?>
                -
                <?php echo $car['state']; ?></label>
              <br />
              <label style="font-weight: bold">Brand & Model:
                <?php echo $car['brand']; ?></label>
              <br />
              <button type="button" class="btn btn-primary" onclick="location.href='car_info_update.php?id=<?php echo $car['vehicle_id'] ?>'">Update</button>
              <button type="button" class="btn btn-danger" onclick="location.href='car_info_delete.php?id=<?php echo $car['vehicle_id'] ?>'">Delete</button>
              <hr>
            <?php } ?>

            <button type="button" class="btn1" onclick="location.href='car_info_add.php'">Add vehicle</button>




            <div class="footer">
                <p>6210 Group A</p>
            </div>
    </body>
</html>
