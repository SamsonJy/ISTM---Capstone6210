<?php
include('utilities/db_connect.php' );

//Get garages
$sql = 'SELECT garage_id, garage_name, garage_location, image_url, hourly_price FROM garages ORDER BY hourly_price';
$result = mysqli_query($conn, $sql);
$garages = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

session_start();
$startDateString = $_SESSION['startDate'];
$startTimeString = $_SESSION['startTime'];
$endDateString = $_SESSION['endDate'];
$endTimeString = $_SESSION['endTime'];

$date1 = explode('-', $startDateString);
$date2 = explode('-', $endDateString);
$time1 = explode(':', $startTimeString);
$time2 = explode(':', $endTimeString);

$startDate = (int)$date1[0] . $date1[1]. $date1[2];
$endDate = (int)$date2[0] . $date2[1] . $date2[2];
$startTimeHour = (int)$time1[0];
$endTimeHour = (int)$time2[0];


$pDate = $endDate - $startDate;
if ($endTimeHour >= $startTimeHour) {
	$pTime = $endTimeHour - $startTimeHour;
	$totalTimeHour = $pDate * 24 + $pTime;
}else {
	$pTime = $startTimeHour - $endTimeHour;
	$totalTimeHour = $pDate * 24 - $pTime;
}

$_SESSION['totalTimeHour'] = 	$totalTimeHour;





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
	        <div style="float:right;margin:20px">
	          <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="logout.php">Log out</a>
	        </div>
	        <h3 class="display-4">GW Parking System</h3>
	      </div>
	  </header>

		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="collapse navbar-collapse" id="navbarNav">
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
					<li class="nav-item">
						<a class="nav-link" href="#">My Account</a>
					</li>
				</ul>
		  </div>
		</nav>


		<div class="pt-4">
			<div class="container">
				<div id="garageName">
					<h3 class="display-5">Select the parking garage: </h3>
				</div>
				<hr />
				<a href="home.php">← Back to the Previous Page</a>

				<?php foreach($garages as $garage){
					$price = $garage['hourly_price'] * $totalTimeHour;?>
					<div class="row">
							<div class="col">
								<div class="post-container">
									<div class="post-thumb"><?php echo '<img src="'.htmlspecialchars($garage['image_url']) . '"/>'?></div>
									<div class="post-content">
										<h4 class="post-title"><?php echo htmlspecialchars($garage['garage_name'])?><span style="float:right; padding-right:10px;"><?php echo "$" . htmlspecialchars($price)  ?></span></h4>
										<p><?php echo htmlspecialchars($garage['garage_location'])?></p>
									  </br>
										<input type="submit" name="search" value="Search" class="btn btn-primary" onClick="location.href='checkout.php?id=<?php echo htmlspecialchars($garage['garage_id']) ?>'">


									</div>
								</div>
							</div>
						</div>
					</br>
				<?php }?>

<!--

		<div id="myModal" class="modal">

			<div class="modal-content">
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
		</div>


		<script>
			document.getElementById("randomNum1").innerHTML = "<p>" + "<span>" + "Available Spaces: " + "</span>" + Math.floor(Math.random() * 101) + "</p>";
			document.getElementById("randomNum2").innerHTML = "<p>" + "<span>" + "Available Spaces: " + "</span>" + Math.floor(Math.random() * 21) + "</p>";
			document.getElementById("randomNum3").innerHTML = "<p>" + "<span>" + "Available Spaces: " + "</span>" + Math.floor(Math.random() * 21) + "</p>";

			document.getElementById('fButton').addEventListener("click", function () {
				localStorage.setItem("spaceType", "Standard Space");
			});

			document.getElementById('sButton').addEventListener("click", function () {
				localStorage.setItem("spaceType", "XL Space");
			});

			document.getElementById('tButton').addEventListener("click", function () {
				localStorage.setItem("spaceType", "Accessible Space");
			});


			/*document.getElementById("garageName").innerHTML = localStorage.getItem("garage");*/
			var modal = document.getElementById("myModal");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks on the button, open the modal
			function OpenModel() {
				modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function () {
				modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function (event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			};

			$("#orderButton").click(function () {

				var form = $("#paymentForm")

				if (form[0].checkValidity() === false) {
					event.preventDefault()
					event.stopPropagation()
				}
				form.addClass('was-validated');
				if (form[0].checkValidity() === true) {
					location.href = 'confirmation.html'
				}
			});



		</script>
-->
		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>
