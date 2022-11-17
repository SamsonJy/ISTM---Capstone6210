<?php
//connect to local db
$conn = mysqli_connect('localhost', 'jonathan', '123456', 'gwvp');

if(!$conn){
  echo "Conncetion error: " . mysqli_connect_error();
}
?>
