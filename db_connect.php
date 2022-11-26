<?php
//connect to local db
$conn = mysqli_connect('localhost', 'ethan', '123456', 'GWVP');

if(!$conn){
  echo "Conncetion error: " . mysqli_connect_error();
}
<<<<<<< HEAD
?>
=======
mysqli_select_db ( $conn , $dbname);
>>>>>>> parent of 2b43e7e (add back php tag close)
