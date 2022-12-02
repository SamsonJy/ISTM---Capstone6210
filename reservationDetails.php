<?php
include('utilities/db_connect.php' );

session_start();
if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT reservations.reservation_id, reservations.arrival_time , reservations.arrival_date, reservations.exit_time, reservations.exit_date,
                 reservations.total_charge, reservations.reservation_status, reservations.duration_in_hours, garages.garage_name, garages.garage_location,
                 vehicles.brand, vehicles.plate_number, vehicles.state
          FROM reservations
          JOIN garages
          ON reservations.garage_id = garages.garage_id
          JOIN vehicles
          ON reservations.vehicle_id = vehicles.vehicle_id
          WHERE reservation_id = $id";
  $result = mysqli_query($conn, $sql);
  $reservation = mysqli_fetch_assoc($result);
  $_SESSION['reservationID'] = $reservation['reservation_id'];
  $_SESSION['arrivalTime'] = $reservation['arrival_time'] . ", " . $reservation['arrival_date'];
  $_SESSION['exitTime'] = $reservation['exit_time'] . ", " . $reservation['exit_date'];
  $_SESSION['totalCharge'] = $reservation['total_charge'];
  $_SESSION['status'] = $reservation['reservation_status'];
  $_SESSION['duration'] = $reservation['duration_in_hours'];
  $_SESSION['garage'] = $reservation['garage_name'];
  $_SESSION['location'] = $reservation['garage_location'];
  $_SESSION['vehicle'] = $reservation['brand'] . ", " . $reservation['plate_number'] . "-" . $reservation['state'];
  mysqli_free_result($result);
  mysqli_close($conn);
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

		<title>Reservation Details</title>
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
            <div>
              <h3 class="display-5">Reservation Details</h3>
            </div>
            <hr />
            <a href="reservations.php">← Back to the Previous Page</a>
          </br></br>
          <div class="jumbotron pt-3">
              <div class="row">
                  <div class="col">
                      <h5 class="display-5"><span>Reservation # </span><?php echo htmlspecialchars($_SESSION['reservationID']) ?></h5>
                  </div>
              </div>

              <div class="row">
                    <div class="col py-1"> <span class="d-block text-muted">Rerservation Status: </span> <span><?php echo htmlspecialchars($_SESSION['status'])?></span> </div>
              </div>

              <div class="row py-1">
                      <div class="col-4 py-1"> <span class="d-block text-muted">From: </span> <span><?php echo htmlspecialchars($_SESSION['arrivalTime'])?></span> </div>
                      <div class="col-4 py-1"> <span class="d-block text-muted">To: </span> <span><?php echo htmlspecialchars($_SESSION['exitTime'])?></span> </div>
                      <div class="col-4 py-1"> <span class="d-block text-muted">Duration: </span> <span><?php echo htmlspecialchars($_SESSION['duration'])?> hrs</span> </div>

              </div>

              <div class="row">
                      <div class="col-4 py-1"> <span class="d-block text-muted">Garage: </span> <span><?php echo htmlspecialchars($_SESSION['garage'])?></span> </div>
                      <div class="col-4 py-1"> <span class="d-block text-muted">Location: </span> <span><?php echo htmlspecialchars($_SESSION['location'])?></span> </div>
              </div>

              <div class="row py-1">
                      <div class="col-4 py-1"> <span class="d-block text-muted">Vehicle: </span> <span><?php echo htmlspecialchars($_SESSION['vehicle'])?></span> </div>
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
              Having trouble? <a href="contact.html">Contact Us</a>
            </p>
            <?php
            if($_SESSION['status'] == "Ongoing") {?>
              <a href="#" class="btn btn-primary">Extend</a>
            <?php } else if($_SESSION['status'] == "Upcoming"){ ?>
              <a href="#" class="btn btn-primary">Modify</a>
              <a href="#" class="btn">Cancel</a>
            <?php }

             ?>

          </div>
        </br></br>
        </div>
      </div>
      <br />

      <div class="footer">
          <p>6210 Group A</p>
      </div>
  </body>
</html>
