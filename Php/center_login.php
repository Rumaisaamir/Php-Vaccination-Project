<?php
// session_name("HospitalSession");
session_start();

if (isset($_SESSION['CenterUserName']) || isset($_COOKIE['CenterUserName'])) {
  if (isset($_SESSION['HospitalStatus']) || isset($_COOKIE['HospitalStatus'])) {
    if (isset($_SESSION['CenterSessionID']) || isset($_COOKIE['CenterSessionID'])) {
    if ($_SESSION['HospitalStatus'] === 'approved' || $_COOKIE['HospitalStatus'] === 'approved') {
      header('location: center.php');
      die();
    } elseif ($_SESSION['HospitalStatus'] === 'pending' || $_COOKIE['HospitalStatus'] === 'pending') {
    }
  }
}
}

include 'config.php';


if (isset($_POST["login"])) {
  $hospital_name = $_POST["hospital_name"];
  $password = md5($_POST["password"]);

  $sql1 = "SELECT * FROM center_sign_up WHERE email = '$hospital_name' AND password_1 = '$password'";
  $result = $con->query($sql1);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $uid = $row['center_id'];
    $hospital_name = $row['hospital_name'];
    $hospital_status = $row['hospital_status'];
    $hospital_appoint_email = $row['email'];

    $center_session_id = null;

    if ($hospital_status === 'approved') {
      date_default_timezone_set("Asia/Karachi");
      $start_time_hospital = date("h:i:sa");
      $start_date_hospital = date("Y-m-d");
      $endTime_hospital = 0;
      $end_date_hospital = 0;
      $center_session_id = rand(10000, 99999);
      $_SESSION['CenterSessionID'] = $center_session_id; 

      $sql123 = "INSERT INTO center_login_details (center_id, hospital_name, start_time, end_time, start_date, end_date , session_id , email) 
                 VALUES ('$uid', '$hospital_name', '$start_time_hospital', '$endTime_hospital', '$start_date_hospital', '$end_date_hospital' , '$center_session_id' , '$hospital_appoint_email')";
      $result123 = $con->query($sql123);
    }

    // session and cookie for hospital_name and hospital_status
    $_SESSION['CenterUserName'] = $hospital_name;
    $_SESSION['HospitalStatus'] = $hospital_status;
    $_SESSION['CenterSessionID'] = $center_session_id;


    // Cookie for 1 month

    setcookie('CenterUserName', $hospital_name, time() + 60 * 60 * 24 * 30);
    setcookie('HospitalStatus', $hospital_status, time() + 60 * 60 * 24 * 30);
    setcookie('CenterSessionID', $center_session_id, time() + 60 * 60 * 24 * 30);

    // Cookie for 10 seconds

    // setcookie('CenterUserName', $hospital_name, time() + 10);
    // setcookie('HospitalStatus', $hospital_status, time() + 10);


    if ($hospital_status === 'approved') {
      header('location: center.php');
      exit();
    } elseif ($hospital_status === 'pending') {
      echo '<script>';
      echo 'alert("Your account is still pending for admin approval.");';
      echo '</script>';
    } 
  } else {
    echo '<script>';
    echo 'alert("Incorrect username or password.");';
    echo '</script>';
  }
}

$con->close();
?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> VaxEaseOnline </title>
  <link rel="stylesheet" href="../css/form.css">
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">
</head>
<body>
  <div class="wrapper">
    <h2 class="sign_up">Login</h2>
    <form action="" method="POST" id="registrationForm">
      <div class="input-box">
        <input type="text" name="hospital_name" placeholder="Username or email">
      </div>
      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
      <div id="password_error" class="error"></div>

      <div class="input-box button">
        <input type="Submit" id="registerButton" name="login" value="LOGIN">
      </div>

      <div class="text">
        <h3>Already have an account? <a href="center_signup.php">Sign Up</a></h3>
      </div>

    </form>
  </div>




</body>

</html>