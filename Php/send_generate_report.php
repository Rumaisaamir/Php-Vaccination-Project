<?php
session_start();
?>

<?php
include "config.php";

if(isset($_POST['send_report'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $appointmentId = $_POST['appointmentId'];
    $dateOfVaccination = $_POST['dateOfVaccination'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $dosage = $_POST['dosage'];
    $vaccinationtype = $_POST['vaccinationtype'];
    $result = $_POST['result'];
    $hospital = $_POST['hospital'];
    $email = $_POST['email'];
    $nic_number = $_POST['nic_number'];
    $time = $_POST['time'];

    $stmt = $con->prepare("SELECT UserID FROM users WHERE appointment_id = ?");
    $stmt->bind_param("s", $appointmentId);
    $stmt->execute();
    $stmt->bind_result($userID);
    $stmt->fetch();
    $stmt->close();

    // Prevent SQL injection
    // $stmt = $con->prepare("INSERT INTO vaccination_reports (name, age, appointment_id, date_of_vaccination, gender, contact_number, dosage, vaccination_type, result, preferred_center) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("sisssissss", $name, $age, $appointmentId, $dateOfVaccination, $gender, $contactNo, $dosage, $vaccinationtype, $result, $hospital);

    // Insert data into database

    if ($userID) {

        $stmt = $con->prepare("INSERT INTO vaccination_reports (UserID, name, age, appointment_id, date_of_vaccination, gender, contact_number, dosage, vaccination_type, result, preferred_center, email, nic_number, time, send_report) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Unsent')");
        $stmt->bind_param("isisssssssssss", $userID, $name, $age, $appointmentId, $dateOfVaccination, $gender, $contactNo, $dosage, $vaccinationtype, $result, $hospital, $email, $nic_number, $time);

        // $stmt = $con->prepare("INSERT INTO vaccination_reports (UserID, name, age, appointment_id, date_of_vaccination, gender, contact_number, dosage, vaccination_type, result, preferred_center, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // $stmt->bind_param("isisssssssss", $userID, $name, $age, $appointmentId, $dateOfVaccination, $gender, $contactNo, $dosage, $vaccinationtype, $result, $hospital, $email);


    // $stmt = $con->prepare("INSERT INTO vaccination_reports (name, age, appointment_id, date_of_vaccination, gender, contact_number, dosage, vaccination_type, result, preferred_center, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("sisssisssss", $name, $age, $appointmentId, $dateOfVaccination, $gender, $contactNo, $dosage, $vaccinationtype, $result, $hospital, $email);

    if ($stmt->execute()) {
        $update_stmt = $con->prepare("UPDATE users SET report = 'Generated' WHERE appointment_id = ?");
        $update_stmt->bind_param("i", $appointmentId);
        
        if ($update_stmt->execute()) {
            $_SESSION['generate_message'] = "Vaccination report generated successfully.";
            header("Location: send_report_db.php"); 

            // echo "<script>alert('Vaccination report generated successfully.'); window.location.href = 'send_report_db.php';</script>";
        } else {
            echo "<script>alert('Error updating users table: " . $update_stmt->error . "');</script>";
        }
        
        $update_stmt->close();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('No user found with the given appointment ID');</script>";
}
}
$con->close();
?>