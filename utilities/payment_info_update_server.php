<?php
include ("utilities/db_connect.php");
$id= $_REQUEST['id'];
$card_name=$_REQUEST['card_name'];
$card_number= $_REQUEST['card_number'];
$card_date = $_REQUEST['card_date'];
$card_cvv=$_REQUEST['card_cvv'];
$card_zip=$_REQUEST['card_zip'];

$card_cvv=md5($card_cvv);

$sql=("UPDATE `payments` SET
`cardholder_name` = '$card_name',
`card_number` = '$card_number',
`cvv` = '$card_cvv',
`expiration_date` = '$card_date',
`zip_code` = '$card_zip'
 WHERE `payments`.`payment_id` = '$id';");

mysqli_query($conn,$sql);

?>
<?php

include ("utilities/card_updated_message.php");
?>
