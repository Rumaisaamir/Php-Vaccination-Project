<?php
session_start();
if(!isset($_COOKIE['admins_name'])) {
  header('location:admin_login.php');
  die();
};
$_SESSION['admins_name'] = $_COOKIE['admins_name'];
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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
  <link href="../css/dashboard.css" rel="stylesheet">
  <link href="../css/appointment.css" rel="stylesheet">

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
      <a class="linkedin"><i class="bi bi-person-fill"></i> Admin</a>
        <form action="admin_logout.php" method="post">
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

      <h1 class="logo me-auto"><a href="admin.php" id="ali">VaxEaseOnline</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="admin.php#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="admin.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="admin.php#services">Services</a></li>
          <li><a class="nav-link scrollto" href="admin.php#departments">Hospitals</a></li>
          <li><a class="nav-link scrollto" href="admin.php#faq">FAQs</a></li>
          <li><a class="nav-link scrollto" href="admin.php#gallery">Gallery</a></li>
          <!-- <li><a class="nav-link scrollto" href="admin.php#contact">Contact</a></li> -->
          <li><a class="nav-link scrollto" href="../php/admin_dashboard.php">Dashboard</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->



  <div id="dashboard_main_box">
    <div class="sidebar">
        <nav>
        <ul class="sidebar_link">
        <li class="anchor_li"><a class="anchor_1" href="../php/admin_dashboard.php"><i class="bi bi-speedometer2"></i> &nbsp;Admin Dashboard</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/admin_dashboard.php"><i class="bi bi-h-square"></i> &nbsp;Hospitals Register</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/non_approve_hospitals.php"><i class="fa fa-ban" aria-hidden="true"></i> &nbsp;Pending Hospitals</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/approve_hospitals.php"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;Approve Hospitals</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/hospitals_login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp;Hospitals Login</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/patients_register.php"><i class="bi bi-person-square"></i> &nbsp;Patients Register</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/patients_login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp;Patients Login</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/patients_appointment.php"><i class="bi bi-calendar-check"></i> &nbsp;Total Appointments</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/admin_pending_appointments.php"><i class="fa fa-ban"></i> &nbsp;Pending Appointments</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/admin_awaiting_appointments.php"><i class="fa fa-clock"></i> &nbsp;Awaiting Vaccinations</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/admin_vaccinated_patients.php"><i class="fa-solid fa-syringe"></i> &nbsp;Vaccinated Patients</a></li>
        <li class="anchor_li"><a class="anchor" href="../php/admin_vaccinations_report.php"><i class="fa fa-file"></i> &nbsp;Vaccination Reports</a></li>
        </ul>
        </nav>
    </div>
            <div class="boxes">
            <br>
            <!-- Main Boxes Div -->
            <div class="container-fluid">
            <div class="row">


<!-- Hospitals Register -->
<?php
include "config.php";

$hospital_register_count_query = "SELECT COUNT(*) as hospital_register_count FROM center_sign_up";
$hospital_register_count_result = $con->query($hospital_register_count_query);

if ($hospital_register_count_result->num_rows > 0) {
    while ($row2 = $hospital_register_count_result->fetch_assoc()) {
        $hospital_register_count = $row2["hospital_register_count"];
    }
} else {
    $hospital_register_count = 0; 
}
$con->close();
?>

 <div class="col-xl-4 col-md-6 mb-4">
 <a href="../php/admin_dashboard.php"><div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                    Hospitals Register</div>
                    <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $hospital_register_count; ?></div>
                </div>
                    <div class="col-auto">
                    <i id="icon" class="bi bi-h-square"></i>
                    </div>
            </div>
        </div>
    </div>
 </a>
 </div>


<!-- Pending Hospitals -->
<?php
include "config.php";

$hospital_pending_count_query = "SELECT COUNT(*) as hospitalCountPending FROM center_sign_up WHERE hospital_status = 'Pending'";
$hospital_pending_count_result = $con->query($hospital_pending_count_query);

