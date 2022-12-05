<?php
session_start();
include "db_connect.php";
$id = $_REQUEST['id'];
$sql="SELECT `brand` FROM `vehicles` WHERE `vehicle_id`= '$id' ";
$sql2="SELECT `plate_number` FROM `vehicles` WHERE `vehicle_id`= '$id' ";
$sql3="SELECT `state` FROM `vehicles` WHERE `vehicle_id`= '$id' ";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$car_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
$car_plate = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$car_state = mysqli_fetch_array($result3, MYSQLI_ASSOC);
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
                <a class="dropdown-item" href="car_info.php">My Vehicles</a>
              </div>
            </li>

          </ul>
        </div>
      </nav>
  <script>
    function altercheck() {
      var make = document.getElementById("car_model").value;
      var plate = document.getElementById("car_plate").value;
      var state = document.getElementById("car_state").value;

      if (make.length == 0) {
        alert("Your car model is empty! Please check.")
        return false;
      }

      if (plate.length == 0) {
        alert("Your car plate number is empty! Please check.")
        return false;
      }


      if (state.length == 0) {
        alert("Your car plate state is empty! Please check.")
        return false;
      }

    }
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<?php
if (isset($_POST['submitcar'])) {

  // include "db_connect.php";

  $car_model = $_REQUEST['car_model'];
  $car_plate = $_REQUEST['car_plate'];
  $car_state = $_REQUEST['car_state'];


  $sql = ("UPDATE `vehicles` SET
`brand` = '$car_model',
`plate_number` = '$car_plate',
`state` = '$car_state'
 WHERE `vehicles`.`vehicle_id` = '$id';");

  mysqli_query($conn, $sql);
  mysqli_close($conn);
  header('location: ../car_info.php');
}

?>

<body>


  <div class="pt-4">
    <div class="container">
    <h3 class="display-5">Please enter your new car information. </h3>
  <hr>
  <a href="../car_info.php">← Back to the Previous Page</a>
  <hr>
  <form action="#" method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Make & Model</label>
      <input type="text" class="form-control" name="car_model" value="<?php echo implode(" ",$car_info) ?>" id="car_model" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">License Plate</label>
      <input type="text" class="form-control" name="car_plate" id="car_plate" value="<?php echo implode(" ",$car_plate) ?>">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">State</label>
      <input type="text" class="form-control" name="car_state" id="car_state" value="<?php echo implode(" ",$car_state) ?>">
    </div>
    <button type="submit" name="submitcar" class="btn btn-primary" onclick="return  altercheck()">Submit</button>

  </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
<div class="footer">
        <p>6210 Group A</p>
    </div>
</html>
