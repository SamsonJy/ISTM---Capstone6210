<?php
  session_destroy();
  // include('db_connect.php');
  // if ($_POST['mModel'] !== "" || $_POST['vColor'] !== "" || $_POST['licensePlate'] !== "" || $_POST['licensePlateState'] !== "") {
  //   $MM = $_POST['mModel'];
  //   $VC = $_POST['vColor'];
  //   $LP = $_POST['licensePlate'];
  //   $LPS = $_POST['licensePlateState'];
  //   $sql_vehicle_insert = "INSERT INTO vehicles (brand, color, plate_number, state, user_id) VALUES ('" . $MM . "', '" . $VC . "', '" . $LP . "', '" . $LPS . "', '1') ";
  //   if ($conn->query($sql_vehicle_insert) === TRUE) {
	// 	  echo "New record created successfully";
	// 	} else {
	// 	  echo "Error: " . $sql_vehicle_insert . "<br>" . $conn->error;
	// 	}
  // }
  // echo isset($_POST['mModel']);
  // echo "<br />";
  echo isset($_POST['vColor']);
  // echo "<br />";
  // echo isset($_POST['licensePlate']);
  // echo "<br />";
  // echo isset($_POST['licensePlateState']);
  // echo "<br />";
  // echo isset($_POST['mModel'], $_POST['vColor']);
  // echo "<br />";\



 ?>
