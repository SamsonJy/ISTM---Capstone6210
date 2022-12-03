<?php
session_start();
include "db_connect.php";

$id = $_REQUEST['id'];
$sql="SELECT `cardholder_name` FROM `payments` WHERE `payment_id`= '$id' ";
$sql2="SELECT `card_number` FROM `payments` WHERE `payment_id`= '$id' ";
$sql3="SELECT `expiration_date` FROM `payments` WHERE `payment_id`= '$id' ";
$sql4="SELECT `zip_code` FROM `payments` WHERE `payment_id`= '$id' ";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);
$card_name = mysqli_fetch_array($result, MYSQLI_ASSOC);
$card_number = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$card_expiration = mysqli_fetch_array($result3, MYSQLI_ASSOC);
$card_zip = mysqli_fetch_array($result4, MYSQLI_ASSOC);
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
    <script>
        window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')
    </script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

    <script src="js/javaScript.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Your payment information</title>
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
    <script>
        function altercheck() {
            var name = document.getElementById("card_name").value;
            var number = document.getElementById("card_number").value;
            var date = document.getElementById("card_date").value;
            var cvv = document.getElementById("card_cvv").value;
            var zip = document.getElementById("card_zip").value;
            if (name.length == 0) {
                alert("Your cardholder name is empty! Please check.")
                return false;
            }

            if (number.length == 0) {
                alert("Your card number is empty! Please check.")
                return false;
            }


            if (date.length == 0) {
                alert("Your card date is empty! Please check.")
                return false;
            }
            if (cvv.length == 0) {
                alert("Your card cvv is empty! Please check.")
                return false;
            }
            if (zip.length == 0) {
                alert("Your card zip code is empty! Please check.")
                return false;
            }

        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php

    

    if (isset($_POST['SubmitButton'])) {

        $card_name = $_REQUEST['card_name'];
        $card_number = $_REQUEST['card_number'];
        $card_date = $_REQUEST['card_date'];
        $card_cvv = $_REQUEST['card_cvv'];
        $card_zip = $_REQUEST['card_zip'];

        $card_cvv = md5($card_cvv);

        $sql = ("UPDATE `payments` SET 
            `cardholder_name` = '$card_name', 
            `card_number` = '$card_number',
            `cvv` = '$card_cvv',
            `expiration_date` = '$card_date',
            `zip_code` = '$card_zip'
            WHERE `payments`.`payment_id` = '$id';");

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location:../payment_info.php');
    }
    ?>
    <div class="pt-4">
    <div class="container">
    <h3 class="display-5">Please enter your new payment information. </h3>
    <hr/>
                    <a href="../payment_info.php">← Back to the Previous Page</a>
                    <hr/>
    <form action="#" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cardholder Name</label>
            <input type="text" class="form-control" name="card_name"  value="<?php echo implode(" ",$card_name)?>" id="card_name" aria-describedby="emailHelp">

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Card Number</label>
            <input type="text" class="form-control" name="card_number" value="<?php echo implode(" ",$card_number)?>" id="card_number">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Expiration Date</label>
            <input type="text" class="form-control" name="card_date" value="<?php echo implode(" ",$card_expiration)?>" id="card_date" placeholder="MM/YY">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">CVV</label>
            <input type="text" class="form-control" name="card_cvv">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Zip Code</label>
            <input type="text" class="form-control" name="card_zip" value="<?php echo implode(" ",$card_zip)?>" id="card_zip">
        </div>
        <button type="submit" name="SubmitButton" class="btn btn-primary" onclick="return altercheck()">Submit</button>
        
    </form>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
<div class="footer">
        <p>6210 Group A</p>
    </div>
</html>