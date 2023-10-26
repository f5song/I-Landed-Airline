<?php
session_start();
require_once '../../CRUD/config/db.php';
if (!isset($_SESSION['user_login'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: ' . $_SESSION['redirect_url']);
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />

  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="../ALLNAVBAR/navbar.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />
  <script src="../SUGNUPLOGIN/signuplogin.js"></script>

</head>

<body>
  <!-- ส่วน bar -->
  <?php if (isset($_SESSION['user_login'])) { ?>

    <nav>
      <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline"> </a>
      <ul>
        <li><a href="../HOMEPAGE/homepage.php"> หน้าแรก </a></li>
        <li><a href="../FLIGHT/flight.php"> เที่ยวบิน </a></li>
        <li><a href="../RECCOMMEND/reccom.php"> แนะนำสถานที่ </a></li>
        <li><a href="../ORDER/order.php"> คำสั่งซื้อ </a></li>
        <li><a href="../HELP/help.php"> ช่วยเหลือ </a></li>
      </ul>

      <div class="rightcontainer">
        <p>สวัสดี,</p>
        <p>
          <?php echo $_SESSION['hello_user']; ?>
        </p>
        <a href="../HOMEPAGE/homepage.php?logout='1'">
          <img class="img-logout-icon" id="button-logout" alt="" src="../ALLNAVBAR/logout.png" />
        </a>
      </div>
    </nav>


  <?php } else { ?>

    <nav>
      <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline"> </a>

      <ul>
        <li><a href="../HOMEPAGE/homepage.php"> หน้าแรก </a></li>
        <li><a href="../FLIGHT/flight.php"> เที่ยวบิน </a></li>
        <li><a href="../RECCOMMEND/reccom.php"> แนะนำสถานที่ </a></li>
        <li><a href="../ORDER/order.php"> คำสั่งซื้อ </a></li>
        <li><a href="../HELP/help.php"> ช่วยเหลือ </a></li>
      </ul>

      <div class="rightcontainer">
        <button class="button-sign-in" type="button" onclick="toLogin()"> เข้าสู่ระบบ </button>
        <button class="button-sign-up" type="button" onclick="toSignup()"> ลงทะเบียน </button>
      </div>
    </nav>

  <?php } ?>


  <div class="recommend-a-place-page">
    <div class="group-text-img-main">
      <img class="img-plane-icon" alt="" src="./public/img-plane@2x.png" />

      <div class="text-hai-law">ให้เราแนะนำสถานที่ท่องเที่ยวยอดฮิตให้คุณ</div>
    </div>
    <div class="mix-all-ex">
      <div class="box-white"></div>

      <div class="boxtext-recommend">
        <div class="text-recomment">สถานที่ยอดฮิตราคาถูก</div>
      </div>

      <div class="boxtext-bangkok">
        <div class="text-recomment">เริ่มต้นจากกรุงเทพฯ</div>
      </div>
      <div class="ex1">
        <div class="box-white1"></div>
        <img class="img1-icon" alt="" src="./public/img1@2x.png" />

        <div class="text-main-state">ภูเก็ต - เชียงใหม่</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">1 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb">THB 950</div>
        <div class="vecter2"></div>
      </div>
      <div class="ex2">
        <div class="box-white1"></div>
        <div class="text-main-state">เชียงราย - หาดใหญ่</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">1 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1100</div>
        <div class="vecter2"></div>
        <img class="img2-icon" alt="" src="./public/img2@2x.png" />
      </div>
      <div class="ex3">
        <div class="box-white1"></div>
        <div class="text-main-state">กระบี่ - ภูเก็ต</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">2 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1200</div>
        <div class="vecter2"></div>
        <img class="img2-icon" alt="" src="./public/img3@2x.png" />
      </div>
      <div class="ex4">
        <div class="box-white1"></div>
        <div class="text-main-state">ยะลา - กรุงเทพ</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">2 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1300</div>
        <div class="vecter2"></div>
        <img class="img1-icon" alt="" src="./public/img4@2x.png" />
      </div>
      <div class="ex5">
        <div class="box-white1"></div>
        <div class="text-main-state">กรุงเทพ - เชียงใหม่</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">2 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1000</div>
        <div class="vecter2"></div>
        <img class="img1-icon" alt="" src="./public/img5@2x.png" />
      </div>
      <div class="ex6">
        <div class="box-white1"></div>
        <div class="text-main-state">กรุงเทพ - เชียงใหม่</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">2 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1260</div>
        <div class="vecter2"></div>
        <img class="img1-icon" alt="" src="./public/img6@2x.png" />
      </div>
      <div class="ex7">
        <div class="box-white1"></div>
        <div class="text-main-state">กรุงเทพ - ยะลา</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">2 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1300</div>
        <div class="vecter2"></div>
        <img class="img1-icon" alt="" src="./public/img7@2x.png" />
      </div>
      <div class="ex8">
        <div class="box-white1"></div>
        <div class="text-main-state">กรุงเทพ - ภูเก็ต</div>
        <div class="text-round-trip">Round-trip</div>
        <div class="text-days">2 days</div>
        <div class="text-start">เริ่มต้น</div>
        <div class="text-thb1">THB 1700</div>
        <div class="vecter2"></div>
        <img class="img1-icon" alt="" src="./public/img8@2x.png" />
      </div>
    </div>



    <div class="footer">
      <div class="footber-bg"></div>
      <div class="line-bottom-page"></div>
      <img class="logo-3-icon" alt="" src="./public/img-logo@2x.png" />

      <div class="text-and-button">
        <img class="icon-instagram" alt="" src="./public/icon-instagram.svg" />

        <img class="icon-envelope" alt="" src="./public/icon-envelope.svg" />

        <b class="text-contact-us">ติดต่อเรา</b>
        <div class="button-ani-sign-up">
          <div class="text-sign-up-container">
            <p class="p">ลงทะเบียน</p>
          </div>
        </div>
        <div class="button-ani-login">
          <div class="text-sign-up-container">เข้าสู่ระบบ</div>
        </div>
        <b class="text-account">ACCOUNT</b>
        <div class="ani-help">
          <div class="p">ช่วยเหลือ</div>
        </div>
        <div class="button-ani-homepage">
          <div class="text-homepage">
            <p class="p">หน้าแรก</p>
          </div>
        </div>
        <div class="ani-recomm-place">
          <div class="text-recomm-footer">
            <p class="p">แนะนำสถานที่</p>
          </div>
        </div>
        <b class="text-ilanded-airline">I-LANDED AIRLINE</b>
      </div>
    </div>
  </div>



  <script>
        function toLogin() {
            window.location.href = "../SIGNUPLOGIN/login.php";
        }

        function toSignup(){
            window.location.href = "../SIGNUPLOGIN/register.php";
        }
    </script>






</body>

</html>