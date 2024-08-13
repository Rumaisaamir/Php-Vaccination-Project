<?php
include 'config.php'; 
// session_name("HospitalSession");

session_start(); 

date_default_timezone_set("Asia/Karachi");
$logoutTime_hospital = date("h:i:sa");
$logoutDate_hospital = date("Y-m-d");

// $CenterUserNamesss = $_SESSION['CenterUserName'];
$center_session_id = $_SESSION['CenterSessionID'];
$sql = "SELECT id FROM center_login_details WHERE session_id = '$center_session_id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
    }
};

$sql = "UPDATE center_login_details SET end_time = '$logoutTime_hospital', end_date = '$logoutDate_hospital' WHERE id = '$id'";

if ($con->query($sql) === TRUE) {
    echo "Logout time updated successfully.";
} else {
    echo "Error updating logout time: " . $con->error;
}

setcookie('CenterUserName' ,$_SESSION['CenterUserName'],60); 
setcookie('HospitalStatus' ,$_SESSION['HospitalStatus'],60); 
setcookie('CenterSessionID' ,$_SESSION['CenterSessionID'],60); 
session_unset();
session_destroy();
header("Location: center_login.php");
exit;
?>