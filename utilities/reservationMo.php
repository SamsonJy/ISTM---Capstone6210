<?php
session_start();
$userID = $_SESSION['userID'];
$sql_vehicles = "SELECT * FROM vehicles WHERE user_id = $userID";
$result_vehicles = mysqli_query($conn, $sql_vehicles);


if (isset($_POST['vehicleUpdate'])){

  if (isset($_POST['vehicleChoice'])) {
    $reservation_id = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    $vehicle_id = $_POST['vehicleChoice'];
    $sql_reservation = "UPDATE reservations SET vehicle_id = '$vehicle_id'
                        WHERE reservation_id = '$reservation_id'";
    mysqli_query($conn, $sql_reservation);

  }else {
    $vehicle_id = $_SESSION['vehicleID'];

    $brand = mysqli_real_escape_string($conn, $_POST['vModel']);
    $color = mysqli_real_escape_string($conn, $_POST['vColor']);
    $plate_number = mysqli_real_escape_string($conn, $_POST['lPlate']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $sql_vehicle = "UPDATE vehicles SET brand = '$brand', color = '$color', plate_number = '$plate_number', state = '$state'
                    WHERE vehicle_id = '$vehicle_id'";
    mysqli_query($conn, $sql_vehicle);
  }
  header('Location: reservationDetails.php');
}

if(isset($_POST['yes'])){
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
  $sql = "DELETE FROM reservations WHERE reservation_id = $id_to_delete";
  mysqli_query($conn, $sql);
  header('Location: reservations.php');


}

if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT reservations.reservation_id, reservations.arrival_time , reservations.arrival_date, reservations.exit_time, reservations.exit_date,
                 reservations.total_charge, reservations.reservation_status, reservations.duration_in_hours, garages.garage_name, garages.garage_location,
                 vehicles.vehicle_id, vehicles.brand, vehicles.plate_number, vehicles.state
          FROM reservations
          JOIN garages
          ON reservations.garage_id = garages.garage_id
          JOIN vehicles
          ON reservations.vehicle_id = vehicles.vehicle_id
          WHERE reservation_id = $id";
  $result = mysqli_query($conn, $sql);
  $reservation = mysqli_fetch_assoc($result);
  $_SESSION['reservationID'] = $reservation['reservation_id'];
  $_SESSION['arrivalTime'] = $reservation['arrival_time'] . ", " . $reservation['arrival_date'];
  $_SESSION['exitTime'] = $reservation['exit_time'] . ", " . $reservation['exit_date'];
  $_SESSION['totalCharge'] = $reservation['total_charge'];
  $_SESSION['status'] = $reservation['reservation_status'];
  $_SESSION['duration'] = $reservation['duration_in_hours'];
  $_SESSION['garage'] = $reservation['garage_name'];
  $_SESSION['location'] = $reservation['garage_location'];
  $_SESSION['vehicle'] = $reservation['brand'] . ", " . $reservation['plate_number'] . "-" . $reservation['state'];
  $_SESSION['vehicleID'] = $reservation['vehicle_id'];

}



?>
