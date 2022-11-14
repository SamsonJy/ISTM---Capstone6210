<?php include('server.php') ?>
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
    <link rel ="stylesheet" href="style.css">

    <script src="js/javaScript.js"></script>
    <link rel="stylesheet" href="css/styles.css">

    <title>Login Page</title>
</head>

<body>
    <header>
        <div>
            <div class="container-fluid">
                <div>
                    <h3 class="display-4">GWU Parking System</h3>
                </div>
            </div>

        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="home.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="contact.html">Contact Us</a>
            </div>
        </div>
    </nav>
    <img src="images\BAS_Parking hero_1920x400.jpg" alt="GWU Garage" />


    <div class="pt-4">
        <div class="container">

            <div class="jumbotron p-5">
              <form method="post" action="login.php">
                <?php include('errors.php'); ?>
                <div class="input-group">
                  <label>Username</label>
                  <input type="text" name="username" >
                </div>
                <div class="input-group">
                  <label>Password</label>
                  <input type="password" name="password">
                </div>
                <div class="input-group">
                  <button type="submit" class="btn" name="login_user">Login</button>
                </div>
                <p>
                  Not yet a member? <a href="register.php">Sign up</a>
                </p>
              </form>
            </div>
        </div>

    </div>
    <br />


    <div class="footer">
        <p>6210 Group 1</p>
    </div>
</body>
</html>