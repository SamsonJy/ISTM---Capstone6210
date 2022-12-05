<?php
session_start();

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
    <link rel="stylesheet" href="/css/styles.css">

    <title>Yout payment information</title>
    <script>
        function altercheck() {
            var name = document.getElementById("card_name").value;
            var number = document.getElementById("card_number").value;
            var date = document.getElementById("card_date").value;
            var cvv = document.getElementById("card_cvv").value;
            var zip = document.getElementById("card_zip").value;
            if (name.length == 0) {
                alert("Your cardholder name is empty! Please check.")
                return false;
            }

            if (number.length == 0) {
                alert("Your card number is empty! Please check.")
                return false;
            }


            if (date.length == 0) {
                alert("Your card date is empty! Please check.")
                return false;
            }
            if (cvv.length == 0) {
                alert("Your card cvv is empty! Please check.")
                return false;
            }
            if (zip.length == 0) {
                alert("Your card zip code is empty! Please check.")
                return false;
            }

        }
    </script>

<?php

if (isset($_POST['SubmitButton'])) {
    include "db_connect.php";
    $card_name = $_REQUEST['card_name'];
    $card_number = $_REQUEST['card_number'];
    $card_date = $_REQUEST['card_date'];
    $card_cvv = $_REQUEST['card_cvv'];
    $card_zip = $_REQUEST['card_zip'];

    $card_cvv = md5($card_cvv);
    // $sql=("INSERT INTO `payments` (`payment_id`,`cardholder_name`, `card_number`, `cvv`, `expiration_date`,`zip_code`,`user_id`)
    // VALUES ( NULL,'$card_name', '$card_number', '$card_cvv','$card_date','$card_zip, '$_SESSION[userID]');");
    $sql = ("INSERT INTO payments(payment_id,cardholder_name,card_number,cvv,expiration_date,zip_code,user_id) VALUES
        (NULL,'$card_name','$card_number','$card_cvv','$card_date','$card_zip','$_SESSION[userID]');");

    mysqli_query($conn, $sql);
    header('location:../payment_info.php');
}
?>

<body>
  <header>
    <div>
      <div class="container-fluid">
        <div style="float:right;margin:20px">
          <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="logout.php">Log out</a>
        </div>
        <h3><img src="/images/gw_logo.png" alt="GW Logo" width="80" height="60" style="float:left">Parking System</h3>
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

    <body>

    <div class="pt-4">
                <div class="container">

        <h3 class="display-5">Please enter your new payment information. </h3>
                    <hr/>
                    <a href="../payment_info.php">← Back to the Previous Page</a>
                    <hr/>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cardholder Name</label>
                <input type="text" class="form-control" name="card_name" id="card_name" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Card Number</label>
                <input type="text" class="form-control" name="card_number" id="card_number">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Expiration Date</label>
                <input type="text" class="form-control" name="card_date" id="card_date">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">CVV</label>
                <input type="text" class="form-control" name="card_cvv" id="card_cvv">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Zip Code</label>
                <input type="text" class="form-control" name="card_zip" id="card_zip">
            </div>
            <button type="submit" name="SubmitButton" class="btn btn-primary" onclick="return altercheck()">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
                </div>
    </div>

    </body>
    <div class="footer">
        <p>6210 Group A</p>
    </div>
</html>
