<?php
include "db_connect.php";
//Get car info
$sql = "SELECT * FROM payments;  ";
$result = mysqli_query($conn, $sql);
$payments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

session_start();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php
        include "payment_info_header.php"
    ?>
    <h1>Your Payment Methods</h1>
    <hr>
    <?php foreach ($payments as $payment) { ?>
        <?php $card_number = $payment['card_number'];
        $card_last_four = substr($card_number, -5);
        ?>
        <label style="font-weight: bold">
            VISA(Ending in <?php echo $card_last_four;  ?>)
        </label>
        <br>
        <label style="font-weight: bold">
            Exp: <?php echo $payment['expiration_date']; ?>
        </label>
        <br>
        <button type="button" class="btn btn-primary"  onclick="location.href='payment_info_update.php?id=<?php echo $payment['payment_id'] ?>'">Update</button>
        <button type="button" class="btn btn-danger" onclick="location.href='payment_info_delete.php?id=<?php echo $payment['payment_id'] ?>'">Delete</button>
        <hr>
    <?php  } ?>
    <button type="button" class="btn btn-light" onclick="location.href='payment_info_add.php'">Add Payment</button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>