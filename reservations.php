<?php
include('db_connect.php' );
session_start();
//$userID = 1;
$userID = $_SESSION['userID'];

//Get reservations, garages, payments and vehicle infos
$sqlUpcoming = "SELECT * FROM reservations WHERE reservation_status = 'Upcoming' AND user_id = '$userID'";
$upcomingResult = mysqli_query($conn, $sqlUpcoming);
$upcomingReservations = mysqli_fetch_all($upcomingResult, MYSQLI_ASSOC);

$sqlOngoing = "SELECT * FROM reservations WHERE reservation_status = 'Ongoing' AND user_id = '$userID'";
$ongoingResult = mysqli_query($conn, $sqlOngoing);
$ongoingReservations = mysqli_fetch_all($ongoingResult, MYSQLI_ASSOC);

$sqlPast = "SELECT * FROM reservations WHERE reservation_status = 'Finished' AND user_id = '$userID' OR reservation_status = 'Canceled' AND user_id = '$userID'";
$pastResult = mysqli_query($conn, $sqlPast);
$pastReservations = mysqli_fetch_all($pastResult, MYSQLI_ASSOC);

$garage = "SELECT * FROM garages";
$garageResult = mysqli_query($conn, $garage);
$garages = mysqli_fetch_all($garageResult, MYSQLI_ASSOC);

$payment = "SELECT payment_id, card_number FROM payments p Where p.user_id = $userID";
$paymentResult = mysqli_query($conn, $payment);
$payments = mysqli_fetch_all($paymentResult, MYSQLI_ASSOC);

$vehicle = "SELECT * FROM vehicles Where vehicles.user_id = '$userID'";
$vehicleResult = mysqli_query($conn, $vehicle);
$vehicles = mysqli_fetch_all($vehicleResult, MYSQLI_ASSOC);

