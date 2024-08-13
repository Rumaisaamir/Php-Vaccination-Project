<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
include "config.php";

$Name = "";
$Age = "";
$Contact_Number = "";
$NIC_Number = "";
$Email_Address = "";
$Date_of_Vaccination = "";
$Gender = "";
$Preferred_Center = "";
$Vaccination_Type = "";
$Booking_Slots = "";
$Dose = "";
$id = 0;
$edit_state = false;

// Data inserted

if(isset($_POST['submit'])){
  $Name = isset($_POST['Name']) ? $_POST['Name'] : '';
  $Age = isset($_POST['Age']) ? $_POST['Age'] : '';
  $Contact_Number = isset($_POST['Contact_Number']) ? $_POST['Contact_Number'] : '';
  $NIC_Number = isset($_POST['NIC_Number']) ? $_POST['NIC_Number'] : '';
  $Email_Address = isset($_POST['Email_Address']) ? $_POST['Email_Address'] : '';
  $Date_of_Vaccination = isset($_POST['Date_of_Vaccination']) ? $_POST['Date_of_Vaccination'] : '';
  $Gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
  $Preferred_Center = isset($_POST['Preferred_Center']) ? $_POST['Preferred_Center'] : '';
  $Vaccination_Type = isset($_POST['Vaccination_Type']) ? $_POST['Vaccination_Type'] : '';
  $Booking_Slots = isset($_POST['Booking_Slots']) ? $_POST['Booking_Slots'] : '';
  $Dose = isset($_POST['Dose']) ? $_POST['Dose'] : '';

  // SQL Injections

  $Name = $con->real_escape_string($Name);
  $Age = $con->real_escape_string($Age);
  $Contact_Number = $con->real_escape_string($Contact_Number);
  $NIC_Number = $con->real_escape_string($NIC_Number);
  $Email_Address = $con->real_escape_string($Email_Address);
  $Date_of_Vaccination = $con->real_escape_string($Date_of_Vaccination);
  $Gender = $con->real_escape_string($Gender);
  $Preferred_Center = $con->real_escape_string($Preferred_Center);
  $Vaccination_Type = $con->real_escape_string($Vaccination_Type);
  $Booking_Slots = $con->real_escape_string($Booking_Slots);
  $Dose = $con->real_escape_string($Dose);

  if (empty($Name) || empty($Age) || empty($Contact_Number) || empty($NIC_Number) || empty($Email_Address) || empty($Date_of_Vaccination) || empty($Gender) || empty($Preferred_Center) || empty($Vaccination_Type) || empty($Booking_Slots) || empty($Dose)) {
      echo '<script> alert("Please fill out all the fields before booking an appointment.")</script>';
  } else {
        // get  username session of login user
        $username = $_SESSION['UserName'];

        // Generate a random appointment ID
        $appointment_id = sprintf("%07d", rand(0, 9999999));
        // $appointment_id = uniqid();

        $stmt = $con->prepare("INSERT INTO users (Name, Age, Contact_Number, NIC_Number, Email_Address, Date_of_Vaccination, Gender, Preferred_Center, Vaccination_Type, Booking_Slots, Dose, status, appointment, username, report, appointment_id, active, send_report) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', 'Pending', ?, 'Inprocess', ?, 0, 'Unsent')");
        $stmt->bind_param("sisssssssssss", $Name, $Age, $Contact_Number, $NIC_Number, $Email_Address, $Date_of_Vaccination, $Gender, $Preferred_Center, $Vaccination_Type, $Booking_Slots, $Dose, $username, $appointment_id);

        if ($stmt->execute()) {
            $_SESSION['my_appointment_message'] = "Your appointment confirmation is in process!";
            header("Location: my_appointment.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $con->close();
};


// data updated

if (isset($_POST['update'])) {
    $Name = $_POST['Name'];
    $Age = $_POST['Age'];
    $Contact_Number = $_POST['Contact_Number'];
    $NIC_Number = $_POST['NIC_Number'];
    $Email_Address = $_POST['Email_Address'];
    $Date_of_Vaccination = $_POST['Date_of_Vaccination'];
    $Gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
    $Preferred_Center = isset($_POST['Preferred_Center']) ? $_POST['Preferred_Center'] : '';
    $Vaccination_Type = isset($_POST['Vaccination_Type']) ? $_POST['Vaccination_Type'] : '';
    $Booking_Slots = isset($_POST['Booking_Slots']) ? $_POST['Booking_Slots'] : '';
    $Dose = isset($_POST['Dose']) ? $_POST['Dose'] : '';
    $id = $_POST['id'];

    // update the record
    $sql = "UPDATE users SET Name=?, Age=?, Contact_Number=?, NIC_Number=?, Email_Address=?, Date_of_Vaccination=?, Gender=?, Preferred_Center=?, Vaccination_Type=?, Booking_Slots=?, Dose=? WHERE UserID=?";
    $stmt = $con->prepare($sql);

    // bind Parameters
    $stmt->bind_param("sssssssssssi", $Name, $Age, $Contact_Number, $NIC_Number, $Email_Address, $Date_of_Vaccination, $Gender, $Preferred_Center, $Vaccination_Type, $Booking_Slots, $Dose, $id);

    if ($stmt->execute()) {
        $_SESSION['my_appointment_update_message'] = "Your appointment details have been updated successfully.";
        header("Location: my_appointment.php"); 

        // header('location: my_appointment.php');
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}


    // Delete Records

    if (isset($_GET['del'])) {
        $user_id = $_GET['del'];


        $delete = "DELETE FROM `users` WHERE `UserID`='$user_id'";
        $con->query($delete);

        $_SESSION['my_appointment_delete_message'] = "Your appointment has been canceled successfully.";
        header("Location: my_appointment.php"); 

        // header('location: my_appointment.php');

    };

?>