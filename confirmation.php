<?php
session_start();

$garageID = $_SESSION['garageID'];
$price = $_SESSION['price'];
$startDateString = $_SESSION['startDate'];
$startTimeString = $_SESSION['startTime'];
$endDateString = $_SESSION['endDate'];
$endTimeString = $_SESSION['endTime'];
$garage = $_SESSION['garage'];
$location = $_SESSION['garageLocation'];

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

    <title>Confirmation Page</title>
</head>

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

    <div class="pt-4">
        <div class="container">
            <div>
                <h3 class="display-5">Thank you for your reservation</h3>
            </div>

            <hr />

            <div class="jumbotron p-3">
                <div class="row">
                    <div class="col">
                        <h5 id="confirmNum" class="display-5"><span>Confirmation # </span><?php echo htmlspecialchars($garageID) ?></h5>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-md">
                        <div id="garage" class="py-1"> <span class="d-block text-muted">Garage: </span> <span><?php echo htmlspecialchars($garage)?></span> </div>
                        <div id="startDateTime" class="py-1"> <span class="d-block text-muted">From: </span> <span><?php echo htmlspecialchars($startTimeString) . "  " . htmlspecialchars($startDateString)?></span> </div>

                    </div>
                    <div class="col-md">
                        <div id="location" class="py-1"> <span class="d-block text-muted">Location: </span> <span><?php echo htmlspecialchars($location)?></span> </div>
                        <div id="endDateTime" class="py-1"> <span class="d-block text-muted">To: </span> <span><?php echo htmlspecialchars($endTimeString) . " " . htmlspecialchars($endDateString)?></span> </div>
                    </div>
                    <div class="col"></div>

                </div>
                  <hr />
                  <div class="row">
                      <div class="col">
                          <h5 class="display-5"><span>Garage Access Code: </span></h5>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col"></div>
                    <div class="col py-1"> <img src="images/qrcode.png" alt="QR Code" style="  display: block;margin-left: auto;margin-right: auto;height: 200px;width:200px;"> </div>
                    <div class="col"></div>
                  </div>
                </div>

            <hr />

            <div class="text-center">
                <p>
                    Having trouble? <a href="contact.html">Contact us</a>
                </p>
                <a href="home.php" style="background-color: #083c5c;" class="btn btn-primary">Continue to Homepage</a>
            </div>



        </div>

    </div>
    <br />




    <div class="footer">
        <p>6210 Group A</p>
    </div>
</body>
</html>
