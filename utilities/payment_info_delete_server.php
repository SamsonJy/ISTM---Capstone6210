
<?php 
include "../db_connect.php";
$id= $_REQUEST['id'];



$sql=("DELETE FROM `payments` WHERE `payments`.`payment_id` = '$id';");


mysqli_query($conn,$sql);

?>

<?php

include "card_updated_message.php";
?>