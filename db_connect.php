<?php
//connect to local db
$conn = mysqli_connect('localhost', 'ethan', '123456', 'GWVP');

if(!$conn){
  echo "Conncetion error: " . mysqli_connect_error();
}
?>
