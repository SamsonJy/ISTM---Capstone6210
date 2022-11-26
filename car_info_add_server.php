<?php   
        include 'car_info_header.php'
    ?>
<?php
include "db_connect.php";
$car_model=$_REQUEST['car_model'];
$car_plate=$_REQUEST['car_plate'];
$car_state=$_REQUEST['car_state'];



$sql=("INSERT INTO `vehicles` (`vehicle_id`, `brand`, `plate_number`, `state`) 
VALUES (NULL, '$car_model', '$car_plate', '$car_state');");


mysqli_query($conn,$sql);
include "info_updated_message.php";
?>