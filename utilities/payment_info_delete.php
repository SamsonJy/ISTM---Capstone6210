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
    session_start();
    $id = $_REQUEST['id'];
        include "car_info_header.php";

        if(isset($_POST['SubmitButton'])) {
            include "db_connect.php";
            $sql=("DELETE FROM `payments` WHERE `payments`.`payment_id` = '$id';");


            mysqli_query($conn,$sql);
            
            
            
    
             mysqli_close($conn);
             header('location:../payment_info.php');

        }
    ?>
  <form action="#" method="POST">
  <h1>Do you want to delete the payment information?</h1>
  <button type="submit" name="SubmitButton" class="btn btn-primary">Yes</button>
  <button type="button" class="btn btn-secondary" onclick="location.href='../payment_info.php'">No</button>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>