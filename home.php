<?php

session_start();
//$userID = $_SESSION['userID'];

if(isset($_POST['search'])){

	$_SESSION['startDate'] = $_POST['startDate'];
	$_SESSION['startTime'] = $_POST['startTime'];
	$_SESSION['endDate'] = $_POST['endDate'];
	$_SESSION['endTime'] = $_POST['endTime'];



	header('Location: garageList.php');
}

?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Parking System Home</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<!-- jQuery library -->
		<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
		<script>window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>



		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

		<script src="js/javaScript.js"></script>
		<link rel="stylesheet" href="css/styles.css">


		<script>
		$(document).ready(function(){
				$('input.timepicker').timepicker({
					timeFormat: 'H:mm ',
					interval: 60,
					dynamic: false,
					dropdown: true,
					scrollbar: true,
					minTime:'7:00am',
					maxTime: '11:00pm',
					change: checkDate
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
			<div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item active">
		        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
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

		<img src="images\BAS_Parking hero_1920x400.jpg" alt="GWU Garage"/>

		<div class=" p-4 jumbotron jumbotron-fluid ">
			<div class="container">

				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="homeForm" class="needs-validation" novalidate>

					<div class="row">
						<div class="form-group col">
							<label for="startDate">From</label>
							<input type="date" id="startDate"  min="2022-10-17" max="" class="form-control" name="startDate" onchange="checkDate()"required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">
								Please select arrival date.
							</div>
						</div>

						<div class="form-group col">
							<label for="endDate">To</label>
							<input type="date" id="endDate" min="2022-10-17" class="form-control" name="endDate" onchange="checkDate()" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">
								Please select departure date.
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col">
							<input type="text" id="startTime" class="form-control timepicker" name="startTime" placeholder="--:--" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">
								Please select arrival time.
							</div>
						</div>

						<div class="form-group col">
							<input type="text" id="endTime" class="form-control timepicker" name="endTime" placeholder="--:--" required>
							<div class="valid-feedback"></div>
							<div class="invalid-feedback">
								Please select departure time.
							</div>
						</div>
					</div>

					<div class="homeButton">
						<input type="submit" style="background-color: #083c5c;" name="search" value="Search" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>





		<script>
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1;
		var yyyy = today.getFullYear();

		if (dd < 10) {
			 dd = '0' + dd;
		}

		if (mm < 10) {
			 mm = '0' + mm;
		}

		today = yyyy + '-' + mm + '-' + dd;
		document.getElementById("startDate").setAttribute("min", today);
		document.getElementById("endDate").setAttribute("min", today);

		</script>

		<script>
		(function () {
		  'use strict'

		  // Fetch all the forms we want to apply custom Bootstrap validation styles to
		  var forms = document.querySelectorAll('.needs-validation')

		  // Loop over them and prevent submission
		  Array.prototype.slice.call(forms)
		    .forEach(function (form) {
		      form.addEventListener('submit', function (event) {
		        if (!form.checkValidity()) {
		          event.preventDefault()
		          event.stopPropagation()
		        }

		        form.classList.add('was-validated')
		      }, false)
		    })
		})()

	</script>


	<div class="footer">
		<p>6210 Group A</p>
	</div>

	</body>
</html>
