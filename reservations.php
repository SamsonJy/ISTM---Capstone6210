<?php
include('db_connect.php' );
session_start();
//$userID = $_SESSION['userID'];
$userID = 1;
//cancel process
if(isset($_POST["reservationId"])){
  $_SEESION['reservationId'] = $_POST['reservationId'];
  $ridc = $_SEESION['reservationId'];
  $sqlCancel = "UPDATE `reservations` SET `reservation_status` = 'Cancelled' WHERE `reservations`.`reservation_id` = $ridc";
  mysqli_query($conn,$sqlCancel);
  $_POST["reservationId"]=null;
  header("Refresh:0");
}
//extend process
// if(isset($_POST["reservationId2"])){
//   $ridE = $_POST['reservationId2'];
//   $startDateString = $_POST['startDate2'];
//   $endDateString = $_POST['startTime2'];
//   $startTimeString = $_POST['endDate2'];
//   $endTimeString = $_POST['endTime2'];

//   $date1 = explode('-', $startDateString);
//   $date2 = explode('-', $endDateString);
//   $time1 = explode(':', $startTimeString);
//   $time2 = explode(':', $endTimeString);

//   $startDate = (int)$date1[0] . $date1[1]. $date1[2];
//   $endDate = (int)$date2[0] . $date2[1] . $date2[2];
//   $startTimeHour = (int)$time1[0];
//   $endTimeHour = (int)$time2[0];
//   $totalTimeHour = 0;
//   $pDate = $endDate - $startDate;
//   if ($endTimeHour >= $startTimeHour) {
//     $pTime = $endTimeHour - $startTimeHour;
//     $totalTimeHour = $pDate * 24 + $pTime;
//   }else {
//     $pTime = $startTimeHour - $endTimeHour;
//     $totalTimeHour = $pDate * 24 - $pTime;
//   }
//   echo $totalTimeHour;
//   $sqlextend = "UPDATE `reservations` SET `exit_date` = $_SEESION['endDate2'], `exit_time` = $_SEESION['endTime2'], `duration_in_hours`=$totalTimeHour WHERE `reservations`.`reservation_id` = $ridE";
//   mysqli_query($conn,$sqlextend);
//   $_POST["reservationId2"]=null;
//   header("Refresh:0");
// }
//Get reservations, garages, payments and vehicle infos
$sqlUpcoming = "SELECT * FROM reservations WHERE reservation_status = 'Upcoming' AND user_id = '$userID'";
$upcomingResult = mysqli_query($conn, $sqlUpcoming);
$upcomingReservations = mysqli_fetch_all($upcomingResult, MYSQLI_ASSOC);

$sqlOngoing = "SELECT * FROM reservations WHERE reservation_status = 'Ongoing' AND user_id = '$userID'";
$ongoingResult = mysqli_query($conn, $sqlOngoing);
$ongoingReservations = mysqli_fetch_all($ongoingResult, MYSQLI_ASSOC);

