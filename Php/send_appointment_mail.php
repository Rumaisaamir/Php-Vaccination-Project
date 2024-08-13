<?php
session_start();
?>


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if (isset($_POST['approve'])) {
    $center_approval_email = filter_var($_POST['center_username'], FILTER_SANITIZE_EMAIL);
    $approval_email_user = filter_var($_POST['appoint_email'], FILTER_SANITIZE_STRING);
    $approval_message = filter_var($_POST['appoint_reason'], FILTER_SANITIZE_STRING);
    $center_name = filter_var($_POST['center_name'], FILTER_SANITIZE_STRING);
    $approval_subject = "Appointment Confirmation";

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
        $mail->setFrom('vaxease@gmail.com' ,$center_name); 
        $mail->addAddress($approval_email_user); 
        $mail->Subject = ($approval_subject);

        // Set the body of the email to the same format as textarea content
        $mail->Body = nl2br($approval_message);

        $mail->send();

        $_SESSION['approval_message'] = "Appointment approved. Approval mail sent to the patient successfully.";
        header("Location: center_approved_appointments.php"); 

        // echo '<script>alert("Appointment approved. Approval email sent to the patient successfully.");</script>';
        // echo '<script>window.location.href = "center_approved_appointments.php";</script>';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}
?>



<?php
include "config.php";

if (isset($_POST['approve'])) {
  $update_id = $_POST['id'];
  $update_query = "UPDATE users SET status = 'Approved', active = 1 WHERE UserID = '$update_id'";
  // $update_query = "UPDATE users SET status = 'approved' WHERE UserID = '$update_id' ";
  $query_updated = $con->query($update_query);

  if ($query_updated === TRUE) {
    // Redirect after showing the alert
    echo '<script>alert("Appointment approved successfully.");</script>';
    echo '<script>window.location.href = "center_non_approve_appointment.php";</script>';
    exit();
  } else {
    echo "Error: " . $update_query . "<br>" . $con->error;
  }
}

if (isset($_POST['delete_appoint'])) {
  $delete_id = $_POST['id'];
  $delete_query = "DELETE FROM users WHERE UserID = '$delete_id' ";
  $query_deleted = $con->query($delete_query);

  if ($query_deleted === TRUE) {

    $_SESSION['delete_message'] = "Appointment deleted successfully.";
    header("Location: center_non_approve_appointment.php"); 

    // Redirect after showing the alert
    // echo '<script>alert("Appointment deleted successfully.");</script>';
    // echo '<script>window.location.href = "center_non_approve_appointment.php";</script>';
    exit();
  } else {
    echo "Error: " . $delete_query . "<br>" . $con->error;
  }
}
?>
