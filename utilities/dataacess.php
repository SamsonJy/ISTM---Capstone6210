<?php
include('utilities/db_connect.php' );
session_start();
$garage = "SELECT * FROM garage Where garage.garage_id = '$garage_id'";
$garageResult = mysqli_query($conn, $garage);
$garages = mysqli_fetch_all($garageResult, MYSQLI_ASSOC);
mysqli_free_result($garageResult);
?>