if ($hospital_pending_count_result->num_rows > 0) {
    while ($row3 = $hospital_pending_count_result->fetch_assoc()) {
        $hospitalCountPending = $row3["hospitalCountPending"];
    }
} else {
    $hospitalCountPending = 0; 
}

$con->close();
?>

<div class="col-xl-4 col-md-6 mb-4">
    <a href="../php/non_approve_hospitals.php">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                            Pending Hospitals
                        </div>
                        <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $hospitalCountPending; ?>
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


            <!-- Patients Register -->

            <?php
            include "config.php";

            $patients_register_count_query = "SELECT COUNT(*) as patient_register_count FROM sign_up";
            $patients_register_count_result = $con->query($patients_register_count_query);

            if ($patients_register_count_result->num_rows > 0) {
                while ($row1 = $patients_register_count_result->fetch_assoc()) {
                    $patient_register_count = $row1["patient_register_count"];
                }
            } else {
                $patient_register_count = 0; 
            }

            $con->close();
            ?>
                     <div class="col-xl-4 col-md-6 mb-4">
                            <a href="../php/patients_register.php"><div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                                                 Patients Register</div>
                                                 <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $patient_register_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i id="icon" class="bi bi-person-square"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                     </div>


                     <!-- Total Appointments -->
<?php
        include "config.php";

        $Total_appointment_count_query = "SELECT COUNT(*) as Total_appointment_count FROM users";
        $Total_appointment_count_query_result = $con->query($Total_appointment_count_query);

        if ($Total_appointment_count_query_result->num_rows > 0) {
            while ($row3 = $Total_appointment_count_query_result->fetch_assoc()) {
                $Total_appointment_count = $row3["Total_appointment_count"];
            }
        } else {
            $Total_appointment_count = 0; 
        }

        $con->close();
        ?>



                     <div class="col-xl-4 col-md-6 mb-4">
                     <a href="../php/patients_appointment.php"><div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                                                Total Appointments</div>
                                            <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $Total_appointment_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i id="icon" class="bi bi-calendar-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
    </a>
                     </div>


 <!-- Vaccinated Patients -->

 <?php

include "config.php";


$vaccinated_count_query = "SELECT COUNT(*) as vaccinated_count FROM users WHERE status = 'Approved' AND appointment = 'Vaccinated' And report = 'Inprocess' And send_report = 'Unsent'";
$vaccinated_count_query_result = $con->query($vaccinated_count_query);

if ($vaccinated_count_query_result->num_rows > 0) {
    while ($row1 = $vaccinated_count_query_result->fetch_assoc()) {
        $vaccinated_count = $row1["vaccinated_count"];
    }
} else {
    $vaccinated_count = 0; 
}

$con->close();
?>
         <div class="col-xl-4 col-md-6 mb-4">
                <a href="../php/admin_vaccinated_patients.php"><div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                                     Vaccinated Patients</div>
                                     <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $vaccinated_count; ?></div>
                            </div>
                            <div class="col-auto">
                            <i id="icon" class="fa-solid fa-syringe"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
         </div>



<!-- Vaccinations Report -->
<?php

include "config.php";

$Report_count_query = "SELECT COUNT(*) as Report_count FROM vaccination_reports";
$Report_count_query_result = $con->query($Report_count_query);

if ($Report_count_query_result->num_rows > 0) {
    while ($row1 = $Report_count_query_result->fetch_assoc()) {
        $Report_count = $row1["Report_count"];
    }
} else {
    $Report_count = 0; 
}

$con->close();
?>
         <div class="col-xl-4 col-md-6 mb-4">
                <a href="../php/admin_vaccinations_report.php"><div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div id="headingsss" class="text-xs font-weight-bold text-uppercase mb-1">
                                     Vaccination Reports</div>
                                     <div id="oooo" class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $Report_count; ?></div>
                            </div>
                            <div class="col-auto">
                            <i id="icon" class="fa fa-file"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <a>
         </div>

  

                     <?php
        if(isset($_SESSION['admin_approve_message'])) {
            echo '<div class="alert alert-success" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; justify-content: center">' . $_SESSION['admin_approve_message'] . '</div>';
            unset($_SESSION['admin_approve_message']); // Clear the session variable
        }