$sqlPast = "SELECT * FROM reservations WHERE reservation_status = 'Finished' AND user_id = '$userID' OR reservation_status = 'Cancelled' AND user_id = '$userID'";
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

		<script src="js/javaScript.js"></script>
    <script type="text/javascript" src="js/qrcode.js"></script>
		<link rel="stylesheet" href="css/styles.css">
    <link href="../css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
		<title>Reservation Records</title>
    <script> $(document).ready(function(){
				$('input.timepicker').timepicker({
					timeFormat: 'H:mm ',
					interval: 60,
					dynamic: false,
					dropdown: true,
					scrollbar: true,
					minTime:'7:00am',
					maxTime: '11:00pm',
					change: checkDate2,
          zindex: 9999999
				});
		});</script>
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
          </br>


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
                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail-modal" data-whatever=<?php echo json_encode($ongoingReservation); 
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
                  <th scope="row"><?php echo $upcomingReservation['reservation_id']?></th>
                  <td><?php echo $upcomingReservation['arrival_time']. ", " . $upcomingReservation['arrival_date']?></td>
                  <td><?php echo $upcomingReservation['exit_time']. ", " . $upcomingReservation['exit_date']?></td>
                  <td><?php echo $upcomingReservation['reservation_status']?></td>
                  <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail-modal" data-whatever=<?php echo json_encode($upcomingReservation);?>>Details</button></td>
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
                    <th scope="row"><?php echo $pastReservation['reservation_id']?></th>
                    <td><?php echo $pastReservation['arrival_time']. ", " . $pastReservation['arrival_date']?></td>
                    <td><?php echo $pastReservation['exit_time']. ", " . $pastReservation['exit_date']?></td>
                    <td><?php echo $pastReservation['reservation_status']?></td>
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail-modal" data-whatever=<?php echo json_encode($pastReservation); 
                ?>>Details</button></td>
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

    <!-- Modal -->
    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="DetailModalLabel">Reservation Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
          <div class=" p-0 jumbotron " id="reservation_cancel_form"  >
			  <div class="container-fluid">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="cancelForm" class="needs-validation" novalidate>
              <div class="row">
                <div class="form-group col"  style="display:none;">
                <input type="text" id="reservationId" class="form-control" name="reservationId">
                </div>
                <div class="col-12 col-md-4">
                  <label for="garageName">Garage Name:</label>
                  <p id="garageN"></p>
                </div>
                <div class="col-6 col-md-4">
                  <label for="garageLocation">Garage Location:</label>
                  <p id="garageD"></p>
                </div>
            </div>
              <div class="row">
                <div class="col-12 col-md-4">
                  <label for="timeS">Start Time:</label>
                  <p id="timeS"></p>
                </div>
                <div class="col-6 col-md-4">
                  <label for="timeE">End Time:</label>
                  <p id="timeE"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4">
                  <label for="vehicleM">Vehicle Model:</label>
                  <p id="vehicleM"></p>
                </div>
                <div class="col-6 col-md-2">
                  <label for="vehicleP">Vehicle Plate:</label>
                  <p id="vehicleP"></p>
                </div>
                <div class="col-6 col-md-4">
                  <label for="vehicleC">Vehicle Color:</label>
                  <p id="vehicleC"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                  <label for="garageLocation">Payment Info:</label>
                  <p id="paymentNum"></p>
                </div>
              
                <div class="col-6">
                <label for="qrcode">QR code for Garage Access:</label>
                <div id="qrcode"></div>
                    <script type="text/javascript">
                    new QRCode(document.getElementById("qrcode"), "For Test");
                    </script>
                </div>
            </div>
              
            </form>
            </div>
					</div>
            <div class=" p-0 jumbotron " id="reservation_extend_form" style="display:none" >
			<div class="container">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="extendForm" class="needs-validation" novalidate>

					<div class="row">
            <div class="form-group col"  style="display:none;">
              <input type="text" id="reservationId2" class="form-control" name="reservationId2">
            </div>
					
						<div class="form-group col">
							<label for="endDate2">New Exit Time</label>
							<input type="date" id="endDate2" min="2022-1-17" class="form-control" name="endDate2" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">
								Please select departure date.
							</div>
						</div>  
					</div>

					<div class="row">
						<div class="form-group col">
							<input type="text" id="endTime2" class="form-control timepicker" name="endTime2" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">
								Please select departure time.
							</div>
						</div>
					</div>

					<div class="homeButton">           
            <button type="button" class="btn btn-primary" id="extendUpdate" onclick="extendSubmit()">Update</button>
					</div>
				</form>
			</div>
		</div>
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
          modal.find('.modal-body #reservationId').val(record['reservation_id'])
          modal.find('.modal-body #startTime2').val(record['arrival_time'])
          modal.find('.modal-body #endTime2').val(record['exit_time'])
          modal.find('.modal-body #startDate2').val(record['arrival_date'])
          modal.find('.modal-body #endDate2').val(record['exit_time'])
          modal.find('.modal-body #reservationId2').val(record['reservation_id'])
        })

        $('#detail-modal').on('hidden.bs.modal', function () {
          document.getElementById("reservation_extend_form").style.display="none";
        })
      </script>

      <script>
        //function for cancal redirect
        function cancelFunction(){
          if(confirm("Do you want to cancel this order?")){
              alert("Reservation cancal Sucessfully!");     
              document.getElementById("cancelForm").submit();
          } 
        }

        function extendSubmit(){
          alert("Your reservation is updated now!");                
          document.getElementById("extendForm").submit();
        }
      </script>
    </div>
    
    
		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>
