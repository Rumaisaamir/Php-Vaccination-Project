<?php
// User Login

// session_name("UserSession");
session_start();

if (isset($_SESSION['UserName']) || isset($_COOKIE['UserName'])) {
  if (isset($_SESSION['SessionID']) || isset($_COOKIE['SessionID'])) {
  header('location: home.php');
  die();
}}
include 'config.php';

if (isset($_POST["login"])) {
  $user_name = $_POST["username"];
  $password = md5($_POST["password"]);

  $sql1 = "SELECT * FROM sign_up WHERE username = '$user_name' AND password_1 = '$password'";
  $result = $con->query($sql1);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $uid = $row['id'];
    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];

    date_default_timezone_set("Asia/Karachi");
    $start_time_user = date("h:i:sa");
    $start_date_user = date("Y-m-d");
    $endTime_user = 0;
    $end_date_user = 0;
    // random session ID
    $session_id = rand(10000, 99999);
    $_SESSION['SessionID'] = $session_id;

    $sql123 = "INSERT INTO login_details (user_id, name, user_name, email, start_time, end_time, start_date, end_date, session_id) 
               VALUES ('$uid', '$name', '$user_name', '$email', '$start_time_user', '$endTime_user', '$start_date_user', '$end_date_user', '$session_id')";
    $result123 = $con->query($sql123);

    // set sessions and cookies
    $_SESSION['UserName'] = $username;
     

    setcookie('UserName', $username, time() + 60 * 60 * 24 * 30);
    setcookie('SessionID', $session_id, time() + 60 * 60 * 24 * 30);

    header("location: home.php");
    exit();

      } else {
        echo '<script>alert("Incorrect username or password.")</script>';
      }
    }
    $con->close();
    ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> VaxEaseOnline</title>
  <link rel="stylesheet" href="../css/form.css">
  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">
</head>

<body>
  <div class="wrapper">
    <h2 class="sign_up">Login</h2>
    <form action="" method="POST" id="registrationForm">

      <div class="input-box">
        <input type="text" name="username" placeholder="Username or email">
      </div>

      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
      <div id="password_error" class="error"></div>

      <div class="input-box button">
        <input type="Submit" id="registerButton" name="login" value="LOGIN">
      </div>



      <div class="text">
        <h3>Already have an account? <a href="signup.php">Sign Up</a></h3>
      </div>

    </form>
  </div>




</body>

</html>