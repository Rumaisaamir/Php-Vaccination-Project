<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if(isset($_POST['subscribe'])){
  $userEmail = $_POST['news_email'];

  $sql = "SELECT name FROM login_details WHERE email = '$userEmail'";
  $result = $con->query($sql);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['name'];
  }

  $mail = new PHPMailer(true);

  try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vaxease@gmail.com';
    $mail->Password = 'mcqa kvmh ruiq esvx';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    $mail->isHTML(true);
    $mail->setFrom($userEmail, $username);
    $mail->addAddress('vaxease@gmail.com');
   
    $mail->Subject = ("$userEmail, Subscriber");
    $mail->Body = $username . " has subscribed to our website!";

    $mail->send();

    echo "<script>alert('Thank you for subscribing! You will now receive updates and important information from us.');</script>";
    echo '<script>window.location.href = "home.php";</script>';
  } catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "');</script>";
  }
}
?>