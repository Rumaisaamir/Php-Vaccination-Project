<?php
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if(isset($_POST['subscribe'])){
  $userEmail = $_POST['news_email'];

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
    $mail->setFrom($userEmail);
    $mail->addAddress('vaxease@gmail.com', 'Mohammad Ali');
   
    $mail->Subject = ("$userEmail (Subscriber)");
    $mail->Body = $userEmail . " has subscribed to your website!";

    $mail->send();

    echo "<script>alert('Thank you for subscribing to our website!');</script>";
    echo '<script>window.location.href = "center.php";</script>';
  } catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "');</script>";
  }
}
?>