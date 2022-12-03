<?php
//connect to local db
$conn = mysqli_connect('localhost', 'root', '', 'gwvp2');

if(!$conn){
  echo "Conncetion error: " . mysqli_connect_error();
}
?>
