<?php
session_start();
$id = $_REQUEST['id'];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Do you want to delete the paymen information? </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <?php
  include "utilities/payment_info_header.php"
  ?>
  <h1>Do you want to delete the payment information?</h1>
  <button type="button" class="btn btn-primary" onclick="location.href='payment_info_delete_server.php?id=<?php echo $id; ?>'">Yes</button>
  <button type="button" class="btn btn-secondary" onclick="location.href='payment_info.php'">No</button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
