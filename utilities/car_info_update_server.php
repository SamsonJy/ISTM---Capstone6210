<?php
        include 'utilities/car_info_header.php'
    ?>
<?php
include "utilities/db_connect.php";
$id= $_REQUEST['id'];
$car_model=$_REQUEST['car_model'];
$car_plate= $_REQUEST['car_plate'];
$car_state = $_REQUEST['car_state'];


$sql=("UPDATE `vehicles` SET
`brand` = '$car_model',
`plate_number` = '$car_plate',
`state` = '$car_state'
 WHERE `vehicles`.`vehicle_id` = '$id';");

mysqli_query($conn,$sql);

?>

<?php

include "utilities/info_updated_message.php";
?>
