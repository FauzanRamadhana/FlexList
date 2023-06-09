<?php
session_start();
include 'koneksi.php';
if (isset($_SESSION['user'])) {
    $check_akun = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '".$_SESSION['user']['username']."'");
    $data_akun = mysqli_fetch_assoc($check_akun);
    $sess_username = $_SESSION['user']['username'];
} 
// else {
//     header("Location: ".$url);    
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlexList</title>
    <link rel="stylesheet" href="templet/assets/css/style.css">
    <link rel="stylesheet" href="templet/assets/css/fontawesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href=templet/images/flexbesar.png type="image/x-icon"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://davin.id/assets/js/sweetalert2.all.min.js"></script>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<!-- ////////////////////////////////////////////////////////////////////////////////////////
                               START SECTION 1 - THE NAVBAR SECTION  
/////////////////////////////////////////////////////////////////////////////////////////////-->
<nav class="navbar navbar-expand-lg navbar-dark menu shadow fixed-top">
    <div class="container">
      <a class="navbar-brand" href="">
        <img src="templet/images/flexlist.png" alt="logo image" width="100px" height="100px"> <!-- ngecilin logo nya gimana-->
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#todolis" >To Do List</a></li>
          <li class="nav-item"><a class="nav-link" href="#Schedule">Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="#notes">Notes</a></li>
          <li class="nav-item"><a class="nav-link" href="#faq">QnA</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a>
          </li>
        </ul>
        <? if (isset($_SESSION['user'])) { ?>
        <a href="logout" class="rounded-pill btn-rounded">
          Logout
          <span>
            <i class="fas fa-sign-in-alt"></i>
          </span>
        </a>
        <? } else { ?>
        <a href="login" class="rounded-pill btn-rounded">
          Login
          <span>
            <i class="fas fa-sign-in-alt"></i>
          </span>
        </a>
        <? } ?>
      </div>
    </div>
  </nav>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                            START SECTION 2 - THE INTRO SECTION  
/////////////////////////////////////////////////////////////////////////////////////////////////////-->

<section id="home" class="intro-section">
  <div class="container">
    <div class="row align-items-center text-white"> <!-- kasih warna nya disini ygy -->
      <!-- START THE CONTENT FOR THE INTRO  -->
      <div class="col-md-6 intros text-start">
        <h1 class="display-2">
          <span class="display-2--intro"><?php if (isset($_SESSION['user'])) { echo 'Hello '.$data_akun['nama']; } else { echo 'Welcome to FlexList'; } ?></span>
          <span class="display-2--description lh-base">
            FlexList merupakan aplikasi berbasis web di mana user dapat membuat to do list/planning.
          </span>
        </h1>
        <?php if (!isset($_SESSION['user'])) { ?>
        <a href="daftar"><button type="button" class="rounded-pill btn-rounded"> Daftar
          <span><i class="fas fa-arrow-right"></i></span>
        </button> </a>
        <?php } ?>
      </div>
      <!-- START THE CONTENT FOR THE VIDEO -->
      <div class="col-md-6 intros text-end">
        <div class="video-box">
          <img src="templet/images/lagilagi.png" alt="video illutration" class="img-fluid" width="2000px" height="1500">
          <a href="#" class="glightbox position-absolute top-50 start-50 translate-middle">          
          </a>
        </div>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,208C384,192,480,128,576,133.3C672,139,768,213,864,202.7C960,192,1056,96,1152,74.7C1248,53,1344,107,1392,133.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////
                         START SECTION 4 - THE SERVICES  
