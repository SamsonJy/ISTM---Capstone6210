<?php
session_start();
include('utilities/db_connect.php');

$totalTimeHour = $_SESSION['totalTimeHour'];
$userID = $_SESSION['userID'];
$startDate = $_SESSION['startDate'];
$startTime = $_SESSION['startTime'];
$endDate = $_SESSION['endDate'];
$endTime = $_SESSION['endTime'];

if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM garages WHERE garage_id = $id";
  $result = mysqli_query($conn, $sql);
  $garage = mysqli_fetch_assoc($result);
  $_SESSION['garageID'] = $garage['garage_id'];
  $_SESSION['price'] = $garage['hourly_price'] * $totalTimeHour;
  $_SESSION['garageLocation'] = $garage['garage_location'];
  $_SESSION['garage'] = $garage['garage_name'];
}
$price = $_SESSION['price'];


//Leo
$sql_payments = "SELECT * FROM payments WHERE user_id = $userID";
$result_payments = mysqli_query($conn, $sql_payments);
$sql_vehicles = "SELECT * FROM vehicles WHERE user_id = $userID";
$result_vehicles = mysqli_query($conn, $sql_vehicles);




//INSERT
if(isset($_POST['submit'])){
  // if(isset($_POST['saveVehicleInfo'])){
  //   $brand = mysqli_real_escape_string($conn, $_POST['vModel']);
  //   $color = mysqli_real_escape_string($conn, $_POST['vColor']);
  //   $plate_number = mysqli_real_escape_string($conn, $_POST['lPlate']);
  //   $state = mysqli_real_escape_string($conn, $_POST['state']);
  //   $sql_vehicle = "INSERT INTO vehicles(brand, color, plate_number, state, user_id) VALUES ('$brand', '$color', '$plate_number', '$state', '$userID')";
  //   mysqli_query($conn, $sql_vehicle);
  // }
  // if(isset($_POST['savePaymentInfo'])){
  //   $cardholder_name = mysqli_real_escape_string($conn, $_POST['cardName']);
  //   $card_number = mysqli_real_escape_string($conn, $_POST['cardNum']);
  //   $cvv0 = mysqli_real_escape_string($conn, $_POST['cvv']);
  //   $cvv = md5($cvv0);
  //   $expiration_date = mysqli_real_escape_string($conn, $_POST['expireDate']);
  //   $zip_code = mysqli_real_escape_string($conn, $_POST['zip']);
  //   $sql_payment = "INSERT INTO payments(cardholder_name, card_number, cvv, expiration_date, zip_code, user_id) VALUES ('$cardholder_name', '$card_number', '$cvv', '$expiration_date', '$zip_code', '$userID')";
  //   mysqli_query($conn, $sql_payment);
  //
  // }
//TBF
  // $sql_vehicleID = "SELECT vehicle_id FROM vehicles WHERE plate_number = '$plate_number' AND state = '$state'";
  // $vehicleResult = mysqli_query($conn, $sql_vehicleID);
  // $theVehicle = mysqli_fetch_assoc($vehicleResult);
  // $_SESSION['vehicleID'] = $theVehicle['vehicle_id'];
  //
  //
  // $sql_paymentID = "SELECT payment_id FROM payments WHERE card_number = '$card_number' AND cvv = '$cvv'";
  // $paymentResult = mysqli_query($conn, $sql_paymentID);
  // $thePayment = mysqli_fetch_assoc($paymentResult);
  // $_SESSION['paymentID'] = $thePayment['payment_id'];
// test condition 2
  $garageID = $_SESSION['garageID'];
  if (isset($_POST['cardChoice'])) {
    if (isset($_POST['vehicleChoice'])) {
      // first situation, select stored card and vehicle
      $vehicleID = $_POST['vehicleChoice'];
      $paymentID = $_POST['cardChoice'];
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', '$paymentID')";

    } elseif (isset($_POST['saveVehicleInfo'])) {
      // second situation, select stored card and save new vehicle
      // save new vehicle
      $brand = mysqli_real_escape_string($conn, $_POST['vModel']);
      $color = mysqli_real_escape_string($conn, $_POST['vColor']);
      $plate_number = mysqli_real_escape_string($conn, $_POST['lPlate']);
      $state = mysqli_real_escape_string($conn, $_POST['state']);
      $sql_vehicle = "INSERT INTO vehicles(brand, color, plate_number, state, user_id) VALUES ('$brand', '$color', '$plate_number', '$state', '$userID')";
      mysqli_query($conn, $sql_vehicle);

      // retrieve vehicle ID
      $sql_vehicleID = "SELECT vehicle_id FROM vehicles WHERE plate_number = '$plate_number' AND state = '$state'";
      $vehicleResult = mysqli_query($conn, $sql_vehicleID);
      $theVehicle = mysqli_fetch_assoc($vehicleResult);
      $_SESSION['vehicleID'] = $theVehicle['vehicle_id'];

      $vehicleID = $_SESSION['vehicleID'];
      $paymentID = $_POST['cardChoice'];
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', '$paymentID')";
    } else {
      // third situation, selected stored card and no need to store vehicle
      $paymentID = $_POST['cardChoice'];
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', NULL, '$paymentID')";
    }

  } elseif (isset($_POST['savePaymentInfo'])) {
    // save new card
    $cardholder_name = mysqli_real_escape_string($conn, $_POST['cardName']);
    $card_number = mysqli_real_escape_string($conn, $_POST['cardNum']);
    $cvv0 = mysqli_real_escape_string($conn, $_POST['cvv']);
    $cvv = md5($cvv0);
    $expiration_date = mysqli_real_escape_string($conn, $_POST['expireDate']);
    $zip_code = mysqli_real_escape_string($conn, $_POST['zip']);
    $sql_payment = "INSERT INTO payments(cardholder_name, card_number, cvv, expiration_date, zip_code, user_id) VALUES ('$cardholder_name', '$card_number', '$cvv', '$expiration_date', '$zip_code', '$userID')";
    mysqli_query($conn, $sql_payment);

    //retrieve card idea
    $sql_paymentID = "SELECT payment_id FROM payments WHERE card_number = '$card_number' AND cvv = '$cvv'";
    $paymentResult = mysqli_query($conn, $sql_paymentID);
    $thePayment = mysqli_fetch_assoc($paymentResult);
    $_SESSION['paymentID'] = $thePayment['payment_id'];

    if (isset($_POST['vehicleChoice'])) {
      // fourth situation, save card info and select stored vehicle
      $vehicleID = $_POST['vehicleChoice'];
      $paymentID = $_SESSION['paymentID'];
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', '$paymentID')";
    } elseif (isset($_POST['saveVehicleInfo'])) {
      //fifth situation, save card info and save vehicle info
      // save new vehicle
      $brand = mysqli_real_escape_string($conn, $_POST['vModel']);
      $color = mysqli_real_escape_string($conn, $_POST['vColor']);
      $plate_number = mysqli_real_escape_string($conn, $_POST['lPlate']);
      $state = mysqli_real_escape_string($conn, $_POST['state']);
      $sql_vehicle = "INSERT INTO vehicles(brand, color, plate_number, state, user_id) VALUES ('$brand', '$color', '$plate_number', '$state', '$userID')";
      mysqli_query($conn, $sql_vehicle);

      // retrieve vehicle ID
      $sql_vehicleID = "SELECT vehicle_id FROM vehicles WHERE plate_number = '$plate_number' AND state = '$state'";
      $vehicleResult = mysqli_query($conn, $sql_vehicleID);
      $theVehicle = mysqli_fetch_assoc($vehicleResult);
      $_SESSION['vehicleID'] = $theVehicle['vehicle_id'];

      $vehicleID = $_SESSION['vehicleID'];
      $paymentID = $_SESSION['paymentID'];
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', '$paymentID')";
    } else {
      // sixth situation, save card info and no need to save vehicle info
      // $vehicleID = NULL;
      $paymentID = $_SESSION['paymentID'];
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', NULL, '$paymentID')";
    }
  } else {
    if (isset($_POST['vehicleChoice'])) {
      // seventh situation, no need to save card info and select saved vehicle
      $vehicleID = $_POST['vehicleChoice'];
      // $paymentID = NULL;
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', NULL)";
    } elseif (isset($_POST['saveVehicleInfo'])) {
      // eighth situation, no need to save card and save new vehicle
      // save new vehicle
      $brand = mysqli_real_escape_string($conn, $_POST['vModel']);
      $color = mysqli_real_escape_string($conn, $_POST['vColor']);
      $plate_number = mysqli_real_escape_string($conn, $_POST['lPlate']);
      $state = mysqli_real_escape_string($conn, $_POST['state']);
      $sql_vehicle = "INSERT INTO vehicles(brand, color, plate_number, state, user_id) VALUES ('$brand', '$color', '$plate_number', '$state', '$userID')";
      mysqli_query($conn, $sql_vehicle);

      // retrieve vehicle ID
      $sql_vehicleID = "SELECT vehicle_id FROM vehicles WHERE plate_number = '$plate_number' AND state = '$state'";
      $vehicleResult = mysqli_query($conn, $sql_vehicleID);
      $theVehicle = mysqli_fetch_assoc($vehicleResult);
      $_SESSION['vehicleID'] = $theVehicle['vehicle_id'];

      $vehicleID = $_SESSION['vehicleID'];
      // $paymentID = NULL;
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', NULL)";
    } else {
      // no need to save vehicle and card
      // $vehicleID = NULL;
      // $paymentID = NULL;
      $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', NULL, NULL)";
    }
  }
  mysqli_query($conn, $sql_reservation);
  header('Location: confirmation.php');
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

		<!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>


		<script src="js/javaScript.js"></script>
    <link rel="stylesheet" href="css/styles.css">

		<title>Parking Details</title>
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
			<div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="home.php">Home</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="utilities/reservations.php">Reservations</a>
		      </li>

		    </ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="contact.html">Contact Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">My Account</a>
					</li>
				</ul>
		  </div>
		</nav>

    <div class="modal-content">

      <div class=container>
        <p>Garage: <?php echo $garage['garage_name'] ?> <a href="garageList.php">Edit</a></p>
      </div>
      <br />

      <hr>
      <p>Vehicle infomation</p>

      <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="paymentForm" class="needs-validation" method="POST" novalidate>
          <div class="form-group row">
            <div class="col vehicle" id="vehicleSelected">
              <?php
              while ($row = mysqli_fetch_assoc($result_vehicles)){
                echo "<input type='radio' name='vehicleChoice' value=" . $row['vehicle_id'] . "> ";
                echo $row['plate_number'] . "  " . $row['brand']  ;
                echo "<br />";
              }
               ?>
            </div>
          </div>

          <div class="addVehicle">
            <p>
              <button id="newVehicle" class="btn btn-primary hide-in" type="button" data-toggle="collapse" data-target="#vehicleOption" aria-expanded="false" aria-controls="vehicle_collapse">
                New vehicle
              </button>
            </p>

          </div>
          <div class="collapse" id="vehicleOption">
            <div class="card card-body">
              <div class="form-group row">
                <div class="col">
                  <label for="vModel">Make & Model: </label>
                  <input type="text"  name="vModel" class="form-control" placeholder="Example: Honda Civic" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in your vehicle brand and model.
                  </div>
                </div>
                <div class="col">
                  <label for="vColor">Color: </label>
                  <input type="text" name="vColor" class="form-control" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in your vehicle color.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label for="lPlate">License Plate:</label>
                  <input type="text" name="lPlate" class="form-control" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in your license plate number.
                  </div>
                </div>
                <div class="col">
                  <label for="state">State:</label>
                  <input type="text" name="state" class="form-control" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in the state of your license.
                  </div>
                </div>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="saveVehicleInfo">
                <label class="form-check-label" for="exampleCheck1">Save Vehicle Info</label>
              </div>

            </div>
          </div>


          <br />

          <hr />
          <p>Payment Method</p>

          <div class="form-group row">
            <div class="col payment" id="paymentSelected">
              <?php
              while ($row = mysqli_fetch_assoc($result_payments)){
                echo "<input type='radio' name='cardChoice' value=" . $row['payment_id'] . ">    ";
                echo "Ending in ";
                $lastFourDigi = substr($row["card_number"], -4);
                echo $lastFourDigi;
                echo "<br />";
              }
               ?>
            </div>
          </div>
          <div class="addPayment">
            <p>
              <button id="newPayment" class="btn btn-primary hide-in" type="button" data-toggle="collapse" data-target="#paymentMethod" aria-expanded="false" aria-controls="payment_collapse" >
                New payment
              </button>
            </p>
            <div class="collapse" id="paymentMethod">
              <div class="card card-body">
                <div class="form-group row">
                  <div class="col">
                    <label for="cardName">Cardholder Name: </label>
                    <input type="text"  name="cardName" class="form-control" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in cardholder name.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col">
                    <label for="cardNum">Card Number: </label>
                    <input type="text" name="cardNum" class="form-control" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the card number.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col">
                    <label for="expireDate">Expiration Date: </label>
                    <input type="text" name="expireDate" class="form-control" placeholder="MM/YY" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the card expiration date.
                    </div>
                  </div>
                  <div class="col">
                    <label for="cvv">CVV/CVC:</label>
                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="3 digits" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the CVV.
                    </div>
                  </div>
                  <div class="col">
                    <label for="zip">Zip Code:</label>
                    <input type="text" id="zip" name="zip" class="form-control" placeholder="5 digits" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the zip code.
                    </div>
                  </div>



                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="savePaymentInfo">
                  <label class="form-check-label" for="exampleCheck1">Save Payment Info</label>
                </div>

              </div>
            </div>
          </div>

          <br />
          <hr>
          <div class="container">
            <div class="float-right">Total: $<?php echo $price; ?></div>
          </div>
          <br>
          <br>

          <div class="homeButton">
            <input type="submit" name="submit" value="Place Order" class="btn btn-primary">
          </div>
        </form>
      </div>

    </div>
    <br />


		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
  <script type="text/javascript">
    // vehicle disabled
    var new_vehicle = document.getElementById("newVehicle");
    new_vehicle.addEventListener("click", toggleDisabledVehicle);
    function toggleDisabledVehicle(){
      var showToggleV = document.querySelectorAll(".vehicle input[type='radio']");
      var vehicle_showV = document.getElementById("vehicleOption");
      for (var i = 0; i < showToggleV.length; i++) {
        if (vehicle_showV.classList.contains("show")) {
          showToggleV[i].disabled = false;
        } else {
          showToggleV[i].disabled = true;
        }
      }
    }

    // payment disabled
    var new_payment = document.getElementById("newPayment");
    new_payment.addEventListener("click", toggleDisabledPayment);
    function toggleDisabledPayment(){
      var showToggleP = document.querySelectorAll(".payment input[type='radio']");
      var vehicle_showP = document.getElementById("paymentMethod");
      for (var i = 0; i < showToggleP.length; i++) {
        if (vehicle_showP.classList.contains("show")) {
          showToggleP[i].disabled = false;
        } else {
          showToggleP[i].disabled = true;
        }
      }
    }


  // if (vehicle_show.classList.contains("show")) {
  //   var showToggle = document.querySelectorAll(".vehicle input[type='radio']");
  //   for (var i = 0; i < showToggle.length; i++) {
  //     showToggle[i].disabled = true;
  //   }
  // }

  </script>
</html>
