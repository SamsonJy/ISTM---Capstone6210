<?php
session_start();
include "db_connect.php";
$curr_password = $_REQUEST['current_password'];
$new_password = $_REQUEST['new_password'];
$new_password_md5 = md5($new_password);
$curr_password_md5 = md5($curr_password);
$id = $_REQUEST['id'];

$sql1 = "SELECT * FROM users WHERE email='$id' AND password= '$curr_password_md5'";
$result = mysqli_query($conn, $sql1);
$check = mysqli_fetch_array($result);
// $new_password=$_REQUEST

// if (isset($check)) {
//     $sql = ("UPDATE `users` SET `password`='$new_password_md5' WHERE `users`.`email`='$id';");
//     mysqli_query($conn, $sql);
//     mysqli_close($conn);
// }

// ?>

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

    <title>Change Password</title>

</head>

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
                    <a class="nav-link" href="..\contact.html">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="..\car_info.php">My Vehicle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="..\payment_info.php">My Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="..\password.php">My Password</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="pt-4">
        

        <?php if (isset($check)) {
            $sql = ("UPDATE `users` SET `password`='$new_password_md5' WHERE `users`.`email`='$id';");
            mysqli_query($conn, $sql);
            mysqli_close($conn); ?>
            <div class="container">
            <div id="garageName">
                <h3 class="display-5">Your password has been changed </h3>
                <p>You have successfully changed your password</p>
            </div>
            <hr />
            <a href="..\home.php">← Back to the Home Page</a>
            <hr />

        </div>
            
       <?php } 
        else{ ?>
            <div class="container">
            <div id="garageName">
                <h3 class="display-5">Incorrect current password</h3>
                <p>The password you entered is incorrect. Please try again</p>
            </div>
            <hr />
            <a href="..\password.php">← Back to the Previous Page</a>
            <hr />
       <?php }
        ?>
    </div>


    <div class="footer">
        <p>6210 Group A</p>
    </div>
</body>

</html>