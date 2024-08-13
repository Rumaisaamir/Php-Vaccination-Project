<!-- User Logout -->

<?php
include 'config.php'; 
// session_name("UserSession");

session_start(); 

date_default_timezone_set("Asia/Karachi");
$logoutTime_user = date("h:i:sa");
$logoutDate_user = date("Y-m-d");

// $userName = $_SESSION['UserName'];
$session_id = $_SESSION['SessionID'];
$sql = "SELECT id FROM login_details WHERE session_id = '$session_id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
    }
};

$sql = "UPDATE login_details SET end_time = '$logoutTime_user', end_date = '$logoutDate_user' WHERE id = '$id'";

if ($con->query($sql) === TRUE) {
    echo "Logout time updated successfully.";
} else {
    echo "Error updating logout time: " . $con->error;
}

setcookie('UserName' ,$_SESSION['UserName'],60); 
setcookie('SessionID' ,$_SESSION['SessionID'],60); 
session_unset();
session_destroy();
header("Location: login.php");
exit;
?>