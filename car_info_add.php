<?php
session_start();

if (isset($_POST['SubmitButton'])) {
    include "utilities/db_connect.php";
    $car_model = $_REQUEST['car_model'];
    $car_plate = $_REQUEST['car_plate'];
    $car_state = $_REQUEST['car_state'];


    $sql = ("INSERT INTO `vehicles` (`vehicle_id`, `brand`, `plate_number`, `state`,`user_id`)
VALUES (NULL, '$car_model', '$car_plate', '$car_state', '$_SESSION[userID]');");

    mysqli_query($conn, $sql);
    header('location:car_info.php');
}
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

        .btn2 {
          padding: 8px;
          width:150px;
          border: 1px solid #083c5c;
          color:#083c5c;
          background-color: white;
          font-size: 15px;
          border-radius: 5px;
        }
        </style>
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
                <h3 class="display-5">Add Vehicle</h3>
                <hr/>
                <a href="car_info.php">← Back to the Previous Page</a>
                <br/><br/>
                <form action="#" method='POST'>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Make & Model</label>
                        <input type="text" class="form-control" name="car_model" id="car_model" aria-describedby="emailHelp">

                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Color</label>
                        <input type="text" class="form-control" name="car_color" id="car_color" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">License Plate</label>
                        <input type="text" class="form-control" name="car_plate" id="car_plate">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">State</label>
                        <input type="text" class="form-control" name="car_state" id="car_state">
                    </div>
                    <br/>
                    <div class="text-center">
                    <button type="submit" name='SubmitButton' class="btn1" onclick="return altercheck()">Submit</button>
                    <button type="reset" class="btn2">Reset</button>
                  </div>
                </form>
            </div>

        </div>

    <div class="footer">
    <p>6210 Group A</p>
</div>

</body>
</html>
