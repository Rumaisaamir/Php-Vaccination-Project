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
  <link href="../css/profile.css" rel="stylesheet">


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

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>


  <?php
  include "config.php";
$sql = "SELECT * FROM center_sign_up WHERE hospital_name = '$Hospital_Name'";
$result = $con->query($sql);


  ?>

         <div class="section-title" style="margin-bottom:-120px;">
            <h2>My Profile</h2>
          </div>
          

<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
      <!-- <div class="col col-lg-10 mb-4 mb-lg-0"> -->
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="../img/H_Icon.png"
                alt="Avatar" class="img-fluid my-3" style="width: 80px;" />
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <!-- echo "User Name: " . $row["Name"]. "<br>"; -->
                        <h5><?php echo $row['hospital_name']; ?></h5>
          
              
              <!-- <p>VaxEaseOnline</p> -->
              <!-- <i class="far fa-edit mb-3"></i> -->
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-6">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $row['email']; ?></p>
                  </div>
                  <div class="col-6 mb-6">
                    <h6>Contact</h6>
                    <p class="text-muted"><?php echo $row['contact_number']; ?></p>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

}
} else {
echo "No records found";
}

$con->close(); 
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