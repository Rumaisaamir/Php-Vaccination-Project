<?php
session_start();
if(!isset($_COOKIE['UserName'])) {
  header('location:login.php');
  die();
};
if (!isset($_COOKIE['SessionID'])) {
  header('location:login.php');
  die();
};

$_SESSION['UserName'] = $_COOKIE['UserName'];
$_SESSION['SessionID'] = $_COOKIE['SessionID'];
$sessionUserName = $_SESSION['UserName'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>VaxEaseOnline</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

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

  <link href="../css/style.css" rel="stylesheet">
  
  <style>

.icon-button {
  position: relative;
  color: #333333;
  background: transparent;
  border: none;
  outline: none;
  display: flex;
  align-items: center;
  justify-content: center;
}

#over {
  font-size: 13px;
  color: #437099;
  padding-left: 15px;
  display: inline-block;
  transition: 0.3s;
  cursor: pointer;
}

#over:hover {
  color: #1977cc;
}

.icon-button__badge {
  position: absolute;
  top: -7.5px;
  right: -7.5px;
  width: 12.5px;
  height: 12.5px;
  background: red;
  color: #ffffff;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 10px;
  cursor: pointer;
}

#list {
  display: none;
  position: absolute;
  top: 120px;
  right: 1px;
  /* background-color: #f9f9f9; */
  border: 1px solid #ddd;
  padding: 15px 15px 7px 15px;
  width: 430px;
}

/* #message_items {
  display: none;
  position: absolute;
  top: 118px;
  right: 10px;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  padding: 15px;
  width: 350px;
} */

.msg {
  /* padding: 10px; 
  margin-bottom: 5px; 
  background-color: #fff; 
  border: 1px solid #ddd; 
  cursor: pointer; */
  
  /* width: 90%; */
  padding-top: 8px !important;
  text-align: start;
  display: block;
  /* word-wrap: break-word; */
  font-size: 14px;
  color: #2c4964da;
  /* font-family: "Poppins", sans-serif; */
}

.message {
  padding: 5px 10px 0px 10px;
  margin-bottom: 10px;
  background-color: white;
  border: 1px solid #ddd;
  cursor: pointer;
}


        .form-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 10px;
        }

        label {
            flex: 1;
            text-align: left;
            margin-right: -310px;
        }

        input,
        select {
            flex: 2;
        }

        @media screen and (max-width: 1200px) {
            .form-group {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 5px;
            }

            label {
                flex: none;
                text-align: left;
                margin-right: 0;
            }

            input,
            select {
                flex: none;
                width: 100%;
            }
        }
    </style>


</head>

<body>

<?php
    include "config.php";
    include "update.php";

    // getting appointment record to update

    if(isset($_GET['edit'])){
      $id = $_GET['edit'];
      $edit_state = true;


      $view_in_update = "SELECT * FROM users WHERE UserID = $id";
      $result = $con->query($view_in_update); 
      $record = $result->fetch_assoc();

      $Name = $record['Name'];
      $Age = $record['Age'];
      $Contact_Number = $record['Contact_Number'];
      $NIC_Number = $record['NIC_Number'];
      $Email_Address = $record['Email_Address'];
      $Date_of_Vaccination = $record['Date_of_Vaccination'];
      $Gender = $record['Gender'];
      $Preferred_Center = $record['Preferred_Center'];
      $Vaccination_Type = $record['Vaccination_Type'];
      $Booking_Slots = $record['Booking_Slots'];
      $Dose = $record['Dose'];
      $id = $record['UserID'];

    };
    
    ?>

<?php

include "config.php";

// Active notifications ko retrieve karein
// $active_notifications_query = "SELECT * FROM users WHERE active = 1";
$active_notifications_query = "SELECT * FROM users WHERE UserName = '$sessionUserName' AND active = 1";

$active_notifications_result = mysqli_query($con, $active_notifications_query);

// Active notifications ka count karein
$count_active = mysqli_num_rows($active_notifications_result);

// Active notifications ko array mein store karein
$notifications_data = array();
while ($row = mysqli_fetch_assoc($active_notifications_result)) {
    $notifications_data[] = $row;
    $appointment_id = $row['appointment_id'];
}

// Deactive notifications ko retrieve karein
$deactive_notifications_query = "SELECT * FROM users WHERE UserName = '$sessionUserName' AND active = 0 ORDER BY UserID DESC LIMIT 3";
$deactive_notifications_result = mysqli_query($con, $deactive_notifications_query);

// Deactive notifications ko array mein store karein
$deactive_notifications_dump = array();
while ($row = mysqli_fetch_assoc($deactive_notifications_result)) {
    $deactive_notifications_dump[] = $row;
}

?>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="#">vaxease@gmail.com</a>
        <i class="bi bi-phone"></i> +92 320 360 7386
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">

      <a id="notificationButton" class="icon-button">
  <i class="fa fa-bell" id="over" data-value="<?php echo $count_active; ?>"></i>
  <?php if (!empty($count_active)) { ?>
    <div class="round icon-button__badge" id="bell-count" data-value="<?php echo $count_active; ?>"><?php echo $count_active; ?></div>
  <?php } ?>
