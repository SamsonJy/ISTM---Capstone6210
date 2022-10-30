<?php 
	echo "test";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<!-- jQuery library --> 
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script> 
<script>window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')</script> 

<!-- Latest compiled JavaScript --> 
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<title>Georga Washington Visitor Parking Reservation System</title>
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="js/javaScript.js" >
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
  <header>
    <div class="primary_header"> <img src="images/gw_monogram_2c.png" id="logo" alt="GWU Logo" >
      <h1 class="title">Visitor Parking Reservation System</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav"> <a class="nav-link active" href="home.html">Make Reservation <span class="sr-only">(current)</span></a> <a class="nav-link" href="contact.html">Reservation History</a> <a class="nav-link" href="contact.html">Account Setting</a> <a class="nav-link" href="contact.html">Cancel Reservation</a> <a class="nav-link" href="contact.html">Contact Us</a> </div>
      </div>
    </nav>
    <img src="images\BAS_Parking hero_1920x400.jpg" alt="GWU Garage" style="padding-right:70px; height:auto; max-width:1210px;margin:auto;"/> </header>
	<!--reservation records-->
  <section class="reservation_record">
	  
    <div class="upcoming-reservation">
      <div class="reservation_details col-xl-10">
        <h3>Upcoming Reservation</h3><br>
        <?php
          echo "<table style='border:solid 1px black;'>";
          echo "<tr><th>Reservation ID</th><th>Garage name</th><th>Garage Location</th><th>arrival date</th><th>arrival time</th><th>total_charge</th>"
          $checker = "localhost";
          $username="ISTM6210";
          $password= "Istm6210Test"
          try{
            $conn = new PDO("mysql:host=$servername;dbname=GWVP",$username,$password);

            $conn -> setAttribute(PDO::ATTR_ERRMODE,PDD::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            $stmt= $conn ->prepare("SELECT rd.reservation_id,g.garage_name,g.garagae_location,
            rd.arrival_date,rd.arrival_time,rd.total_charge From reservations rd inner join garage g On rd.garage_id = g.garage_id where reservation_status='upcoming' ")
            $stmt ->execute();

            $result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
              echo $v;
            }
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          $conn=null;
          echo "</table>";
        ?>
		   <div class="row justify-content-center">
      <div class="col-8 text center col-xl-12">
        <p class="text muted my-4"> Nothing for now </p>
        <button type="button" 
				  class="btn btn-primary" 
				  data-bs-toggle="modal" 
				  data-bs-target="#cancel-modal">Cancel</button>
      </div>
    </div>
      </div>
    </div>
   
	  <div class="in-process-reservation col-xl-10">
	  	<div class="reservation_details col-xl-5">
		  <h3>In-Process Reservation</h3><br>
        <?php
          echo "<table style='border:solid 1px black;'>";
          echo "<tr><th>Reservation ID</th><th>Garage name</th><th>Garage Location</th><th>arrival date</th><th>arrival time</th><th>total_charge</th>"
          $checker = "localhost";
          $username="ISTM6210";
          $password= "Istm6210Test"
          try{
            $conn = new PDO("mysql:host=$servername;dbname=GWVP",$username,$password);

            $conn -> setAttribute(PDO::ATTR_ERRMODE,PDD::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            $stmt= $conn ->prepare("SELECT rd.reservation_id,g.garage_name,g.garagae_location,
            rd.arrival_date,rd.arrival_time,rd.total_charge From reservations rd inner join garage g On rd.garage_id = g.garage_id where reservation_status='in-process' ")
            $stmt ->execute();

            $result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
              echo $v;
            }
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          $conn=null;
          echo "</table>";
        ?>
		  </div>	
	  </div>
	  
	  <div class="finished-Reservation">
	  	<div class="reservation_details col-xl-10">
		  <h3 class="col-xl-5">Finished Reservation</h3><br>
      <?php
          echo "<table style='border:solid 1px black;'>";
          echo "<tr><th>Reservation ID</th><th>Garage name</th><th>Garage Location</th><th>arrival date</th><th>arrival time</th><th>total_charge</th>"
          $checker = "localhost";
          $username="ISTM6210";
          $password= "Istm6210Test"
          try{
            $conn = new PDO("mysql:host=$servername;dbname=GWVP",$username,$password);

            $conn -> setAttribute(PDO::ATTR_ERRMODE,PDD::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            $stmt= $conn ->prepare("SELECT rd.reservation_id,g.garage_name,g.garagae_location,
            rd.arrival_date,rd.arrival_time,rd.total_charge From reservations rd inner join garage g On rd.garage_id = g.garage_id where reservation_status='passed' ")
            $stmt ->execute();

            $result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
              echo $v;
            }
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          $conn=null;
          echo "</table>";
        ?>
		  </div>	
	  </div>
    <!-- Modal -->
    <div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cancelModalLabel">The Record Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div id="garageLocation" class="py-1"> <span class="d-block text-muted">Garge Location</span> <span></span> </div>
                <div id="reservationTime" class="py-1"> <span class="d-block text-muted">Reseration Time</span> <span></span> </div>
              </div>
              <div class="col">
                <div id="vehicllabel" class="py-1"> <span class="d-block text-muted">Vehicle Info</span> <span></span> </div>
				<div id="vehicleInfo" class="py-1"></div>
                <div id="paymentlabel" class="py-1"> <span class="d-block text-muted">Payment Info</span></div>
				 <div id="paymentInfo" class="py-1"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Cancel Reservation</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2022 - <strong>GWSB ISTM 6210 Group A</strong></div>
  </footer>
</div>
</body>
</html>