<?php
include('db_connect.php');
if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM garages WHERE garage_id = $id";
  $result = mysqli_query($conn, $sql);
  $garage = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  mysqli_close($conn);
  print_r($garage);

  session_start();
  echo $_SESSION['price'];
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
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

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
      <p>Garage: <?php echo $garage['garage_name'] ?></p>
      <a href="garageList.php">edit</a>
    </div>
      <br />
      <span class="close">&times;</span>
      <hr>
      <p>Vehicle infomation</p>
      <div class="container">
        <form id="paymentForm" class="needs-validation" novalidate>
          <div class="form-group row">
            <div class="col">
              <label for="mModel">Make & Model: </label>
              <input type="text" id="mModel" name="mModel" class="form-control" placeholder="Example: Honda Civic" required>
              <div class="valid-feedback"></div>
              <div class="invalid-feedback">
                Please fill in your vehicle brand and model.
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
          <br />

          <hr />
          <p>Payment Method</p>
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

          <div class="homeButton">
            <a id="orderButton" class="btn btn-primary">Place Order</a>
          </div>
        </form>
      </div>

    </div>


		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>
