<!DOCTYPE html>
    <html>

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
        <script>
            function altercheck() {
                var make = document.getElementById("car_model").value;
                var plate = document.getElementById("car_plate").value;
                var state = document.getElementById("car_state").value;

                if (make.length == 0) {
                    alert("Your car model is empty! Please check.")
                    return false;
                }

                if (plate.length == 0) {
                    alert("Your car plate number is empty! Please check.")
                    return false;
                }


                if (state.length == 0) {
                    alert("Your car plate state is empty! Please check.")
                    return false;
                }

            }
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>

    <body>
        <?php
        session_start(); ?>

        <body>
            <header>
                <div>
                    <div class="container-fluid">
                        <div style="float:right;margin:20px">
                            <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="utilities/logout.php">Log out</a>
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
            <?php
            if (isset($_POST['SubmitButton'])) {
                include "db_connect.php";
                $car_model = $_REQUEST['car_model'];
                $car_plate = $_REQUEST['car_plate'];
                $car_state = $_REQUEST['car_state'];


                $sql = ("INSERT INTO `vehicles` (`vehicle_id`, `brand`, `plate_number`, `state`,`user_id`) 
VALUES (NULL, '$car_model', '$car_plate', '$car_state', '$_SESSION[userID]');");

                mysqli_query($conn, $sql);
                header('location:../car_info.php');
            }
            ?>

            <div class="pt-4">
                <div class="container">
                    <h3 class="display-5">Please enter your new car information. </h3>
                    <hr/>
                    <a href="../car_info.php">← Back to the Previous Page</a>
                    <hr/>
                    <form action="#" method='POST'>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Make & Model</label>
                            <input type="text" class="form-control" name="car_model" id="car_model" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Color</label>
                            <input type="text" class="form-control" name="car_color" id="car_color" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">License Plate</label>
                            <input type="text" class="form-control" name="car_plate" id="car_plate">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">State</label>
                            <input type="text" class="form-control" name="car_state" id="car_state">
                        </div>
                        <button type="submit" name='SubmitButton' class="btn btn-primary" onclick="return altercheck()">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>

            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        </body>
        <div class="footer">
        <p>6210 Group A</p>
    </div>
    </html>