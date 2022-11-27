<?php
include "utilities/db_connect.php";
//Get car info
$sql = "SELECT * FROM vehicles;  ";
$result = mysqli_query($conn, $sql);
$cars = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Vehicles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
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
    <img src="images\BAS_Parking hero_1920x400.jpg" alt="GWU Garage" />


    <div class="pt-4">
        <div class="container">

  <h1>Your car info</h1>
  <hr>
  <?php foreach ($cars as $car) { ?>


    <div>
      <label style="font-weight: bold"><?php echo $car['plate_number']; ?>
        -
        <?php echo $car['state']; ?></label>
      <br />
      <label style="font-weight: bold">Brand & Model:
        <?php echo $car['brand']; ?></label>
      <br />
      <button type="button" class="btn btn-primary" onclick="location.href='utilities/car_info_update.php?id=<?php echo $car['vehicle_id'] ?>'">Update</button>
      <button type="button" class="btn btn-danger" onclick="location.href='utilities/car_info_delete.php?id=<?php echo $car['vehicle_id'] ?>'">Delete</button>
      <hr>
    <?php } ?>

    <button type="button" class="btn btn-light" onclick="location.href='utilities/car_info_add.php'">Add vehicle</button>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
