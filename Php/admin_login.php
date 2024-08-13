<?php
session_name("AdminSession");
session_start();

if (isset($_SESSION['admins_name']) || isset($_COOKIE['admins_name'])) {
  header('location: admin.php');
  die();
}
include 'config.php';

if (isset($_POST["admin"])) {
  $user_name = $_POST["username"];
  $password = $_POST["password"];

  $sql1 = "SELECT * FROM admin WHERE Admin_name = '$user_name' AND Admin_password = '$password'";
  $result = $con->query($sql1);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admins_names = $row['Admin_name'];
   

    // set session and cookie
    $_SESSION['admins_name'] = $admins_names;
    setcookie('admins_name', $admins_names, time() + 60 * 60 * 24 * 30);

    header("location: admin.php");
    exit();
  } else {
    echo '<script>alert("Login failed. Please check your admin_name and admin_password.")</script>';
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
    <form action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" method="POST" id="registrationForm">
      <div class="input-box">
        <input type="text" name="username" placeholder="Admin name">
      </div>
      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Admin password">
      </div>
      <div id="password_error" class="error"></div>
      <div class="input-box button">
        <input type="Submit" id="registerButton" name="admin" value="LOGIN">
      </div>
    </form>
  </div>
</body>
</html>