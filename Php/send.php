<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if (isset($_POST['contact_send'])) {
    $name = filter_var($_POST['contact_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['contact_email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['contact_subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['contact_message'], FILTER_SANITIZE_STRING);

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
        $mail->setFrom($email, $name);
        $mail->addAddress("vaxease@gmail.com");
        $mail->Subject = ("$email, $subject");
        $mail->Body = $message;

        $mail->send();

        echo '<script>alert("Thank you for contacting us! We will get back to you as soon as possible.");</script>';
        echo '<script>window.location.href = "home.php";</script>';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
