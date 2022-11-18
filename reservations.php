<?php
include('db_connect.php' );
session_start();
$userID = $_SESSION['userID'];

//Get reservationss
$sqlUpcoming = "SELECT * FROM reservations WHERE reservation_status = 'Upcoming' AND user_id = '$userID'";
$upcomingResult = mysqli_query($conn, $sqlUpcoming);
$upcomingReservations = mysqli_fetch_all($upcomingResult, MYSQLI_ASSOC);

$sqlOngoing = "SELECT * FROM reservations WHERE reservation_status = 'Ongoing' AND user_id = '$userID'";
$ongoingResult = mysqli_query($conn, $sqlOngoing);
$ongoingReservations = mysqli_fetch_all($ongoingResult, MYSQLI_ASSOC);

$sqlPast = "SELECT * FROM reservations WHERE reservation_status = 'Finished' AND user_id = '$userID' OR reservation_status = 'Canceled' AND user_id = '$userID'";
$pastResult = mysqli_query($conn, $sqlPast);
$pastReservations = mysqli_fetch_all($pastResult, MYSQLI_ASSOC);
mysqli_free_result($upcomingResult);
mysqli_free_result($ongoingResult);
mysqli_free_result($pastResult);
mysqli_close($conn);





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

		<title>Reservation Records</title>
	</head>

	<body>
		<header>
			<div>
				<div class="container-fluid">
					<div>
						<h3 class="display-4">GW Parking System</h3>
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
					<a class="nav-link" href="home.php">Home</a>
          <a class="nav-link active" href="reservations.php" >Reservations</a>
					<a class="nav-link" href="contact.html">Contact Us</a>
				</div>
			</div>
		</nav>



		<div class="pt-4">
			<div class="container">

					<h3 class="display-5">Reservation Records: </h3>

          <div style="display:inline;">
            <button type="button" onclick='show(1);'>Ongoing Reservations</button>
            <button type="button" onclick='show(2);'>Upcoming Reservations</button>
            <button type="button" onclick='show(3);'>Past Reservations</button>
          </div>
          </br></br>


          <table class="table" id="table1">
            <thead>
              <tr>
                <th scope="col">Order#</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($ongoingReservations as $ongoingReservation){?>
              <tr>
                <th scope="row"><?php echo $ongoingReservation['reservation_id']?></th>
                <td><?php echo $ongoingReservation['arrival_time']. ", " . $ongoingReservation['arrival_date']?></td>
                <td><?php echo $ongoingReservation['exit_time']. ", " . $ongoingReservation['exit_date']?></td>
                <td><?php echo $ongoingReservation['reservation_status']?></td>
                <td><input type="button" name="detailBtn" value="Details" onClick="location.href='reservationDetails.php?id=<?php echo $ongoingReservation['reservation_id'] ?>'"></td>
              </tr>
              <?php }?>
            </tbody>

          </table>

            </br>



            <table class="table" id="table2">
              <thead>
                <tr>
                  <th scope="col">Order#</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach($upcomingReservations as $upcomingReservation){?>
                <tr>
                  <th scope="row"><?php echo $upcomingReservation['reservation_id']?></th>
                  <td><?php echo $upcomingReservation['arrival_time']. ", " . $upcomingReservation['arrival_date']?></td>
                  <td><?php echo $upcomingReservation['exit_time']. ", " . $upcomingReservation['exit_date']?></td>
                  <td><?php echo $upcomingReservation['reservation_status']?></td>
                  <td><input type="button" name="detailBtn" value="Details" onClick="location.href='reservationDetails.php?id=<?php echo $upcomingReservation['reservation_id'] ?>'"></td>
                </tr>
                <?php }?>
              </tbody>
            </table>

              </br>


              <table class="table" id="table3">
                <thead>
                  <tr>
                    <th scope="col">Order#</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach($pastReservations as $pastReservation){?>
                  <tr>
                    <th scope="row"><?php echo $pastReservation['reservation_id']?></th>
                    <td><?php echo $pastReservation['arrival_time']. ", " . $pastReservation['arrival_date']?></td>
                    <td><?php echo $pastReservation['exit_time']. ", " . $pastReservation['exit_date']?></td>
                    <td><?php echo $pastReservation['reservation_status']?></td>
                    <td><input type="button" name="detailBtn" value="Details" onClick="location.href='reservationDetails.php?id=<?php echo $pastReservation['reservation_id'] ?>'"></td>
                  </tr>
                  <?php }?>
                </tbody>

              </table>

              </br>

              <script>
              function show(n) {
                  document.getElementById("table1").style.display="none";
                  document.getElementById("table2").style.display="none";
                  document.getElementById("table3").style.display="none";
                  document.getElementById("table"+n).style.display="block";
      
              };


              </script>


		<!--<div class="footer">
			<p>6210 Group A</p>
		</div>-->
	</body>
</html>
