<?php
session_start();
include "utilities/db_connect.php";
//Get car info
// $sql = "SELECT * FROM vehicles WHERE 'user_id'= '$_SESSION[userID]';  ";
$sql = "SELECT * FROM `users` WHERE `user_id`='$_SESSION[userID]';";
$result = mysqli_query($conn, $sql);
$email = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);


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
  <link rel="stylesheet" href="css/styles.css">

  <title>Password Change</title>
  <script>
    function altercheck() {
      var current_pass = document.getElementById("current_password").value;
      var new_pass = document.getElementById("new_password").value;
      var confir_pass = document.getElementById("new_password_check").value;
      if (current_pass.length == 0) {
        alert("Please check your current password.")
        return false;
      }


      if (new_pass !== confir_pass) {
        alert("New Password didn't matched,try again!");
        return false;
      }

      if (new_pass.length == 0) {
        alert("New password is empty! Try again!");
        return false;
      }
      if (confir_pass.length == 0) {
        alert("Pleae confirm your new password! Try again!");
        return false;
      }
    }
  </script>
</head>

<body>
  <header>
    <div>
      <div class="container-fluid">
        <div style="float:right;margin:20px">
          <a style="margin-left:7px;font-weight:bold;color:#2a1484" href="utilities/logout.php">Log out</a>
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
        <li class="nav-item active">
          <a class="nav-link" href="contact.html">Contact Us <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">My Account</a>
        </li>
      </ul>
    </div>
  </nav>

  <img src="images\BAS_Parking hero_1920x400.jpg" alt="GWU Garage" />


  <div class="pt-4">
    <div class="container">
      <?php foreach ($email as $emails) { ?>
        <form action="utilities/password_update_server.php?id=<?php echo $emails['email'] ?>" method="POST">
          <div class="mb-3">
            <label>You are logged in as:</label>
            <br>
            <label for="exampleInputEmail1" class="form-label"><?php echo $emails['email']; ?></label>


          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Current Password </label>
            <input type="password" class="form-control" id="current_password" name="current_password" aria-describedby="emailHelp">

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" id="new_password">
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="new_password_check" id="new_password_check">
          </div>

          <button type="submit" class="btn btn-primary"  onclick="return altercheck()">Submit</button>
          <button type="reset" class="btn btn-link">Reset</button>
        </form>

    </div>





  </div>
<?php  } ?>
<br />




<div class="footer">
  <p>6210 Group 1</p>
</div>
</body>

</html>