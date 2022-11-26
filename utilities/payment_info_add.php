
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script>
        function altercheck() {
            var name = document.getElementById("card_name").value;
            var number = document.getElementById("card_number").value;
            var date = document.getElementById("card_date").value;
            var cvv = document.getElementById("card_cvv").value;
            var zip = document.getElementById("card_zip").value;
            if (name.length == 0) {
                alert("Your cardholder name is empty! Please check.")
                return false;
            }

            if (number.length == 0) {
                alert("Your card number is empty! Please check.")
                return false;
            }


            if (date.length == 0) {
                alert("Your card date is empty! Please check.")
                return false;
            }
            if (cvv.length == 0) {
                alert("Your card cvv is empty! Please check.")
                return false;
            }
            if (zip.length == 0) {
                alert("Your card zip code is empty! Please check.")
                return false;
            }

        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
  <?php
    include "payment_info_header.php"
    ?>
    <h1>Please add your payment information.</h1>
    <form action="payment_info_add_server.php"  method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cardholder Name</label>
            <input type="text" class="form-control" name= "card_name" id="card_name" aria-describedby="emailHelp">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Card Number</label>
            <input type="text" class="form-control" name="card_number" id="card_number">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Expiration Date</label>
            <input type="text" class="form-control" name="card_date" id="card_date">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">CVV</label>
            <input type="text" class="form-control" name="card_cvv" id="card_cvv">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Zip Code</label>
            <input type="text" class="form-control" name="card_zip" id="card_zip">
        </div>
        <button type="submit" class="btn btn-primary"onclick="return altercheck()">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>