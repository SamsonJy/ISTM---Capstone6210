<?php
session_start();

$garageID = $_SESSION['garageID'];
$price = $_SESSION['price'];
$startDateString = $_SESSION['startDate'];
$startTimeString = $_SESSION['startTime'];
$endDateString = $_SESSION['endDate'];
$endTimeString = $_SESSION['endTime'];
$garage = $_SESSION['garage'];
$location = $_SESSION['garageLocation'];

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

    <title>Confirmation Page</title>
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
                <a class="nav-link active" href="home.html">Home <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="contact.html">Contact Us</a>
            </div>
        </div>
    </nav>


    <div class="pt-4">
        <div class="container">
            <div>
                <h3 class="display-5">Thank you for your reservation</h3>
            </div>

            <hr />

            <div class="jumbotron p-3">
                <div class="row">
                    <div class="col">
                        <h5 id="confirmNum" class="display-5"><span>Confirmation # </span><?php echo htmlspecialchars($garageID) ?></h5>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-md">
                        <div id="garage" class="py-1"> <span class="d-block text-muted">Garage: </span> <span><?php echo htmlspecialchars($garage)?></span> </div>
                        <div id="startDateTime" class="py-1"> <span class="d-block text-muted">From: </span> <span><?php echo htmlspecialchars($startTimeString) . "  " . htmlspecialchars($startDateString)?></span> </div>

                    </div>
                    <div class="col-md">
                        <div id="location" class="py-1"> <span class="d-block text-muted">Location: </span> <span><?php echo htmlspecialchars($location)?></span> </div>
                        <div id="endDateTime" class="py-1"> <span class="d-block text-muted">To: </span> <span><?php echo htmlspecialchars($endTimeString) . " " . htmlspecialchars($endDateString)?></span> </div>
                    </div>
                    <div class="col"></div>

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
                    Having trouble? <a href="contact.html">Contact us</a>
                </p>
                <a href="home.html" class="btn btn-primary">Continue to Homepage</a>
            </div>



        </div>

    </div>
    <br />




    <div class="footer">
        <p>6210 Group A</p>
    </div>
</body>
</html>
