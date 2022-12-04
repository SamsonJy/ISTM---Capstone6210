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

		<title>Garage List</title>
		<style>
		 input{
			height:40px;
			width:150px;
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
										<input type="submit" name="search" value="Select" class="btn btn-primary" onClick="location.href='checkout.php?id=<?php echo htmlspecialchars($garage['garage_id']) ?>'">


									</div>
								</div>
							</div>
						</div>
					</br>
				<?php }?>
			</div>
		</div>


		<div class="footer">
			<p>6210 Group A</p>
		</div>
	</body>
</html>
