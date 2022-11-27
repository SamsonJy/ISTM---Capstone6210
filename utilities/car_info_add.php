<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add your car information</title>
    <script>
        function altercheck() {
            var make = document.getElementById("car_model").value;
            var plate = document.getElementById("car_plate").value;
            var state = document.getElementById("car_state").value;

            if (make.length == 0) {
                alert("Your car model is empty! Please check.")
                return false;
            }

            if (plate.length == 0) {
                alert("Your car plate number is empty! Please check.")
                return false;
            }


            if (state.length == 0) {
                alert("Your car plate state is empty! Please check.")
                return false;
            }

        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php
        include 'utilities/car_info_header.php'
    ?>
    <h1>Please enter your new car information.</h1>
    <form action="car_info_add_server.php" method='POST'>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Make & Model</label>
            <input type="text" class="form-control" name="car_model" id="car_model" aria-describedby="emailHelp">

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">License Plate</label>
            <input type="text" class="form-control" name="car_plate" id="car_plate">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">State</label>
            <input type="text" class="form-control" name="car_state" id="car_state">
        </div>
        <button type="submit" class="btn btn-primary" onclick="return altercheck()">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
