<?php
session_start();
include "db_connect.php";
$curr_password = $_REQUEST['current_password'];
$new_password = $_REQUEST['new_password'];
$new_password_md5 = md5($new_password);
$curr_password_md5 = md5($curr_password);
$email = $_SESSION['email'];

$sql1 = "SELECT * FROM users WHERE email='$email' AND password= '$curr_password_md5'";
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
          <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="../logout.php">Log out</a>
        </div>
        <h3><img src="../images/gw_logo.png" alt="GW Logo" width="80" height="60" style="float:left">Parking System</h3>
      </div>
  </header>

  <nav class="navbar navbar-expand-lg navbar-dark" style="height:50px;">


  </nav>

    <div style="margin-top:200px;">


        <?php if (isset($check)) {
            $sql = "UPDATE users SET password ='$new_password_md5' WHERE email ='$email'";
            mysqli_query($conn, $sql);
            mysqli_close($conn); ?>

            <div class="container">
              <div class="jumbotron">
                <br/><br/>
                <h3 class="display-5 text-center">Your password has been updated successfully! </h3>
                <br/>
                <div class="homeButton">
                  <button type="button" onclick="location.href='../logout.php'" name="vehicleUpdate" style="background-color: #083c5c;"class="btn btn-primary">Back to Login page </button>
                </div>
                <br/><br/>
              </div>
            </div>

       <?php }
        else{ ?>
          <div class="container">
            <div class="jumbotron">
              <br/><br/>
              <h3 class="display-5 text-center">Current password incorrect! </h3>
              <br/>
              <div class="homeButton">
                <button type="button" onclick="location.href='../password.php'" name="vehicleUpdate" style="background-color: #083c5c;"class="btn btn-primary">Back to previous page </button>
              </div>
              <br/><br/>
            </div>
          </div>
       <?php }?>
     </div>


    <div class="footer">
        <p>6210 Group A</p>
    </div>
</body>

</html>
