<?php
        include 'utilities/car_info_header.php'
    ?>
<?php
include "utilities/db_connect.php";
$id= $_REQUEST['id'];



$sql=("DELETE FROM `vehicles` WHERE `vehicles`.`vehicle_id` = '$id';");


mysqli_query($conn,$sql);

?>

<?php

include "utilities/info_updated_message.php";
?>
