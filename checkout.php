<?php
include('db_connect.php');
if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM garages WHERE garage_id = $id";
  $result = mysqli_query($conn, $sql);
  $garage = mysqli_fetch_assoc($result);
  //print_r($garage);

  //Leo
  $sql_payments = "SELECT * FROM payments;";
  $result_payments = mysqli_query($conn, $sql_payments);
  $sql_vehicles = "SELECT * FROM vehicles;";
  $result_vehicles = mysqli_query($conn, $sql_vehicles);


  session_start();
  $totalTimeHour = $_SESSION['totalTimeHour'];
  $price = $garage['hourly_price'] * $totalTimeHour;
  //echo $price;

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
        <p>Garage: <?php echo $garage['garage_name'] ?> <a href="garageList.php">edit</a></p>
      </div>
      <br />
      <span class="close">&times;</span>
      <hr>
      <p>Vehicle infomation</p>

      <div class="container">
        <form action="insert.php" id="paymentForm" class="needs-validation" method="POST" novalidate>
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
                Add vehicle
              </button>
            </p>

          </div>
          <div class="collapse" id="vehicleOption">
            <div class="card card-body">
              <div class="form-group row">
                <div class="col">
                  <label for="mModel">Make & Model: </label>
                  <input type="text" id="mModel" name="mModel" class="form-control" placeholder="Example: Honda Civic" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in your vehicle brand and model.
                  </div>
                </div>
                <div class="col">
                  <label for="vColor">Color: </label>
                  <input type="text" id="vColor" name="vColor" class="form-control" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in your vehicle color.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label for="lPlate">License Plate:</label>
                  <input type="text" id="lPlate" name="licensePlate" class="form-control" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in your license plate number.
                  </div>
                </div>
                <div class="col">
                  <label for="lPlate">State:</label>
                  <input type="text" id="state" name="licensePlateState" class="form-control" required>
                  <div class="valid-feedback"></div>
                  <div class="invalid-feedback">
                    Please fill in the state of your license.
                  </div>
                </div>
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
                Add payment
              </button>
            </p>
            <div class="collapse" id="paymentMethod">
              <div class="card card-body">
                <div class="form-group row">
                  <div class="col">
                    <label for="cName">Cardholder Name: </label>
                    <input type="text" id="cName" name="cardName" class="form-control" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in cardholder name.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col">
                    <label for="cNum">Card Number: </label>
                    <input type="text" id="cNum" name="cardNum" class="form-control" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the card number.
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col">
                    <label for="eDate">Expiration Date: </label>
                    <input type="text" id="eDate" name="expireDate" class="form-control" placeholder="MM/YY" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the card expiration date.
                    </div>
                  </div>
                  <div class="col">
                    <label for="lPlate">CVV/CVC:</label>
                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="3 digits" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the CVV.
                    </div>
                  </div>
                  <div class="col">
                    <label for="lPlate">Zip Code:</label>
                    <input type="text" id="zip" name="zip" class="form-control" placeholder="5 digits" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">
                      Please fill in the zip code.
                    </div>
                  </div>



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
            <button class="btn btn-primary" type="submit" value="Add new info">Add new info</button>
          </div>
          <br>
          <div class="homeButton">
            <a id="orderButton" class="btn btn-primary" >Place Order</a>
          </div>
        </form>
      </div>

    </div>


		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>
