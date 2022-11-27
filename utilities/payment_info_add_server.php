<?php
include "utilities/db_connect.php";
$card_name=$_REQUEST['card_name'];
$card_number= $_REQUEST['card_number'];
$card_date = $_REQUEST['card_date'];
$card_cvv=$_REQUEST['card_cvv'];
$card_zip=$_REQUEST['card_zip'];

$card_cvv=md5($card_cvv);

$sql=("INSERT INTO `payments` (`cardholder_name`, `card_number`, `cvv`, `expiration_date`,`zip_code`)
VALUES ( '$card_name', '$card_number', '$card_cvv','$card_date','$card_zip');");

mysqli_query($conn,$sql);

?>
<?php

include "utilities/card_updated_message.php"
?>