?>

<?php
        if(isset($_SESSION['admin_delete_message'])) {
            echo '<div class="alert alert-danger" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; justify-content: center">' . $_SESSION['admin_delete_message'] . '</div>';
            unset($_SESSION['admin_delete_message']); // Clear the session variable
        }
?>
<br>
                    
                     <div style="margin-bottom:-25px;" class="section-title">
    <h2 id="h2_ki_id" style="color:#55a1e4;">Pending Hospitals</h2>
</div>

<div class="appointment_table_div_admin" class="table-container" style="width: 100%; overflow-x: auto;">
    <table class="table" style="width: 100%; white-space: nowrap;">
    <thead class="table">
            <tr>
                <th style="background-color: #83baeb; color:white; border-left: 1px solid #83baeb;" scope="col">Hospital Name</th>
                <th style="background-color: #83baeb; color:white;" scope="col">Email</th>
                <th style="background-color: #83baeb; color:white;" scope="col">Password</th>
                <th style="background-color: #83baeb; color:white;" scope="col">Status</th>
                <th style="background-color: #83baeb; color:white; border-right: 1px solid #83baeb;" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include "config.php";

        $sql = "SELECT * FROM center_sign_up WHERE hospital_status = 'pending' ORDER BY center_id ASC";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['hospital_name']; ?></td>
                    <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['email']; ?></td>
                    <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['password_1']; ?></td>
                    <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['hospital_status']; ?></td>
                    <td style="border: 1px solid lightgrey; padding: 8px;">
    <form action="non_approve_hospitals.php" method="POST">
		<input type="hidden" name="center_id" value="<?php echo $row['center_id']; ?>"/>
		<input style="padding:0px 15px 0px 15px; border-radius: 0px;" type="submit" class="btn Approve" name="approved" value="Approve">
		<input style="padding:0px 15px 0px 15px; border-radius: 0px;" type="submit" class="btn Deny" name="denied" value="Reject"> 
		</form>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<?php

if (isset($_POST['approved'])) {
  $approved_id = $_POST['center_id'];
  $approved_query = "UPDATE center_sign_up SET hospital_status = 'approved' WHERE center_id = '$approved_id' ";
  $query_approved = $con->query($approved_query);

  if ($query_approved === TRUE) {
    // header('location: admin.php');
    $_SESSION['admin_approve_message'] = "Hospital Approved!";
    ?>
    <script type="text/javascript">
        // Redirect using JavaScript
        window.location = "non_approve_hospitals.php";
    </script>
    <?php

    // echo '<script> alert("Hospital Approved!"); window.location.href = "non_approve_hospitals.php";</script>';
    exit();
  } else {
    echo "Error: " . $approved_query . "<br>" . $con->error;
  }
}

if (isset($_POST['denied'])) {
  $denied_id = $_POST['center_id'];
  $denied_query = "DELETE FROM center_sign_up WHERE center_id = '$denied_id' ";
  $query_denied = $con->query($denied_query);

  if ($query_denied === TRUE) {
    // header('location: admin.php');
    $_SESSION['admin_delete_message'] = "Hospital Rejected!";
    ?>
    <script type="text/javascript">
        // Redirect using JavaScript
        window.location = "non_approve_hospitals.php";
    </script>
    <?php

    // echo '<script> alert("Hospital Rejected!"); window.location.href = "non_approve_hospitals.php";</script>';
    exit();
  } else {
    echo "Error: " . $denied_query . "<br>" . $con->error;
  }
}

?>
</div>

                  
            </div>
        </div>
    </div>
</div>





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