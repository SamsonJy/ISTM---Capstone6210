<?php
session_start();
$id = $_REQUEST['id'];
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')
    </script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

    <script src="js/javaScript.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Your car information</title>

<body>
    <header>
        <div>
            <div class="container-fluid">
                <div style="float:right;margin:20px">
                    <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="../logout.php">Log out</a>
                </div>
                <h3 class="display-4">GW Parking System</h3>
            </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reservations</a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../contact.html">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../car_info.php">My Vehicle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../payment_info.php">My Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../password.php">My Password</a>
                </li>
            </ul>
        </div>
    </nav>

    <body>
        <?php
        if (isset($_POST['SubmitButton'])) {


            include "db_connect.php";
            $sql = ("DELETE FROM `vehicles` WHERE `vehicles`.`vehicle_id` = '$id';");


            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location: ../car_info.php');
        }

        ?>

        <div class="pt-4">
            <div class="container">
                <form action="#" method="POST">
                    <h1>Do you want to delete the car information?</h1>
                    <button type="submit" name="SubmitButton" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" onclick="location.href='../car_info.php'">No</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
    <div class="footer">
        <p>6210 Group A</p>
    </div>
    </html>