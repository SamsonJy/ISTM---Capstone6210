<?php
//Connect database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gwvp";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db ( $conn , $dbname);
?>