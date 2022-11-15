<?php
/*
  File name: db_connect
  Description: This is the connection
  Last update: October 31th
  Created by: Jiayun Zou
*/
include('db_connect.php');
session_start();

//$username = "";
$email    = "";
$errors = array();


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  //if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    /*if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }*/

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (email, password)
  			      VALUES( '$email', '$password')";
  	mysqli_query($conn, $query);
  	//$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: confirm.php');
  }
}
if (isset($_POST['login_user'])) {
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  /*if (empty($username)) {
  	array_push($errors, "Username is required");
  }*/
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($conn, $query);



  	if (mysqli_num_rows($results) == 1) {
  	  //$_SESSION['username'] = $username;
      $user = mysqli_fetch_assoc($results);
  	  $_SESSION['userID'] = $user['user_id'];
  	  header('location: home.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }

  mysqli_free_result($results);
  mysqli_close($conn);
}

?>
