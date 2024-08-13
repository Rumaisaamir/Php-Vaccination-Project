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

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <h1>Welcome to VaxEaseOnline</h1>
      <h2>Our team supports your path to health and safety.</h2>
      <a href="#hero" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose VaxEaseOnline?</h3>
              <p>
                At VaxEaseOnline, we are committed to making your vaccination and testing experience as convenient and secure as possible. Our user-friendly platform ensures hassle-free bookings, real-time updates, and a seamless process from start to finish. With a dedicated team of healthcare professionals, we prioritize your health and safety above all else. Choose VaxEaseOnline for a trusted and efficient path to safeguarding your well-being.
              </p>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="fa-solid fa-syringe"></i>
                    <h4>Vaccine Availability</h4>
                    <p>Discover real-time vaccine availability effortlessly. Our platform ensures convenient access to up-to-date information.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <h4>User-Friendly Interface</h4>
                    <p>Our platform ensures easy booking for all users, tech-savvy or not, with an intuitive interface for a hassle-free experience.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    <h4>Professional Guidance</h4>
                    <p>Count on our experienced healthcare professionals for a smooth vaccination journey. Your well-being is our utmost priority.</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>Empowering Your Well-being: The Promise of Vaccination</h3>
            <p>At VaxEaseOnline, we are dedicated to safeguarding your health and well-being. Our user-friendly platform and expert support ensure a seamless and secure experience, so you can focus on what matters most - your health.</p>

            <div class="icon-box">
              <div class="icon"><i class="fa-solid fa-syringe"></i></div>
              <h4 class="title"><a href="">Comprehensive Vaccination</a></h4>
              <p class="description">Our vaccination program offers a comprehensive range of vaccines, ensuring you and your loved ones are protected against various diseases.</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="fa fa-shield" aria-hidden="true"></i></div>
              <h4 class="title"><a href="">Your Shield of Protection</a></h4>
              <p class="description">Vaccination is your strongest defense against illnesses. It fortifies your immune system and guards your health.</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="fas fa-arrow-up"></i></div>
              <h4 class="title"><a href="">A Path to Health and Wellness</a></h4>
              <p class="description">Choosing vaccination is choosing a path to long-term health and wellness. It's a promise of a healthier future.</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>Our 'Vaccination Bookings' service simplifies the process of scheduling your COVID-19 vaccination appointments. Quickly find nearby vaccination centers, check real-time availability, and secure your appointment. Your safety and convenience are our top priorities.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="fa-solid fa-syringe"></i></div>
              <h4><a href="">Vaccination Bookings</a></h4>
              <p>Simplify your COVID-19 vaccination appointments with our easy booking system. Find nearby centers, check real-time availability, and secure your vaccination slot effortlessly.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="fa-solid fa-vials"></i></div>
              <h4><a href="">Testing Appointments</a></h4>
              <p>Schedule COVID-19 testing appointments with convenience and receive instant updates. Your testing experience is just a few clicks away.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="fa-solid fa-stethoscope"></i></div>
              <h4><a href="">Expert Guidance</a></h4>
              <p>Access expert advice and support from healthcare professionals at every step. Your health is our top priority, and our experts are here to guide you.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fa-solid fa-bell"></i></div>
              <h4><a href="">Real-time Updates</a></h4>
              <p>Stay informed with real-time updates on your appointments and test results. Timely notifications keep you in the know.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-book-medical"></i></div>
              <h4><a href="">Health Resources</a></h4>
              <p>Explore a wide range of health resources and stay updated on COVID-19 and other important health topics. Knowledge is your best defense.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="fa fa-shield" aria-hidden="true"></i></div>
              <h4><a href="">Safety Measures</a></h4>
              <p>Learn about the latest safety measures and guidelines to protect yourself and your community. Stay informed and stay safe.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

   

    <!-- ======= Departments Section ======= -->
    <section id="departments" class="departments">
        <div class="container">
  
          <div class="section-title">
            <h2>Hospitals</h2>
            <p>Explore a network of leading hospitals, each dedicated to providing specialized healthcare services. These hospitals are committed to your well-being, offering a range of departments to cater to your diverse healthcare needs.</p>
          </div>
  
          <div class="row gy-4">
            <div class="col-lg-3">
              <ul class="nav nav-tabs flex-column">
                <li class="nav-item">
                  <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Aga Khan University Hospital</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Indus Hospital </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Dow University Hospital</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Jinnah Medical Hospital</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Liaquat National Hospital</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-9">
              <div class="tab-content">
                <div class="tab-pane active show" id="tab-1">
                  <div class="row gy-4">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Caring for Life</h3>
                      <p class="fst-italic">A leading force in vaccine administration, Aga Khan University Hospital exemplifies unwavering commitment to public health.</p>
                      <p>Aga Khan University Hospital, renowned for healthcare excellence, plays a vital role in administering life-saving vaccines. With a legacy of compassionate care and advanced vaccine technologies, it's a beacon of hope, safeguarding lives through immunization.</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="../img/departments-1.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-2">
                  <div class="row gy-4">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Hope and Healing Beyond Boundaries</h3>
                      <p class="fst-italic">Indus Hospital, a beacon of hope, extends its healing touch through vaccination for all.</p>
                      <p>Indus Hospital is committed to providing hope and healing to all, regardless of socio-economic backgrounds. Alongside their quality healthcare services, they're a trusted source for administering vaccines, earning community confidence in public health protection.</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="../img/departments-2.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-3">
                  <div class="row gy-4">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Health for All</h3>
                      <p class="fst-italic">Dow University Hospital's commitment to vaccine accessibility paves the way for healthier communities.</p>
                      <p>Dow University Hospital, embodying the noble mission of "Health for All," stands as a cornerstone in the delivery of accessible vaccine solutions. Its profound dedication to education and research continues to contribute significantly to the advancement of vaccine knowledge and practices.</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="../img/departments-3.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-4">
                  <div class="row gy-4">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Pioneering Healthcare Excellence</h3>
                      <p class="fst-italic">Jinnah Postgraduate Medical Center leads the way in pioneering vaccine solutions and excellence in healthcare.</p>
                      <p>Jinnah Postgraduate Medical Center, a healthcare pioneer, excels in vaccine administration. Known for vital immunizations and innovation, its dedication to patient care and vaccine research makes it a renowned institution in public health.</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="../img/departments-4.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab-5">
                  <div class="row gy-4">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>Your Health, Our Promise</h3>
                      <p class="fst-italic">Liaquat National Hospital's promise of health resonates strongly through its vaccination efforts, placing the community's well-being at the forefront.</p>
                      <p>Liaquat National Hospital remains dedicated to prioritizing community health, especially in vaccines. With a patient-centric approach, it consistently delivers top-notch vaccination services, ensuring public health protection as a primary concern.</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="../img/departments-5.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
        </div>
      </section>
    <!-- End Departments Section -->

    

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Explore our FAQs to find answers to common questions related to vaccines, COVID-19, and our healthcare services. We're here to provide you with clear and helpful information to address your concerns and ensure your health and safety.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Is the COVID-19 vaccine safe? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Yes, the COVID-19 vaccines available have undergone rigorous testing and have been authorized for emergency use by health authorities. They are considered safe and effective in preventing severe illness and hospitalization.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">How can I schedule a vaccination appointment? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  You can schedule a vaccination appointment through our online portal or by contacting our healthcare center. We have a user-friendly system that allows you to choose a convenient time and location.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">What are the common side effects of the vaccine? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Common side effects of the COVID-19 vaccine include mild pain at the injection site, fatigue, and low-grade fever. These side effects are usually short-lived and a sign that your body is building protection against the virus.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Can I still contract COVID-19 after being vaccinated? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  While the vaccine significantly reduces the risk of severe illness, it is still possible to contract COVID-19 after being vaccinated. However, the vaccine provides strong protection against severe symptoms and hospitalization.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Do I need a booster shot, and when should I get it? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Booster shot recommendations may vary based on vaccine type and local guidelines. It's important to stay informed and follow health authorities' recommendations regarding booster shots. We will provide updates as they become available.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    
    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Gallery</h2>
          <p>Explore our gallery to witness the impactful journey of vaccination. These images capture the dedication of our healthcare heroes, the resilience of our patients, and the hope that vaccines bring to our community. Click on each image to delve deeper into our story.</p>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-1.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-2.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-3.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-4.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-5.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-6.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-7.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../img/gallery/gallery-8.jpg" class="galelry-lightbox">
                <img src="../img/gallery/gallery-8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>VaxEaseOnline</h3>
            <p>
               7936 Ghani <br>
               Street, Karachi 24700<br>
               Pakistan <br><br>
              <strong>Phone:</strong> +92 320 360 7386<br>
              <strong>Email:</strong> vaxease@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Helpful Resources</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#departments">Hospitals</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#gallery">Gallery</a></li>
              <!-- <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contact</a></li> -->
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Explore Our Offerings</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Vaccine Information</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Healthcare Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Emergency Contact</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Appointment Booking</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Health Tips</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Subscribe to our newsletter for the latest healthcare updates and tips!</p>
            <form action="" method="post">
              <input style="border:none;" class="admin_subs" type="text" placeholder="Enter email address"><input type="submit" value="Subscribe" name="admin_subscribe">
            </form>
            <?php
            if(isset($_POST['admin_subscribe'])){
              echo "<script>alert('You are an admin. You cannot subscribe!');</script>";
            }
            ?>
          </div>

        </div>
      </div>
    </div>

    
  </footer><!-- End Footer -->

  <script>
    document.addEventListener("DOMContentLoaded", function() {
    var emailInput = document.querySelector(".admin_subs");

    emailInput.addEventListener("focus", function() {
    this.style.outline = "none";
  });
});
  </script>


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- plugins js Files -->
  <script src="../plugins/purecounter/purecounter_vanilla.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/glightbox/js/glightbox.min.js"></script>
  <script src="../plugins/swiper/swiper-bundle.min.js"></script>
  <!-- <script src="../plugins/php-email-form/validate.js"></script> -->

  <!--  Main JS File -->
  <script src="../js/main.js"></script>

</body>

</html>