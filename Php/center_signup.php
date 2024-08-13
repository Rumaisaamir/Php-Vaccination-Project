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
    <h2 class="sign_up">Registration</h2>
    <form action="" method="POST" id="registrationForm">
<div class="input-box">
<select name="hospital_name" id="hospital_name" class="form-select">
        <option value="" selected disabled>Select Hospital</option>
        <option value="Aga Khan University Hospital">Aga Khan University Hospital</option>
        <option value="Indus Hospital">Indus Hospital</option>
        <option value="Dow University Hospital">Dow University Hospital</option>
        <option value="Jinnah Postgraduate Medical">Jinnah Postgraduate Medical</option>
        <option value="Liaquat National Hospital">Liaquat National Hospital</option>
    </select>
</div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter Email Address">
      </div>
      <div class="input-box">
        <input type="text" name="contact" placeholder="Enter Contact Number">
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
        <h3>Already have an account? <a href="center_login.php">Login now</a></h3>
      </div>
    </form>
  </div>

  <?php
include "config.php";

if (isset($_POST['submit'])) {
  $hospital_name = isset($_POST['hospital_name']) ? $_POST['hospital_name'] : '';
  // $hospital_name = $_POST['hospital_name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password_1 = md5($_POST['password_1']);
  $password_2 = md5($_POST['password_2']);

  if (empty($hospital_name) || empty($email) || empty($contact) || empty($password_1) || empty($password_2)) {
    echo '<script>alert("All fields are required. Please fill out the entire form.")</script>';
  } else {
    $check_hospital_name_query = "SELECT * FROM center_sign_up WHERE hospital_name = '$hospital_name'";
    $check_hospital_name_result = $con->query($check_hospital_name_query);

    if ($check_hospital_name_result->num_rows > 0) {
      echo '<script>alert("Hospital name already exists. Please choose a different hospital name.")</script>';
    } else {
      $signup = "INSERT INTO center_sign_up (hospital_name, email, contact_number, password_1, password_2 , hospital_status) 
      VALUES ('$hospital_name', '$email', '$contact', '$password_1', '$password_2' , 'pending')";
      $result = $con->query($signup);

      // if ($result == true) {
        echo '<script> alert("Your account is pending for admin approval!"); window.location.href = "center_login.php";</script>';
        // header('location: center_login.php');

        exit();
      // } 
      // else {
      //   echo "Error:" . $signup . "<br>" . $con->error;
      // }
    }
  }

  $con->close();
}
;


?>

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
          registerButton.disabled = true; // Disable the button
        } else {
          passwordError.textContent = "";
          registerButton.disabled = false; // Enable the button
        }
      });
      registrationForm.addEventListener("submit", function (event) {
        if (password1.value !== password2.value) {
          event.preventDefault(); // Prevent form submission
          passwordError.textContent = "Password does not match";
        }
      });
    });
  </script>
</body>
</html>