mysqli_free_result($vehicleResult);
mysqli_free_result($garageResult);
mysqli_free_result($paymentResult);
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

		<script src="js/javaScript.js"></script>
		<link rel="stylesheet" href="css/styles.css">
    <link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
		<title>Reservation Records</title>

		<style>
		#btn1{
			padding: 8px;
			width:200px;
			border: 1px solid #083c5c;
			background-color: #083c5c;
			color:white;
			font-size: 15px;
			border-radius: 5px;
		}
		#btn2, #btn3{
			padding: 8px;
			width:200px;
			border: 1px solid #083c5c;
			color:#083c5c;
			background-color: white;
			font-size: 15px;
			border-radius: 5px;
		}
		table button{
			border-radius: 5px;
			border: 1px solid #083c5c;
			background-color: #083c5c;
			color:white;

		}

	</style>
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
		        <a class="nav-link" href="home.php">Home</a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="reservations.php">Reservations <span class="sr-only">(current)</span></a>
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

					<h3 class="display-5">Reservation Records: </h3>


          <div class="btnList" style="display:inline;">
            <button type="button" id="btn1" onclick='show(1);'>Ongoing Reservations</button>
            <button type="button" id="btn2" onclick='show(2);'>Upcoming Reservations</button>
            <button type="button" id="btn3" onclick='show(3);'>Past Reservations</button>
          </div>
          <br /><br />

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
                <td><?php echo $ongoingReservation['reservation_id']?></td>
                <td><?php echo $ongoingReservation['arrival_time']. ", " . $ongoingReservation['arrival_date']?></td>
                <td><?php echo $ongoingReservation['exit_time']. ", " . $ongoingReservation['exit_date']?></td>
                <td><?php echo $ongoingReservation['reservation_status']?></td>
                <td><button type="button" data-bs-toggle="modal" data-bs-target="#detail-modal" data-whatever=<?php echo json_encode($ongoingReservation);
                ?>>Details</button></td>
              </tr>
              <?php }?>
            </tbody>

          </table>

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
                  <td><?php echo $upcomingReservation['reservation_id']?></td>
                  <td><?php echo $upcomingReservation['arrival_time']. ", " . $upcomingReservation['arrival_date']?></td>
                  <td><?php echo $upcomingReservation['exit_time']. ", " . $upcomingReservation['exit_date']?></td>
                  <td><?php echo $upcomingReservation['reservation_status']?></td>
                  <td><button type="button" data-bs-toggle="modal" data-bs-target="#detail-modal" data-whatever=<?php echo json_encode($upcomingReservation);?>>Details</button></td>
                </tr>
                <?php }?>
              </tbody>
            </table>

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
                    <td><?php echo $pastReservation['reservation_id']?></td>
                    <td><?php echo $pastReservation['arrival_time']. ", " . $pastReservation['arrival_date']?></td>
                    <td><?php echo $pastReservation['exit_time']. ", " . $pastReservation['exit_date']?></td>
                    <td><?php echo $pastReservation['reservation_status']?></td>
                    <td><button type="button" data-bs-toggle="modal" data-bs-target="#detail-modal" data-whatever=<?php echo json_encode($pastReservation);
                ?>>Details</button></td>
                  </tr>
                  <?php }?>
                </tbody>

              </table>

              </br>


              <script>

              function show(n) {
									document.getElementById("btn1").style.backgroundColor="white";
									document.getElementById("btn2").style.backgroundColor="white";
									document.getElementById("btn3").style.backgroundColor="white";
									document.getElementById("btn1").style.color="#083c5c";
									document.getElementById("btn2").style.color="#083c5c";
									document.getElementById("btn3").style.color="#083c5c";
									document.getElementById("btn"+n).style.backgroundColor="#083c5c";
									document.getElementById("btn"+n).style.color="white";
                  document.getElementById("table1").style.display="none";
                  document.getElementById("table2").style.display="none";
                  document.getElementById("table3").style.display="none";
                  document.getElementById("table"+n).style.display="table";

              };


              </script>

    <!-- Modal -->
    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="DetailModalLabel">Reservation Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <table class="reservation_details">
              <thead>
                <tr>
                  <th scope="col">Garage Name</th>
                  <th scope="col">Garage Location</th>
                  <th scope="col">Start Time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Vehicle Model</th>
                  <th scope="col">Vehicle Plate</th>
                  <th scope="col">Vehicle Color</th>
                  <th scope="col">Payment Info</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <td id="garageN"></td>
                <td id="garageD"></td>
                <td id="timeS"></td>
                <td id="timeE"></td>
                <td id="vehicleM"></td>
                <td id="vehicleP"></td>
                <td id="vehicleC"></td>
                <td id="paymentNum"></td>
              </tr>
            </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="cancel" onclick="cancelFunction()" style="display:none;">Cancel Reservation</button>
            <button type="button" class="btn btn-primary" id="extend" onclick="extendFunction()">Extend Reservation</button>
          </div>
        </div>
      </div>

      <?php
      $json_garage = json_encode($garages);
      $json_payment = json_encode($payments);
      $json_vehicle = json_encode($vehicles);
      echo "<script>
      var garagesD = $json_garage;
      var paymentM = $json_payment;
      var vehicles = $json_vehicle;
      </script>"?>
      <script>
          //functions for modal
        $('#detail-modal').on('show.bs.modal', function (event) {
          //change the modal table use the data passed from data-whatever
          var button = $(event.relatedTarget)
          var record = button.data('whatever')
          var modal = $(this)
          var vehicle = vehicles[record['vehicle_id']-1];
          var payment = paymentM[record['payment_id']-1];
          var garage1 = garagesD[record['garage_id']];
          console.log(record['reservation_status']);

          var rid = record['reservation_id'];
          if(record['reservation_status']=="Upcoming"){
            document.getElementById("cancel").style.display ="Block";
            document.getElementById("extend").style.display ="none";
          } else if(record['reservation_status']=="Finished"||record['reservation_status']=="Cancelled"){
            document.getElementById("extend").style.display ="none";
            document.getElementById("cancel").style.display ="none";
          } else if(record['reservation_status']=="Ongoing"){
            document.getElementById("extend").style.display ="Block";
            document.getElementById("cancel").style.display ="none";
          }
          modal.find('.modal-title').text('Reservation Details: ' + record['reservation_id'])
          modal.find('.modal-body #garageN').text(garage1['garage_name'])
          modal.find('.modal-body #garageD').text(garage1['garage_location'])
          modal.find('.modal-body #timeS').text(record['arrival_time']+", "+record['arrival_date'])
          modal.find('.modal-body #timeE').text(record['exit_time']+", "+record['exit_date'])
          modal.find('.modal-body #vehicleM').text(vehicle['brand'])
          modal.find('.modal-body #vehicleP').text(vehicle['plate_number']+", "+ vehicle['state'])
          modal.find('.modal-body #vehicleC').text(vehicle['color'])
          modal.find('.modal-body #paymentNum').text(payment['card_number'])
        })
      </script>

      <script>
        //function for cancal redirect
        function cancelFunction(){
          if(confirm("Do you want to cancel this order?")){
              //$_SESSION['reservation_change'] = record['reservation_id'];
              alert("Reservation cancal Sucessfully!");
            <?php
              include('db_connect.php' );
              $sqlCancel = "UPDATE reservations SET reservation_status = 'Cancelled' WHERE reservation_id = 'rid'";
              $upcomingResult = mysqli_query($conn, $sqlUpcoming);
              mysqli_close($conn);
            ?>


            location.reload();
          } else {

          }

        }

        function extendFunction(){
          if(confirm("Do you want to cancel this order?")){
            location.href="extendPage.php";
          }
        }
      </script>





    </div>


		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>
