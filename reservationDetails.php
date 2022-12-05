<?php
include('utilities/db_connect.php' );
include('utilities/reservationMo.php' );
$exitTimeString = $_SESSION['exitTime'];
$exitTime = explode(':', $exitTimeString);
$minEndTimeHour = (int)$exitTime[0] + 1;
$maxEndTimeHour = (int)$exitTime[0] + 3;
$minEndTime0 = (string)$minEndTimeHour;
$maxEndTime0 = (string)$maxEndTimeHour;
$minEndTime = $minEndTime0 . ":00";
$maxEndTime = $maxEndTime0 . ":00";

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
    <link rel="stylesheet" href="css/styles.css">

		<title>Reservation Details</title>
    <style>
    form .btn {
        padding: 8px;
        width:100px;
        font-size: 15px;
        border: none;
        border-radius: 5px;
        margin-left:10px;
        margin-right:10px;
    }
		#btn1, #btn2 {
			padding: 8px;
			width:150px;
			border: 1px solid #083c5c;
			background-color: #083c5c;
			color:white;
			font-size: 15px;
			border-radius: 5px;
		}

		#btn3 {
			padding: 8px;
			width:150px;
			border: 1px solid #083c5c;
			color:#083c5c;
			background-color: white;
			font-size: 15px;
			border-radius: 5px;
		}

    </style>
		<script>
		$(document).ready(function(){
				$('input.timepicker').timepicker({
					timeFormat: 'H:mm ',
					interval: 60,
					dynamic: false,
					dropdown: true,
					minTime:'<?php echo $minEndTime ?>',
					maxTime: '<?php echo $maxEndTime ?>',
					zindex: 9999999,

				});
		});

		</script>
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

      <div class="pt-4">
          <div class="container">
            <h3 class="display-5">Reservation Details</h3>
            <hr />
            <a href="reservations.php">← Back to the Previous Page</a>
          </br></br>

          <div id="detailTable" class="jumbotron pt-3">
            <div class="row">
              <div class="col">
                <h5 class="display-5"><span>Reservation # </span><?php echo htmlspecialchars($_SESSION['reservationID']) ?></h5>
              </div>
            </div>

            <div class="row">
              <div class="col py-1"> <span class="d-block text-muted">Rerservation Status: </span> <span><?php echo htmlspecialchars($_SESSION['status'])?></span> </div>
            </div>

            <div class="row py-1">
              <div class="col-4 py-1"> <span class="d-block text-muted">From: </span> <span><?php echo htmlspecialchars($_SESSION['arrivalDTime'])?></span> </div>
              <div class="col-4 py-1"> <span class="d-block text-muted">To: </span> <span><?php echo htmlspecialchars($_SESSION['exitDTime'])?></span> </div>
              <div class="col-4 py-1"> <span class="d-block text-muted">Duration: </span> <span><?php echo htmlspecialchars($_SESSION['duration'])?> hrs</span> </div>
            </div>

            <div class="row">
              <div class="col-4 py-1"> <span class="d-block text-muted">Garage: </span> <span><?php echo htmlspecialchars($_SESSION['garage'])?></span> </div>
              <div class="col-4 py-1"> <span class="d-block text-muted">Location: </span> <span><?php echo htmlspecialchars($_SESSION['location'])?></span> </div>
            </div>

            <div class="row py-1">
							<div class="col-4 py-1"> <span class="d-block text-muted">Total Charges: </span> <span>$<?php echo htmlspecialchars($_SESSION['totalCharge'])?>.00</span> </div>
              <div class="col-4 py-1"> <span class="d-block text-muted">Vehicle: </span> <span><?php echo htmlspecialchars($_SESSION['vehicle'])?></span> </div>
            </div>
            <hr />

            <div class="row">
              <div class="col">
                <h5 class="display-5"><span>Garage Access Code: </span></h5>
              </div>
            </div>

            <div class="row">
              <div class="col py-1"> <img src="images/qrcode.png" alt="QR Code" style="  display: block;margin-left: auto;margin-right: auto;height: 200px;width:200px;"> </div>
            </div>
          </div>


          <div id="cancelForm" class="modal">
            <div class="modal-content">
              <span id="close1" class="close">&times;</span>
              <br><br>

              <form actions="reservationDetails.php" method="POST" >
                <input type="hidden" name="id_to_cancel" value="<?php echo $reservation['reservation_id'] ?>">
                <p>Cancel this reservation?</p>
                <br>

                <div class="text-center" >
                  <input type="submit" style="background-color: #083c5c;" class="btn btn-primary" name="yes" value="Yes">
                 <input type="submit"  style="background-color: white; color:black;	border: 1px solid #083c5c;"class="btn btn-light" name="no" onclick="closeModel();" value="No">
               </div>
             </form>
           </div>
         </div>

         <div id="modifyForm" class="modal">
           <div class="modal-content">
             <p>Vehicle Info Update</p>
             <span id="close2" class="close">&times;</span>
             <br>


             <form actions="reservationDetails.php" method="POST" class="needs-validation" novalidate>
                 <input type="hidden" name="id_to_update" value="<?php echo $reservation['reservation_id'] ?>">

               <div class="form-group">
                 <label for="currentVehicle">Current Vehicle</label>
                 <input type="text" class="form-control" name="currentVehicle" value="<?php echo htmlspecialchars($_SESSION['vehicle'])?>" disabled>
               </div>

               <div class="form-group row">

                 <div class="col">
                   <label>New Vehicle</label>
                   </br>
                   <div class="vehicle">
                     <?php
                     while ($row = mysqli_fetch_assoc($result_vehicles)){ ?>
                       <input type='radio' name='vehicleChoice' value="<?php echo $row['vehicle_id'] ?>">
                       <label> <?php echo $row['plate_number'] . "  " . $row['brand'] ?></label>
                       <br />
                     <?php }?>
                   </div>
                 </div>
               </div>

               <div class="addVehicle">
                 <p>
                   <button id="newVehicle" class="btn btn-primary hide-in" style="background-color: #083c5c;" type="button" data-toggle="collapse" data-target="#vehicleOption" aria-expanded="false" aria-controls="vehicle_collapse">
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


                 </div>
               </div>

						 <hr>

               <div class="homeButton">
                 <input type="submit" name="vehicleUpdate" style="background-color: #083c5c;" value="Update" class="btn btn-primary">
               </div>
             </form>
           </div>
         </div>

				 <div id="extendForm" class="modal">
					 <div class="modal-content" >

						 <p>Extend your reservation</p>
						 <span id="close3" class="close">&times;</span>
						 <br>
						 <form actions="reservationDetails.php" method="POST" class="needs-validation" novalidate>
							 <input type="hidden" name="id_to_extend" value="<?php echo $reservation['reservation_id'] ?>">
							 <div class="form-group">
								 <label for="exitDate">New Exit Time</label>
								 <input type="text" class="form-control" name="exitDate" value="<?php echo htmlspecialchars($_SESSION['exitDate'])?>" disabled>
							 </div>


						 <div class="row">
							 <div class="form-group col">
								 <input type="text" class="form-control timepicker" name="newEndTime" placeholder="--:--" required>
								 <div class="valid-feedback"></div>
								 <div class="invalid-feedback">
									 Please select a new departure time.
								 </div>
							 </div>
						 </div>
						 <br>
						 <br>


						 <div class="homeButton">
							 <input type="submit" name="extendTime" style="background-color: #083c5c;" value="Extend" class="btn btn-primary">
						 </div>
						 </form>
					 </div>
				 </div>




          <hr />

          <div class="text-center">
            <p>
              Having trouble? <a href="contact.html">Contact Us</a>
            </p>
            <?php
            if($_SESSION['status'] == "Ongoing") {?>
              <button type="button" id="btn1" onclick=" OpenModel3();">Extend</button>
            <?php } else if($_SESSION['status'] == "Upcoming"){ ?>
              <div class="btnList" style="display:inline;">
                <button type="button" id="btn2" onclick=" OpenModel2();">Modify</button>
                <button type="button" id="btn3"onclick=" OpenModel1();">Cancel</button>
              </div>
            <?php } ?>

          </div>
        <br><br>
        </div>
      </div>
      <br>
      <script>

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

      /*document.getElementById("garageName").innerHTML = localStorage.getItem("garage");*/
      var cancelModal = document.getElementById("cancelForm");
			var modifyModal = document.getElementById("modifyForm");
			var extendModal = document.getElementById("extendForm");
      // Get the <span> element that closes the modal
      var span = document.getElementById("close1");
			var span2 = document.getElementById("close2");
			var span3 = document.getElementById("close3");
      // When the user clicks on the button, open the modal
      function OpenModel1() {
        cancelModal.style.display = "block";
      }
      function closeModel1(){
        cancelModal.style.display = "none";
      }
      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        cancelModal.style.display = "none";
      }


      function OpenModel2() {
        modifyModal.style.display = "block";
      }

      span2.onclick = function () {
        modifyModal.style.display = "none";
      }

			function OpenModel3() {
				extendModal.style.display = "block";
			}
			span3.onclick = function () {
				extendModal.style.display = "none";
			}


      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
        if (event.target == cancelModal) {
          cancelModal.style.display = "none";
        }
        if (event.target == modifyModal) {
          modifyModal.style.display = "none";
        }
				if (event.target == extendModal) {
					extendModal.style.display = "none";
				}
      };



      </script>

      <div class="footer">
          <p>6210 Group A</p>
      </div>
  </body>
</html>
