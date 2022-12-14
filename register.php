<?php include('utilities/server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="path/to/jquery-3.5.0.js"><\/script>')</script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

    <link rel ="stylesheet" href="css/styles.css">
    <script src="js/javaScript.js"></script>


    <title>Register Page</title>
    <style>
    body {
      background-image: url('images/GWU Background.webp');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 120% 110%;
    }
    form, .content {
        width: 30%;
        margin: 0px auto;
        padding: 20px;
        border: 1px solid #B0C4DE;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 0px 0px 10px 10px;
    }
    .btn {
        padding: 8px;
        width:100px;
        font-size: 15px;
        color: white;
        background: #3e627c;
        border: none;
        border-radius: 5px;
    }
  </style>
</head>

<body>



    <div class="p-5">
      <div class="header">
        <h2>Register</h2>
      </div>

      <form method="post" action="register.php">
        <?php include('utilities/error.php'); ?>

        <div class="input-group">
          <label>Email</label>
          <input type="email" name="email"
          placeholder="Enter your E-mail address: **@**.***"
          pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" value="<?php echo htmlspecialchars($email) ?>">
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password_1"placeholder="Enter your password">
        </div>
        <div class="input-group">
          <label>Confirm password</label>
          <input type="password" name="password_2" placeholder="Enter your password">
        </div>
        <div class="input-group">
          <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
          Already a member? <a href="login.php">Log in</a>
        </p>
      </form>
    </div>





    </div>
    <br />


</body>
</html>
