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
  <link href="../css/profile.css" rel="stylesheet">

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
  include "config.php";
  //  query to fetch user_name
$sql = "SELECT * FROM sign_up WHERE username = '$sessionUserName'";
$result = $con->query($sql);


  ?>

         <div class="section-title" style="margin-bottom:-120px;">
            <h2>My Profile</h2>
          </div>
          

<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="../img/U_Icon.png"
                alt="Avatar" class="img-fluid my-3" style="width: 80px;" />
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <!-- echo "User Name: " . $row["Name"]. "<br>"; -->
                        <h5><?php echo $row['name']; ?></h5>
          
              
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
                    <h6>User Name</h6>
                    <p class="text-muted"><?php echo $row['username']; ?></p>
                  </div>
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
  <script src="../plugins/php-email-form/validate.js"></script>

  <!--  Main JS File -->
  <script src="../js/main.js"></script>

</body>

</html>