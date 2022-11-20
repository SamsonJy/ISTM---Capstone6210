<?php
  // session_destroy();
  include('db_connect.php');
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
  // echo isset($_POST['vColor']);
  // echo "<br />";
  // echo isset($_POST['licensePlate']);
  // echo "<br />";
  // echo isset($_POST['licensePlateState']);
  // echo "<br />";
  // echo isset($_POST['mModel'], $_POST['vColor']);
  // echo "<br />";\
  // echo $_POST['vehicleChoice'];\
  $payment_id_insert = $_POST['cardChoice'];
  $vehicle_id_insert = $_POST['vehicleChoice'];
  // echo $payment_id_insert;

  $sqlP = "SELECT * FROM payments WHERE payment_id = $payment_id_insert";
  $resultP = mysqli_query($conn, $sqlP);
  while ($rowP = mysqli_fetch_assoc($resultP)){
    $paymentId_selected = $rowP['payment_id'];
    echo "payment id is " . $paymentId_selected;
    echo "<br />";
  }

  $sqlV = "SELECT * FROM vehicles WHERE vehicle_id = $vehicle_id_insert";
  $resultV = mysqli_query($conn, $sqlV);
  while ($rowV = mysqli_fetch_assoc($resultV)){
    $vehicleId_selected = $rowV['vehicle_id'];
    echo "vehicle id is " . $vehicleId_selected;
    echo "<br />";
  }
  // echo $sql_payments;
  // if ($conn->query($sql_payments) === TRUE) {
  //   echo "yes";
  // } else {
  //   echo "no";
  // }
  // $output = mysqli_fetch_assoc($result_payments)
  // while ($output > 0) {
  //   echo $output['id'];
  // }



 ?>