///////////////////////////////////////////////////////////////////////////////////////////////////-->
<section id="services" class="services">
  <div class="container">
    <div class="row text-center">
      <h1 class="display-1 fw-bold">Introduce</h1>
      <div class="heading-line mb-1"></div>
    </div>
  <!-- START THE DESCRIPTION CONTENT  -->
    <div class="row pt-2 pb-2 mt-0 mb-3">
      <div class="col-md-6 border-right">
        <div class="bg-white p-3">
          <h2 class="fw-bold text-capitalize text-center">
            Our Services Range From Initial To Manage Your Proceedings Anywhere Anytime
          </h2>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-white p-4 text-start">
          <p class="fw-light">
           Di era sekarang dimana semua serba digital, pencatatan manajemen waktu ataupun rencana/planning tentu dapat pula di lakukan secara digital. Aplikasi ini dilatarbelakangi oleh kebutuhan harian user tentang manajemen rencana yang mana bertujuan meningkatkan produktivitas user serta untuk mengorganisir tugas-tugas ataupun prioritas user (dengan cara pengurutan). Di lengkapi dengan fitur-fitur tambahan selain pencatatan /list prioritas user yang mana dapat semakin menunjang fungsi utama dari aplikasi.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- START THE CONTENT FOR THE SERVICES  -->
  <div class="container">
    <!-- START THE MARKETING CONTENT  -->
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4">
        <div class="services__content">
          <div class="icon d-block fas fa-clipboard-list"></div>
          <h3 class="display-3--title mt-1">Notes</h3>
          <p class="lh-lg">
            Notes merupakan salah satu fitur FlexList dimana anda dapat mencatat/menulis catatan anda dalam bentuk online sehingga dapat di akses kapanpun dan di manapun.
          </p>
         
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4 text-end">
        <div class="services__pic">
          <img src="templet/images/services/service-1.png" alt="marketing illustration" class="img-fluid">
        </div>
      </div>
    </div>
    <!-- START THE WEB DEVELOPMENT CONTENT  -->
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4 text-start">
        <div class="services__pic">
          <img src="templet/images/services/service-2.png" alt="web development illustration" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4">
        <div class="services__content">
          <div class="icon d-block fas fa-clock"></div>
          <h3 class="display-3--title mt-1">Schedule</h3>
          <p class="lh-lg">
            FlexList menyediakan fitur Schedule dimana anda dapat melakukan perencanaan jadwal keseharian dan memvisualisasikannya dalam fitur ini. 
          </p>
          
        </div>
      </div>
    </div>
    <!-- START THE CLOUD HOSTING CONTENT  -->
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4">
        <div class="services__content">
          <div class="icon d-block fas fa-server"></div>
          <h3 class="display-3--title mt-1">To Do</h3>
          <p class="lh-lg">
            Merupakan fitur utama FlexList. Dimana anda dapat membuat perencanaan baik jangka pendek hingga jangka panjang dalam bentuk list-list.
          </p>
          
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 services mt-4 text-end">
        <div class="services__pic">
          <img src="templet/images/services/service-3.png" alt="cloud hosting illustration" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (isset($_SESSION['user'])) { ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                                            {{-- TO DO LIST--}}
 ///////////////////////////////////////////////////////////////////////////////////////////-->
<section id="todolis" class="todolis">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  <div class="container">
      <div class="row text-center text-white">
      <h1 class="display-3 fw-bold">To Do List</h1>
      <hr style="width: 100px; height: 3px; " class="mx-auto">
      <p class="lead pt-1">Lets create your to do list!</p>
    <center> <a href="todo"> <button type="button" class="rounded-pill btn-rounded border-primary">create my to do list
        <span><i class="fas fa-arrow-right"></i></span> 
      </button> </a></center>    
        </div></div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>



<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                                            {{-- SCHEDULE --}}
 ///////////////////////////////////////////////////////////////////////////////////////////-->

<section id="Schedule" class="Schedule">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  <div class="container">
    <div class="row text-center text-white">
      <h1 class="display-3 fw-bold">Schedule</h1>
      <hr style="width: 100px; height: 3px; " class="mx-auto">
      <p class="lead pt-1">Lets create your schedule!</p>
      <img src="okiii.png" width="100px" height="600px"> 
      <center> <a href="schedule"> <button type="button" class="rounded-pill btn-rounded border-primary">create my schedule
        <span><i class="fas fa-arrow-right"></i></span> 
      </button> </a></center>
      
    </div>

   
        </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>




<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                                            {{-- NOTES--}}
 ///////////////////////////////////////////////////////////////////////////////////////////-->

<section id="notes" class="notes">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
  <div class="container">
    <div class="row text-center text-white">
      <h1 class="display-3 fw-bold">Notes</h1>
      <hr style="width: 100px; height: 3px; " class="mx-auto">
      
      <form method="POST">
          <?php
          if (isset($_POST['note'])) {
              $insert = mysqli_query($koneksi, "INSERT INTO note (username, content) VALUES ('$sess_username','".$_POST['content']."')");
              if ($insert == TRUE) {
                  echo '<script>alert("Note berhasil dibuat.")</script>';
              } else {
                  echo '<script>alert("Error sistem.")</script>';
              }
          }
          ?>
      <div class="col-lg-12 mb-3">
        <br><br><br>
        <textarea name="content" placeholder="Tulis notes anda..." id="content" rows="7" class="shadow form-control form-control-lg"></textarea>
      </div>
      <div class="text-center d-grid mt-1">
        <button type="submit" name="note" class="btn btn-primary rounded-pill pt-3 pb-3">
          submit
          <i class="fas fa-paper-plane"></i>
        </button><br><br>
      </div>
      
    </form>
    <center> <a href="notes" class="rounded-pill btn-rounded border-primary">history notes
        <span><i class="fas fa-arrow-right"></i></span> 
      </a></center>
    </div>

   
        </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,213.3C384,203,480,117,576,117.3C672,117,768,203,864,202.7C960,203,1056,117,1152,117.3C1248,117,1344,203,1392,245.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</section>

<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                       START SECTION 6 - THE FAQ 
//////////////////////////////////////////////////////////////////////////////////////////////////////-->
<section id="faq" class="faq">
  <div class="container">
    <div class="row text-center">
      <h1 class="display-3 fw-bold text-uppercase">QnA</h1>
      <div class="heading-line"></div>
      <p class="lead">Qusetion and Answer <br> frequently asked questions, get knowledge befere hand</p>
    </div>
    <!-- ACCORDION CONTENT  -->
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="accordion" id="accordionExample">
          <!-- ACCORDION ITEM 1 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              What is a to-do list web application?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
              A to-do list web application is a software program that helps you organize and manage tasks or activities that need to be completed.
              </div>
            </div>
          </div>
             <!-- ACCORDION ITEM 2 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              How does a to-do list web application work?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                A to-do list web application typically allows users to create tasks, set due dates, prioritize tasks, add notes or descriptions, and mark tasks as completed. The application may also offer features such as reminders, notifications, and the ability to collaborate with others.
              </div>
            </div>
          </div>
             <!-- ACCORDION ITEM 3 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              What are the benefits of using a to-do list web application?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                A to-do list web application can help increase productivity, reduce stress and anxiety, and improve time management. By organizing tasks and setting priorities, users can focus on the most important tasks and avoid wasting time on less important ones.
              </div>
            </div>
          </div>
             <!-- ACCORDION ITEM 4 -->
          <div class="accordion-item shadow mb-3">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Can I access my to-do list web application from different devices?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Yes, most to-do list web applications are accessible from multiple devices such as computers, smartphones, and tablets. This allows users to access their to-do list from anywhere with an internet connection.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br>
</section>

<?php if (isset($_SESSION['user'])) { ?>
<section id="contact" class="get-started">
  <div class="container">

    <!-- START THE CTA CONTENT  -->
  
        <form method="POST">
             <?php
   
   if (isset($_POST['pesan'])) {
        $message = $_POST['message'];
            $kirim = mysqli_query($koneksi, "INSERT INTO kritik (username, message, datetime) VALUES ('$sess_username','$message','".date("Y-m-d H:i:s")."')");
            if ($kirim == TRUE) {
                echo "<script>alert('Kritik berhasil dikirim!');</script>";
            } else {
                echo "<script>alert('Error System!','error')</sscript>";
            }
        }
        
        ?>
    <div class="row text-white">
      <div class="gradient shadow p-3">
        <div class="cta-info w-100">
            <center><h1 class="display-3 fw-bold text-capitalize">Kritik dan Saran</h1> 
      <p class="lh-lg">
        We receive about new ideas that can help us to improve FlexList💗 
      </p></center>      
      <div class="heading-line"></div>
       <br> <br> 
            <!--<div class="col-lg-6 col-md mb-3">-->
            <!--  <input type="text" placeholder="Nama Depan" id="inputFirstName" class="shadow form-control form-control-lg">-->
            <!--</div>-->
            <!--<div class="col-lg-6 col-md mb-3">-->
            <!--  <input type="text" placeholder="Nama Belakang" id="inputLastName" class="shadow form-control form-control-lg">-->
            <!--</div>-->
            <!--<div class="col-lg-12 mb-3">-->
            <!--  <input type="email" placeholder="Email" id="inputEmail" class="shadow form-control form-control-lg">-->
            <!--</div>-->
            <div class="col-lg-12 mb-3">
              <textarea name="message" placeholder="Tulis kritik dan saran anda di sini..." id="message" rows="3" class="shadow form-control form-control-lg"></textarea>
            </div>
            <div class="text-center d-grid mt-1">
              <button type="submit" name="pesan" class="btn btn-primary rounded-pill pt-3 pb-3">
                submit
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <br><br>
  </div>
  
</section>
<?php } ?>
<div class="row text-center"> 
 
      <h1 class="display-3 fw-bold text-capitalize">Our Contact</h1>
      <div class="heading-line"></div>
      <p class="lh-lg">
       Also you can connect with us through our contact.
      </p> 
    </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////
                           START SECTION 9 - THE FOOTER  
///////////////////////////////////////////////////////////////////////////////////////////////-->
<footer class="footer">
    <br> <br>
  <div class="container">
    <div class="row">
      <!-- CONTENT FOR THE MOBILE NUMBER  -->
      <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
        <div class="contact-box__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
            <path d="M15 7a2 2 0 0 1 2 2" />
            <path d="M15 3a6 6 0 0 1 6 6" />
          </svg>
        </div>
        <div class="contact-box__info">
          <a href="#" class="contact-box__info--title">081316743514 <br> 081271076622 <br> 082269706975</a>
          <p class="contact-box__info--subtitle">  Mon-Fri 9am-6pm</p>
        </div>
      </div>  
      <!-- CONTENT FOR EMAIL  -->
      <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
        <div class="contact-box__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <polyline points="3 9 12 15 21 9 12 3 3 9" />
            <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" />
            <line x1="3" y1="19" x2="9" y2="13" />
            <line x1="15" y1="13" x2="21" y2="19" />
          </svg>
        </div>
        <div class="contact-box__info">
          <a href="#" class="contact-box__info--title">flexlist0@gmail.com</a>
          <p class="contact-box__info--subtitle">Our Gmail</p>
        </div>
      </div>
      <!-- CONTENT FOR LOCATION  -->
      <div class="col-md-4 col-lg-4 contact-box pt-1 d-md-block d-lg-flex d-flex">
        <div class="contact-box__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" viewBox="0 0 24 24" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="18" y1="6" x2="18" y2="6.01" />
            <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5" />
            <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15" />
            <line x1="9" y1="4" x2="9" y2="17" />
            <line x1="15" y1="15" x2="15" y2="20" />
          </svg>
        </div>
        <div class="contact-box__info">
          <a href="https://telkomuniversity.ac.id/" class="contact-box__info--title">Telkom University</a>
          <p class="contact-box__info--subtitle">Bandung, West Java</p>
        </div>
      </div>
    </div>
  </div>

  <!-- START THE SOCIAL MEDIA CONTENT  -->
  <div class="footer-sm" style="background-color: #212121;">
    <div class="container">
      <div class="row py-4 text-center text-white">
        <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
          connect with us on social media
        </div>
        <div class="col-lg-7 col-md-6">        
          <a href="https://github.com/havascientist/FlexList"><i class="fab fa-github"></i></a>          
          <a href="https://www.instagram.com/flex_list/"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- START THE COPYRIGHT INFO  -->
  <div class="footer-bottom pt-5 pb-5">
    <div class="container">
      <div class="row text-center text-white">
        <div class="col-12">
          <div class="footer-bottom__copyright">
            &COPY; Enjoy our web in <a href="#" target="_blank">Flexlist</a><br><br>            
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- BACK TO TOP BUTTON  -->


    
<a href="#" class="shadow btn-primary rounded-circle back-to-top">
  <i class="fas fa-chevron-up"></i>
</a>


<div id="id01" class="modal">
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <!--<img src="templet/images/flexlist.png" alt="Avatar" class="avatar">-->
    </div>

    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        <div class="text-center d-grid mt-1">
      <button class="btn btn-primary rounded-pill pt-3 pb-3" type="submit" name="login">Login</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
   
    <script src="templet/assets/vendors/js/glightbox.min.js"></script>

    <script type="text/javascript">
      const lightbox = GLightbox({
        'touchNavigation': true,
        'href': 'https://www.youtube.com/watch?v=J9lS14nM1xg',
        'type': 'video',
        'source': 'youtube', //vimeo, youtube or local
        'width': 900,
        'autoPlayVideos': 'true',
});
    </script>
     <script src="templet/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
