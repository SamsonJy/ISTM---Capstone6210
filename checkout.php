<?php
session_start();
include('db_connect.php');

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
  if(isset($_POST['saveVehicleInfo'])){
    $brand = mysqli_real_escape_string($conn, $_POST['vModel']);
    $color = mysqli_real_escape_string($conn, $_POST['vColor']);
    $plate_number = mysqli_real_escape_string($conn, $_POST['lPlate']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $sql_vehicle = "INSERT INTO vehicles(brand, color, plate_number, state, user_id) VALUES ('$brand', '$color', '$plate_number', '$state', '$userID')";
    mysqli_query($conn, $sql_vehicle);
  }
  if(isset($_POST['savePaymentInfo'])){
    $cardholder_name = mysqli_real_escape_string($conn, $_POST['cardName']);
    $card_number = mysqli_real_escape_string($conn, $_POST['cardNum']);
    $cvv0 = mysqli_real_escape_string($conn, $_POST['cvv']);
    $cvv = md5($cvv0);
    $expiration_date = mysqli_real_escape_string($conn, $_POST['expireDate']);
    $zip_code = mysqli_real_escape_string($conn, $_POST['zip']);
    $sql_payment = "INSERT INTO payments(cardholder_name, card_number, cvv, expiration_date, zip_code, user_id) VALUES ('$cardholder_name', '$card_number', '$cvv', '$expiration_date', '$zip_code', '$userID')";
    mysqli_query($conn, $sql_payment);

  }
//TBF
  $sql_vehicleID = "SELECT vehicle_id FROM vehicles WHERE plate_number = '$plate_number' AND state = '$state'";
  $vehicleResult = mysqli_query($conn, $sql_vehicleID);
  $theVehicle = mysqli_fetch_assoc($vehicleResult);
  $_SESSION['vehicleID'] = $theVehicle['vehicle_id'];
  $sql_paymentID = "SELECT payment_id FROM payments WHERE card_number = '$card_number' AND cvv = '$cvv'";
  $paymentResult = mysqli_query($conn, $sql_paymentID);
  $thePayment = mysqli_fetch_assoc($paymentResult);
  $_SESSION['paymentID'] = $thePayment['payment_id'];

  $garageID = $_SESSION['garageID'];
  $vehicleID = $_SESSION['vehicleID'];
  $paymentID = $_SESSION['paymentID'];
  $sql_reservation = "INSERT INTO reservations(arrival_date, arrival_time, exit_date, exit_time, total_charge, reservation_status, duration_in_hours, user_id, garage_id, vehicle_id, payment_id) VALUES ('$startDate', '$startTime', '$endDate', '$endTime', '$price', 'Upcoming', '$totalTimeHour', '$userID', '$garageID', '$vehicleID', '$paymentID')";
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
		<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
		<script>window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')</script>

		<!-- Latest compiled JavaScript -->
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

		<script src="js/javaScript.js"></script>
    <link rel="stylesheet" href="css/styles.css">

		<title>Parking Details</title>
	</head>

	<body>
		<header>
			<div>
				<div class="container-fluid">
					<div>
						<h3 class="display-4">GWU Parking System</h3>
					</div>
				</div>

			</div>
		</header>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-link active" href="home.php">Home</a>
					<a class="nav-link" href="contact.html">Contact Us</a>
				</div>
			</div>
		</nav>

    <div class="modal-content">

      <div class=container>
        <p>Garage: <?php echo $garage['garage_name'] ?> <a href="garageList.php">Edit</a></p>
      </div>
      <br />
      <span class="close">&times;</span>
      <hr>
      <p>Vehicle infomation</p>

      <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="paymentForm" class="needs-validation" method="POST" novalidate>
          <div class="form-group row">
            <div class="col">
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
              <button class="btn btn-primary hide-in" type="button" data-toggle="collapse" data-target="#vehicleOption" aria-expanded="false" aria-controls="vehicle_collapse">
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
            <div class="col">
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
              <button class="btn btn-primary hide-in" type="button" data-toggle="collapse" data-target="#paymentMethod" aria-expanded="false" aria-controls="payment_collapse" >
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


		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>