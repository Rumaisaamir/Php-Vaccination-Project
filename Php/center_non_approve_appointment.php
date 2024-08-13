<?php
session_start();
if (!isset($_COOKIE['CenterUserName']) || !isset($_COOKIE['HospitalStatus']) || !isset($_COOKIE['CenterSessionID'])) {
  header('location: center_login.php');
  die();
};

$_SESSION['CenterSessionID'] = $_COOKIE['CenterSessionID'];
$_SESSION['CenterUserName'] = $_COOKIE['CenterUserName'];
$_SESSION['HospitalStatus'] = $_COOKIE['HospitalStatus'];
$Hospital_Name = $_SESSION['CenterUserName'];


include "config.php";

if (isset($_POST['approve'])) {
  $update_id = $_POST['id'];
  $update_query = "UPDATE users SET status = 'Approved', active = 1 WHERE UserID = '$update_id'";
  // $update_query = "UPDATE users SET status = 'approved' WHERE UserID = '$update_id' ";
  $query_updated = $con->query($update_query);

  if ($query_updated === TRUE) {
    header('location: center_non_approve_appointment.php');
    exit();
  } else {
    echo "Error: " . $update_query . "<br>" . $con->error;
  }
}

if (isset($_POST['delete'])) {
  $delete_id = $_POST['id'];
  $delete_query = "DELETE FROM users WHERE UserID = '$delete_id' ";
  $query_deleted = $con->query($delete_query);

  if ($query_deleted === TRUE) {
    $_SESSION['delete_message'] = "Appointment deleted successfully.";
    header("Location: center_non_approve_appointment.php"); 

    // echo '<script>alert("Appointment deleted successfully.");</script>';
    // echo '<script>window.location.href = "center_non_approve_appointment.php";</script>';
    exit();
  } else {
    echo "Error: " . $delete_query . "<br>" . $con->error;
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>VaxEaseOnline</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- plugins css Files -->
  <link href="../plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../plugins/animate.css/animate.min.css" rel="stylesheet">
  <link href="../plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../plugins/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../plugins/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../plugins/remixicon/remixicon.css" rel="stylesheet">
  <link href="../plugins/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!--  Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/appointment.css" rel="stylesheet">
  <link href="../css/dashboard.css" rel="stylesheet">
  <link href="../css/approveform.css" rel="stylesheet">

</head>
<body>



<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
  <div class="container d-flex justify-content-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope"></i> <a href="#">vaxease@gmail.com</a>
      <i class="bi bi-phone"></i> +92 320 360 7386
    </div>
    <div class="d-none d-lg-flex social-links align-items-center">
      <a href="center_profile.php" class="twitter"><i class="bi bi-person-fill"></i> Profile</a>
      <a class="linkedin"><i class="bi bi-h-square"></i> <?php echo $_SESSION['CenterUserName']?></a>
      <form action="center_logout.php" method="post">
        <button class="nav-link scrollto" type="submit" name="logout">
          <a class="linkedin"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </button>
      </form>
    </div>
  </div>
</div>



<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="center.php" id="ali">VaxEaseOnline</a></h1>
    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a class="nav-link scrollto active" href="center.php#hero">Home</a></li>
        <li><a class="nav-link scrollto" href="center.php#about">About</a></li>
        <li><a class="nav-link scrollto" href="center.php#services">Services</a></li>
        <li><a class="nav-link scrollto" href="center.php#departments">Hospitals</a></li>
        <li><a class="nav-link scrollto" href="center.php#faq">FAQs</a></li>
        <li><a class="nav-link scrollto" href="center.php#gallery">Gallery</a></li>
        <li><a class="nav-link scrollto" href="center.php#contact">Contact</a></li>
        <li><a class="nav-link scrollto" href="center_all_appointments.php">Dashboard</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header><!-- End Header -->



  <!-- Main Dashboard + Sidebar -->
  <div id="dashboard_main_box" style="background:;">
    <div class="sidebar">
        <nav>
        <ul class="sidebar_link">
        <li class="anchor_li"><a class="anchor_1" href="../php/center_all_appointments.php"><i class="bi bi-speedometer2"></i> &nbsp;Hospital Dashboard</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/center_all_appointments.php"><i class="bi bi-calendar-check"></i> &nbsp;Total Appointments</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/center_non_approve_appointment.php"><i class="fa fa-ban" aria-hidden="true"></i> &nbsp;Pending Appointments</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/center_approved_appointments.php"><i class="fa fa-clock" aria-hidden="true"></i> &nbsp;Awaiting Vaccinations</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/generate_report.php"><i class="fa fa-file" aria-hidden="true"></i> &nbsp;Generate Vaccinations Report</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/send_report_db.php"><i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;Send Vaccinations Report</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/vaccinated_appointments.php"><i class="fa fa-check-circle" aria-hidden="true"></i> &nbsp;Completed Vaccinations</a></li>
        </ul>
        </nav>
    </div>



<!-- Dashboard Data -->
    <div class="boxes" style="background:;">
    <br>
    <!-- Main Boxes Div -->
    <div class="container-fluid" style="background:;">
    <div class="row">



<!-- Total Appointments -->
<?php
include "config.php";

$query1 = "SELECT COUNT(*) as patient_count FROM users WHERE Preferred_Center = '$Hospital_Name'";
$result1 = $con->query($query1);

if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) {
        $patient_count = $row1["patient_count"];
    }
} else {
    $patient_count = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/center_all_appointments.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Appointments
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $patient_count; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i id="icon" class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


<!-- Pending Appointments -->
<?php
include "config.php";

$query3 = "SELECT COUNT(*) as pending_appointment FROM users WHERE status = 'Pending' AND appointment = 'Pending' AND report = 'Inprocess' AND Preferred_Center = '$Hospital_Name'";
$result3 = $con->query($query3);

if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $pending_appointment = $row3["pending_appointment"];
    }
} else {
    $pending_appointment = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/center_non_approve_appointment.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                            Pending Appointments
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $pending_appointment; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i id="icon" class="fa fa-ban" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


<!-- Approve Appointments -->
<?php
include "config.php";

$query2 = "SELECT COUNT(*) as total_appointment FROM users WHERE status = 'Approved' AND appointment = 'Pending' AND report = 'Inprocess' AND Preferred_Center = '$Hospital_Name'";
$result2 = $con->query($query2);

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $total_appointment = $row2["total_appointment"];
    }
} else {
    $total_appointment = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/center_approved_appointments.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                            Awaiting Vaccinations
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $total_appointment; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i id="icon" class="fa fa-clock" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


<!-- Generate Report -->
<?php
include "config.php";

$query2 = "SELECT COUNT(*) as generate_report FROM users WHERE status = 'Approved' AND  appointment = 'Vaccinated' AND report = 'Inprocess' AND Preferred_Center = '$Hospital_Name'";
$result2 = $con->query($query2);

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $generate_report = $row2["generate_report"];
    }
} else {
    $generate_report = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/generate_report.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                            Generate Vaccinations Report
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $generate_report; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i id="icon" class="fa fa-file"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


<!-- Send Report -->
<?php
include "config.php";

$query3 = "SELECT COUNT(*) as send_report FROM vaccination_reports WHERE send_report = 'Unsent' And preferred_center = '$Hospital_Name'";
$result3 = $con->query($query3);

if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $send_report = $row3["send_report"];
    }
} else {
    $send_report = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/send_report_db.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                            Send Vaccinations Report
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $send_report; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i id="icon" class="fa fa-paper-plane" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


<!-- Vaccinated Appointments -->
<?php
include "config.php";

$query3 = "SELECT COUNT(*) as vaccinated_appointment FROM vaccination_reports WHERE send_report = 'send' AND Preferred_Center = '$Hospital_Name'";
$result3 = $con->query($query3);

if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $vaccinated_appointment = $row3["vaccinated_appointment"];
    }
} else {
    $vaccinated_appointment = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/vaccinated_appointments.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                           Completed Vaccinations
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $vaccinated_appointment; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i id="icon" class="fa-solid fa-syringe" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    <a>
    <!-- </a> -->
</div>

<!-- <div class="alert alert-success" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center;">
  This is a success!
</div> -->

<?php
        if(isset($_SESSION['delete_message'])) {
            echo '<div class="alert alert-danger" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; justify-content: center">' . $_SESSION['delete_message'] . '</div>';
            unset($_SESSION['delete_message']); // Clear the session variable
        }
?>
<br>

<!-- Data Table -->
<?php 
include "config.php";

// Fetch and sanitize the search query
$pending_appointment_search_query = isset($_GET['pending_appointment_search_query']) ? $_GET['pending_appointment_search_query'] : '';
$pending_appointment_search_query = mysqli_real_escape_string($con, $pending_appointment_search_query);

$get_pending_appointment = "SELECT * FROM users WHERE status = 'Pending' AND appointment = 'Pending' AND report = 'Inprocess' AND Preferred_Center = '$Hospital_Name'";

// Modify the SQL query to search for appointment IDs starting with the given input
if (!empty($pending_appointment_search_query)) {
    $get_pending_appointment .= " AND appointment_id LIKE '$pending_appointment_search_query%'";
}
$pending_appointment_result = $con->query($get_pending_appointment);

?>


<div style="margin-bottom:-25px;" class="section-title">
<h2 id="h2_ki_id_doctor" style="color:#55a1e4;">Pending Appointments</h2>
</div>

<div id="generate_div">
    <form method="get">
        <div style="display: flex;">
            <input type="search" id="generate_div_searchbar" name="pending_appointment_search_query" placeholder="Enter Appointment No." value="<?php echo isset($pending_appointment_search_query) ? $pending_appointment_search_query : ''; ?>" style="width: 750px; padding: 5px; border: 1px solid #1977cc; border-radius: 3px;" required>
            <button type="submit" style="padding: 6px 12px; background-color: #1977cc; color: white; border: none; border-radius: 3px; cursor: pointer;">Search</button>
        </div>
    </form>
</div>

<br>

<div id="appointment_table_div_doctor" class="table-container" style="width: 100%; overflow-x: auto;">
<table class="table" style="width: 100%; white-space: nowrap;">
    <thead class="table-dark border">
         <tr>
             <th scope="col" style="background-color: #83baeb; color:white; border-left: 1px solid #83baeb; padding: 8px;">Appointment ID</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Name</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Age</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Contact Number</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">NIC Number</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Email Address</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Date of Vaccination</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Gender</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Center Address</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Vaccine Manufacturer</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Time of Vaccination</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Dose</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Appointment Status</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Vaccine Status</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Report Status</th>
             <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Report Send</th>
             <th scope="col" style="background-color: #83baeb; color:white; border-right: 1px solid #83baeb; padding: 8px;">Actions</th>
        </tr>
    </thead>
<tbody>

<?php
    if ($pending_appointment_result->num_rows > 0) {
    while ($row = $pending_appointment_result->fetch_assoc()) {
?>

    <tr>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['appointment_id']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Name']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Age']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Contact_Number']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['NIC_Number']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Email_Address']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Date_of_Vaccination']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Gender']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Preferred_Center']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Vaccination_Type']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Booking_Slots']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['Dose']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['status']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['appointment']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['report']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['send_report']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;">
		<form action="center_non_approve_appointment.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row['UserID']; ?>"/>
        <!-- <a style="padding:0px 15px 0px 15px; border-radius: 0px;" id="approve_btns" class="btn" href="appointment_confirmation.php?Email_Address=<?php echo $row['Email_Address']; ?>&id=<?php echo $row['UserID']; ?>&appointment_id=<?php echo urlencode($row['appointment_id']); ?>&Booking_Slots=<?php echo urlencode($row['Booking_Slots']); ?>&Date_of_Vaccination=<?php echo urlencode($row['Date_of_Vaccination']); ?>&Name=<?php echo urlencode($row['Name']); ?>">Approve</a> -->
		<a title="Approve Appointment" style="padding:0px 15px 0px 15px; border-radius: 0px;" id="approve_btns" class="btn " name="approve" href="appointment_confirmation.php?appointment_id=<?php echo $row['appointment_id']; ?>">Approve</a>
		<input title="Reject Appointment" style="padding:0px 15px 0px 15px; border-radius: 0px;" id="doctor_delete_btns" type="submit" class="btn " name="delete" value="Reject"> 
		</form>
        </td>
    </tr>
<?php       
}
}
?>
</tbody>
</table>
</div>

<?php
if (!empty($pending_appointment_search_query) && $pending_appointment_result->num_rows == 0) {
    echo '<div id="appointment_table_div_doctor_2" class="table-container" style="width: 100%; overflow-x: auto;">
            <table class="table" style="width: 100%; white-space: nowrap;">
                <thead class="table-danger border">
                    <tr>
                        <th style="color: red;" colspan="12">No appointment found for ID: ' . htmlentities($pending_appointment_search_query) . '</th>
                    </tr>
                </thead>
            </table>
          </div>';
}
?>



  <!-- plugins js Files -->
  <script src="../plugins/purecounter/purecounter_vanilla.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/glightbox/js/glightbox.min.js"></script>
  <script src="../plugins/swiper/swiper-bundle.min.js"></script>
  <script src="../plugins/php-email-form/validate.js"></script>

  <!--  Main JS File -->
  <script src="../js/main.js"></script>
</body>
</html>