</a>
<div id="list">
  <?php if (!empty($count_active)) { ?>
    <?php foreach ($notifications_data as $list_rows) { ?>
      <div class="message_items">
        <div class="message" data-id="<?php echo $list_rows['UserID']; ?>">
          <div class="msg">
            <p><?php echo $list_rows['Name']; ?> your appointment No.<?php echo $list_rows['appointment_id']; ?> has been confirmed. Please check your mail.</p>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } else { ?>
    <?php foreach ($deactive_notifications_dump as $list_rows) { ?>
      <div class="message_items">
        <div class="message" data-id="<?php echo $list_rows['UserID']; ?>">
          <div class="msg">
            <p><?php echo $list_rows['Name']; ?> your appointment No.<?php echo $list_rows['appointment_id']; ?> has been confirmed. Please check your mail.</p>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
</div>


      <a href="user_profile.php" class="twitter"><i class="bi bi-person-fill"></i> Profile</a>
      <a class="linkedin"><i class="bi bi-person-fill"></i> <?php echo $_SESSION['UserName']?></a>
        <form action="logout.php" method="post">
          <button class="nav-link scrollto" type="submit" name="logout">
            <a class="linkedin"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
          </button>
          </form>
      </div>
    </div>
  </div>

  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="home.php">VaxEaseOnline</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="home.php">Home</a></li>
          <li><a class="nav-link scrollto" href="home.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="home.php#services">Services</a></li>
          <li><a class="nav-link scrollto" href="home.php#departments">Hospitals</a></li>
          <li><a class="nav-link scrollto" href="home.php#faq">FAQs</a></li>
          <li><a class="nav-link scrollto" href="home.php#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="home.php#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="../php/my_appointment.php">Appointments</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="appointment.php" class="appointment-btn scrollto"><span class="d-none d-md-inline"> Book</span> Appointment</a>

    </div>
  </header><!-- End Header -->
  

  <br>
  <br>
  <br>
  <br>
  <br>

     <!-- ======= Appointment Section ======= -->
     <section id="" class="appointment section-bg">
        <div class="container">
  
          <div class="section-title">
            <h2>Book Appointment</h2>
            <p>Schedule your vaccination or testing appointment with ease. Please provide the required details below, and our team will assist you in securing your appointment slot.</p>
          </div>
  
       <form action="" method="post" role="form" class="php-email-form">
    <div class="row">
      <!-- Hidden ID -->
    <div class="col-md-12 form-group">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
      <!-- Name -->
        <div class="col-md-12 form-group">
            <label for="Name">Name:</label>
            <input type="text" name="Name" class="form-control" id="Name" placeholder="Enter your name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $Name; ?>">
        </div>
        <!-- Age -->
        <div class="col-md-12 form-group mt-3">
            <label for="Age">Age:</label>
            <input type="text" name="Age" class="form-control" id="Age" placeholder="Enter your age" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $Age; ?>">
        </div>
      <!-- Contact Number -->
        <div class="col-md-12 form-group mt-3">
            <label for="Contact_Number">Contact Number:</label>
            <input type="text" name="Contact_Number" class="form-control datepicker" id="Contact_Number" placeholder="Enter your phone number" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $Contact_Number; ?>">
        </div>
      <!-- N.I.C Number -->
        <div class="col-md-12 form-group mt-3">
            <label for="NIC_Number">N.I.C Number:</label>
            <input type="text" name="NIC_Number" class="form-control datepicker" id="NIC_Number" placeholder="Enter your N.I.C number" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $NIC_Number; ?>">
        </div>
      <!-- Email Address -->
        <div class="col-md-12 form-group mt-3">
            <label for="Email_Address">Email Address:</label>
            <input type="email" name="Email_Address" class="form-control datepicker" id="Email_Address" placeholder="Enter a valid email address" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="<?php echo $Email_Address; ?>">
        </div>
      <!-- Date of Vaccination -->
        <div class="col-md-12 form-group mt-3">
            <label for="Date_of_Vaccination">Date of Vaccination:</label>
            <input type="date" name="Date_of_Vaccination" class="form-control" id="Date_of_Vaccination" placeholder="Date of Vaccination" data-rule="email" data-msg="Please enter a valid email" value="<?php echo $Date_of_Vaccination; ?>">
        </div>
      <!-- Gender -->
<div class="col-md-12 form-group mt-3">
    <label for="Gender">Gender:</label>
    <select name="Gender" id="Gender" class="form-select">
        <option value="" selected disabled>Select Gender</option>
        <option value="Male" <?php if ($Gender === "Male") echo "selected"; ?>>Male</option>
        <option value="Female" <?php if ($Gender === "Female") echo "selected"; ?>>Female</option>
    </select>
</div>

<!-- Preferred Center -->
<div class="col-md-12 form-group mt-3">
    <label for="Preferred_Center">Preferred Center:</label>
    <select name="Preferred_Center" id="Preferred_Center" class="form-select">
        <option value="" selected disabled>Select Preferred Center</option>
        <option value="Aga Khan University Hospital" <?php if ($Preferred_Center === "Aga Khan University Hospital") echo "selected"; ?>>Aga Khan University Hospital</option>
        <option value="Indus Hospital" <?php if ($Preferred_Center === "Indus Hospital") echo "selected"; ?>>Indus Hospital</option>
        <option value="Dow University Hospital" <?php if ($Preferred_Center === "Dow University Hospital") echo "selected"; ?>>Dow University Hospital</option>
        <option value="Jinnah Postgraduate Medical" <?php if ($Preferred_Center === "Jinnah Postgraduate Medical") echo "selected"; ?>>Jinnah Postgraduate Medical</option>
        <option value="Liaquat National Hospital" <?php if ($Preferred_Center === "Liaquat National Hospital") echo "selected"; ?>>Liaquat National Hospital</option>
    </select>
</div>

<!-- Vaccination Type -->
<div class="col-md-12 form-group mt-3">
    <label for="Vaccination_Type">Vaccination Type:</label>
    <select name="Vaccination_Type" id="Vaccination_Type" class="form-select">
        <option value="" selected disabled>Select Vaccination Type</option>
        <option value="Pfizer-BioNTech" <?php if ($Vaccination_Type === "Pfizer-BioNTech") echo "selected"; ?>>Pfizer-BioNTech</option>
        <option value="Moderna" <?php if ($Vaccination_Type === "Moderna") echo "selected"; ?>>Moderna</option>
        <option value="Johnson & Johnson's Janssen" <?php if ($Vaccination_Type === "Johnson & Johnson's Janssen") echo "selected"; ?>>Johnson & Johnson's Janssen</option>
        <option value="AstraZeneca-Oxford" <?php if ($Vaccination_Type === "AstraZeneca-Oxford") echo "selected"; ?>>AstraZeneca-Oxford</option>
        <option value="Sinopharm" <?php if ($Vaccination_Type === "Sinopharm") echo "selected"; ?>>Sinopharm</option>
    </select>
</div>

<!-- Booking Slots -->
<div class="col-md-12 form-group mt-3">
    <label for="Booking_Slots">Booking Slots:</label>
    <select name="Booking_Slots" id="Booking_Slots" class="form-select">
        <option value="" selected disabled>Select Booking Slot</option>
        <option value="10 am to 12 pm" <?php if ($Booking_Slots === "10 am to 12 pm") echo "selected"; ?>>10 am to 12 pm</option>
        <option value="12 pm to 2 pm" <?php if ($Booking_Slots === "12 pm to 2 pm") echo "selected"; ?>>12 pm to 2 pm</option>
        <option value="2 pm to 4 pm" <?php if ($Booking_Slots === "2 pm to 4 pm") echo "selected"; ?>>2 pm to 4 pm</option>
        <option value="4 pm to 6 pm" <?php if ($Booking_Slots === "4 pm to 6 pm") echo "selected"; ?>>4 pm to 6 pm</option>
    </select>
</div>

<!-- Dose -->

<div class="col-md-12 form-group mt-3">
    <label for="Dose">Dose:</label>
    <select name="Dose" id="Dose" class="form-select">
        <option value="" selected disabled>Select Dose</option>
        <option value="First" <?php if ($Dose === "First") echo "selected"; ?>>First</option>
        <option value="Second" <?php if ($Dose === "Second") echo "selected"; ?>>Second</option>
        <option value="Booster" <?php if ($Dose === "Booster") echo "selected"; ?>>Booster</option>
    </select>
</div>

    </div>
    <br>

    <?php if ($edit_state == false): ?>
    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    <?php else: ?>
    <button name="update" type="submit" class="btn btn-primary">Update</button>
    <?php endif; ?>
    <!-- <div class="text-left"><button type="submit" name="submit">Submit</button></div> -->
</form>

  
        </div>
      </section><!-- End Appointment Section -->

      <script>
    $(document).ready(function(){
    var ids = new Array();
    $('#over').on('click',function(){
           $('#list').toggle();  
       });

   //Message with Ellipsis
  //  $('div.msg').each(function(){
  //      var len =$(this).text().trim(" ").split(" ");
  //     if(len.length > 12){
  //        var add_elip =  $(this).text().trim().substring(0, 65) + "…";
  //        $(this).text(add_elip);
  //     }
  //  }); 

   $("#over").on('click',function(e){
        e.preventDefault();

        let belvalue = $('#over').attr('data-value');
        
        if(belvalue == ''){
          console.log("inactive");
        }else{
          $(".round").css('display','none');
          $("#list").css('display','block');
          //Ajax
          $('.message').click(function(e){
            e.preventDefault();
              $.ajax({
                url:'deactive.php',
                type:'POST',
                data:{"id":$(this).attr('data-id')},
                success:function(data){
                    console.log(data);
                    location.reload();
                }
            });
        });
     }
   });
});

  </script>

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


