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

  <!--  Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/appointment.css" rel="stylesheet">

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
    </style>

</head>

<body>

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

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="home.php" id="ali">VaxEaseOnline</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="home.php#hero">Home</a></li>
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
  <br>

<?php 
include 'config.php';

$sql = "SELECT * FROM users WHERE username = '$sessionUserName'";
// $sql = "SELECT * FROM users WHERE username = '" . $_SESSION['UserName'] . "'";
$result = mysqli_query($con, $sql);

// echo "Username from Session: " . $sessionUserName;
// echo "Session UserName: " . $_SESSION['UserName'];

?>


<div class="section-title">
    <h2 id="h2_ki_id_user" style="color:#55a1e4;">Appointment Details</h2>
</div>
<?php
        if(isset($_SESSION['my_appointment_message'])) {
            echo '<div class="alert alert-success" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">' . $_SESSION['my_appointment_message'] . '</div>';
            unset($_SESSION['my_appointment_message']); // Clear the session variable
        }
?>

<?php
        if(isset($_SESSION['my_appointment_update_message'])) {
            echo '<div class="alert alert-success" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">' . $_SESSION['my_appointment_update_message'] . '</div>';
            unset($_SESSION['my_appointment_update_message']); // Clear the session variable
        }
?>

<?php
        if(isset($_SESSION['my_appointment_delete_message'])) {
            echo '<div class="alert alert-danger" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">' . $_SESSION['my_appointment_delete_message'] . '</div>';
            unset($_SESSION['my_appointment_delete_message']); // Clear the session variable
        }
?>
<!-- <div class="alert alert-success" role="alert" style="max-width: 820px; margin: 0 auto; border: 0; border-radius: 0; height: 50px; display: flex; align-items: center; margin-bottom: 20px;">
  This is a success!
</div> -->


<div id="appointment_table_div_user" class="table-container" style="width: 90%; overflow-x: auto; margin: 0 auto;">
  <table class="table" style="width: 90%; white-space: nowrap;">
    <thead class="table-dark border">
      <tr>
        <th scope="col" style="border-left: 1px solid #83baeb; padding: 8px;background-color: #83baeb; color:white;">Appointment ID</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">Name</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">Age</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">Contact Number</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">NIC Number</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">Email Address</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">Date of Vaccination</th>
        <th scope="col" style="padding: 8px;background-color: #83baeb; color:white;">Gender</th>
        <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Center Address</th>
        <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Vaccine Manufacturer</th>
        <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Time of Vaccination</th>
        <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Dose</th>
        <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Appointment Status</th>
        <th scope="col" style="background-color: #83baeb; color:white;  padding: 8px;">Vaccine Status</th>
        <th scope="col" style="border-right: 1px solid #83baeb; padding: 8px;background-color: #83baeb; color:white;">Action</th>
      </tr>
    </thead>
    <tbody>

    <?php
    if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
      $status = $row['status'];
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
        <td class="status" style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['status']; ?></td>
        <td style="border: 1px solid lightgrey; padding: 8px;"><?php echo $row['appointment']; ?></td>
<td class="status" style="border: 1px solid lightgrey; padding: 8px;">
<?php if ($status === 'Approved') { ?>
                    <a title="Confirmed" id="confirm_btns" style="padding: 0px 22px 0px 22px;" class="btn square-button"><i class="bi bi-check2-all"></i></a>
                <?php } ?>
    <!-- <a style="padding:0px 5px 0px 5px; display:none;" class="btn btn-success"><i class="bi bi-check-square"></i></a> -->
    <a title="Edit" id="edit_btns" style="padding:0px 5px 0px 5px;" class="btn edit-button" href="appointment.php?edit=<?php echo $row['UserID']; ?>"><i class="bi bi-pencil-square"></i></a>
    <a title="Delete" id="delete_btns" style="padding:0px 5px 0px 5px;" class="btn delete-button" href="update.php?del=<?php echo $row['UserID']; ?>"><i class="bi bi-trash-fill"></i></a>
</td>
  
            </tr>
      </tr>
    <?php       
    }
    ?>
    </tbody>
  </table>
</div>

<?php
}
?>

<br>
<br>
<br>


  <!-- plugins js Files -->
  <script src="../plugins/purecounter/purecounter_vanilla.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/glightbox/js/glightbox.min.js"></script>
  <script src="../plugins/swiper/swiper-bundle.min.js"></script>
  <script src="../plugins/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    var statusElements = document.querySelectorAll('.status');

    statusElements.forEach(function(element) {
        var status = element.textContent.trim(); // Get the status text

        if (status === 'Approved') {
            element.closest('tr').querySelector('.edit-button').style.display = 'none';
            element.closest('tr').querySelector('.delete-button').style.display = 'none';
        }
    });
});


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


  <script src="../js/main.js"></script>

</body>

</html>