
<?php
include "config.php";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = md5($_POST['password_1']);
  $password_2 = md5($_POST['password_2']);

  if (empty($name) || empty($username) || empty($password_1) || empty($password_2)) {
    echo '<script>alert("All fields are required. Please fill out the entire form.")</script>';
  } else {
    $check_username_query = "SELECT * FROM sign_up WHERE username = '$username'";
    $check_username_result = $con->query($check_username_query);

    if ($check_username_result->num_rows > 0) {
      echo '<script>alert("Username already exists. Please choose a different username.")</script>';
    } else {
      $signup = "INSERT INTO sign_up (Name, email, username, password_1, password_2) 
      VALUES ('$name', '$email', '$username', '$password_1', '$password_2')";

      $result = $con->query($signup);

      if ($result == true) {
        echo '<script>alert("You have successfully registered on VaxEaseOnline."); window.location.href = "login.php";</script>';
        // header('location: login.php');

        exit();
      } else {
        echo "Error:" . $signup . "<br>" . $con->error;
      }
    }
  }

  $con->close();
}
;


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> VaxEaseOnline </title>
  <link rel="stylesheet" href="../css/form.css">
  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

</head>

<body>
  <div class="wrapper">
    <h2 class="sign_up">Registration</h2>
    <form action="" method="POST" id="registrationForm">
      <div class="input-box">
        <input type="text" name="name" placeholder="Enter Name">
      </div>
      <div class="input-box">
        <input type="text" name="username" placeholder="Enter Username">
      </div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter Email Address">
      </div>
      <div class="input-box">
        <input type="password" name="password_1" id="password_1" placeholder="Create Password">
      </div>
      <div class="input-box">
        <input type="password" name="password_2" id="password_2" placeholder="Confirm Password">
      </div>
      <div id="password_error" class="error"></div>
      <div class="input-box button">
        <input type="Submit" id="registerButton" name="submit" value="Register Now">
      </div>

      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>

<!-- passwords matches -->

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const password1 = document.getElementById("password_1");
      const password2 = document.getElementById("password_2");
      const passwordError = document.getElementById("password_error");
      const registrationForm = document.getElementById("registrationForm");
      const registerButton = document.getElementById("registerButton");

      password2.addEventListener("input", function () {
        if (password1.value !== password2.value) {
          passwordError.textContent = "Password does not match";
          registerButton.disabled = true; 
        } else {
          passwordError.textContent = "";
          registerButton.disabled = false; 
        }
      });

      registrationForm.addEventListener("submit", function (event) {
        if (password1.value !== password2.value) {
          event.preventDefault(); 
          passwordError.textContent = "Password does not match";
        }
      });
    });
  </script>



</body>

</html>