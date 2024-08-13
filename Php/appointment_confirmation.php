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
$Center_ID = $_SESSION['CenterSessionID'];

include "config.php";

$emailget = "SELECT email, hospital_name FROM center_login_details WHERE session_id = '$Center_ID'";
$emailresult = $con->query($emailget); 

$contactNumberQuery = "SELECT contact_number FROM center_sign_up WHERE hospital_name = '$Hospital_Name'";
$result = mysqli_query($con, $contactNumberQuery);
$row = mysqli_fetch_assoc($result);
$contactNumber = $row['contact_number'];

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
  <link rel="stylesheet" href="../css/approveform.css">

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
        <li class="anchor_li"><a class="anchor" href="../php/generate_report.php"><i class="fa fa-file" aria-hidden="true"></i> &nbsp;Generate Vaccination Report</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/send_report_db.php"><i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;Send Vaccination Report</a></li>
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
                            Generate Vaccination Report
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

$query3 = "SELECT COUNT(*) as send_report FROM vaccination_reports WHERE preferred_center = '$Hospital_Name'";
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
                            Send Vaccination Report
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



<div style="margin-bottom:-25px;" class="section-title">
<h2 id="h2_ki_id_doctor_2" style="color:#55a1e4;">Send Appointment Approval</h2>
</div>

<div style="display: flex; justify-content: center; margin-bottom: 20px;">
<form action="send_appointment_mail.php" method="POST" id="approve_form">

<?php
    if ($emailresult->num_rows > 0) {
    while ($row = $emailresult->fetch_assoc()) {
?>

    <label id="approval_text" for="center_username">Hospital Email:</label><br>
    <input type="text" id="emailss" name="center_username" value="<?php echo $row['email']; ?>" readonly><br><br>
    
    <input type="hidden" id="emailss" name="center_name" value="<?php echo $row['hospital_name']; ?>">

<?php
      }
    }
?>

<?php
include "config.php";

if (isset($_GET['appointment_id']) && is_numeric($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM users WHERE appointment_id = ?");
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    $stmt->close();
}
?>

<label id="approval_text" for="email">Patient Email:</label><br>
<input type="text" id="emailss" name="appoint_email" value="<?php echo $row['Email_Address']; ?>" readonly><br><br>

<label id="approval_text" for="time">Vaccination Time:</label><br>
<input type="text" id="emailss" name="time" value="<?php echo $row['Booking_Slots']; ?>" readonly><br><br>

<label id="approval_text" for="date">Vaccination Date:</label><br>
<input type="text" id="emailss" name="id" value="<?php echo $row['Date_of_Vaccination']; ?>" readonly><br><br>


    <label id="approval_text" for="reason">Approval Message:</label><br>
    <textarea style="resize:none; width: 860px; height: 455px; padding: 7px; border: 1px solid #7fbaef; border-radius: 3px; overflow-y: hidden;" id="reason" name="appoint_reason" rows="4" cols="50" readonly></textarea><br><br>

    <!-- <textarea style="resize:none; width: 750px; padding: 7px; border: 1px solid #1977cc; border-radius: 3px;" id="reason" name="appoint_reason" rows="4" cols="50" readonly></textarea><br><br> -->
    
    <input type="hidden" name="id" value="<?php echo $row['UserID']; ?>">
    <input title="Approve Appointment" style="padding:0px 15px 0px 15px; border-radius: 0px;" id="approve_btns" class="btn" type="submit" name="approve" value="Approve">
    <input title="Reject Appointment" style="padding:0px 15px 0px 15px; border-radius: 0px;" id="doctor_delete_btns" class="btn" type="submit" name="delete_appoint" value="Reject">
    <a title="Back" style="padding:0px 15px 0px 15px; border-radius: 0px;" href="center_non_approve_appointment.php" id="doctor_back_btns" class="btn">Back</a>
</form>
  </div>



      <!-- plugins js Files -->
  <script src="../plugins/purecounter/purecounter_vanilla.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/glightbox/js/glightbox.min.js"></script>
  <script src="../plugins/swiper/swiper-bundle.min.js"></script>
  <script src="../plugins/php-email-form/validate.js"></script>

  <!--  Main JS File -->
  <script src="../js/main.js"></script>


<script>
    var textarea = document.getElementById("reason");

    var userName = "<?php echo htmlspecialchars($row['Name'] ?? ''); ?>";
    var date = "<?php echo htmlspecialchars($row['Date_of_Vaccination'] ?? ''); ?>";
    var time = "<?php echo htmlspecialchars($row['Booking_Slots'] ?? ''); ?>";
    var user_appointment_id = "<?php echo htmlspecialchars($row['appointment_id'] ?? ''); ?>";
    var contact = "<?php echo htmlspecialchars($contactNumber ?? ''); ?>";
    var hospitalName = "<?php echo htmlspecialchars($Hospital_Name ?? ''); ?>"; 

textarea.value = `Dear ${userName},

We are pleased to confirm your appointment No. ${user_appointment_id} for vaccination. Please find the details below:

• Date: ${date}
• Time: ${time}
• Hospital: ${hospitalName}

Please take a moment to review this information for accuracy. Should there be any discrepancies or if you need to make changes, kindly reach out to us promptly.

We eagerly anticipate your visit and are committed to providing you with excellent service. Should you have any inquiries or require further assistance, please don't hesitate to contact us at ${contact}.

Thank you for choosing VaxEaseOnline. We look forward to serving you.
    
Best regards,
${hospitalName}, Contact: ${contact}`;
    
</script>

</body>

</html>