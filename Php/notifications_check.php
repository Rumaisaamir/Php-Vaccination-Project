<?php

include "config.php";

// Active notifications ko retrieve karein
$active_notifications_query = "SELECT * FROM users WHERE active = 1";
$active_notifications_result = mysqli_query($con, $active_notifications_query);

// Active notifications ka count karein
$count_active = mysqli_num_rows($active_notifications_result);

// Active notifications ko array mein store karein
$notifications_data = array();
while ($row = mysqli_fetch_assoc($active_notifications_result)) {
    $notifications_data[] = $row;
}

// Deactive notifications ko retrieve karein
$deactive_notifications_query = "SELECT * FROM users WHERE active = 0 ORDER BY UserID DESC LIMIT 5";
$deactive_notifications_result = mysqli_query($con, $deactive_notifications_query);

// Deactive notifications ko array mein store karein
$deactive_notifications_dump = array();
while ($row = mysqli_fetch_assoc($deactive_notifications_result)) {
    $deactive_notifications_dump[] = $row;
}

?>