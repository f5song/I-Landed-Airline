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
  <link rel="stylesheet" href="./help-page.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />
  <link rel="stylesheet" href="../ALLNAVBAR/navbar.css" />
</head>

<body>
  <!-- ส่วน bar -->
  <?php if (isset($_SESSION['user_login'])) { ?>

    <nav>
      <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline">
      </a>
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
        <a href="homepage.php?logout='1'">
          <img class="img-logout-icon" id="button-logout" alt="" src="../ALLNAVBAR/logout.png" />
        </a>
      </div>
    </nav>




  <?php } else { ?>

    <nav>
      <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline">
      </a>

      <ul>
        <li><a href="../HOMEPAGE/homepage.php"> หน้าแรก </a></li>
        <li><a href="../FLIGHT/flight.php"> เที่ยวบิน </a></li>
        <li><a href="../RECCOMMEND/reccom.php"> แนะนำสถานที่ </a></li>
        <li><a href="../ORDER/order.php"> คำสั่งซื้อ </a></li>
        <li><a href="../HELP/help.php"> ช่วยเหลือ </a></li>
      </ul>

      <div class="rightcontainer">
        <button class="button-sign-in" type="button" onclick="toLogin()"> เข้าสู่ระบบ </button>
        <button class="button-sign-up" type="button"> ลงทะเบียน </button>
      </div>
    </nav>

  <?php } ?>
  <!-- help-page -->
  <div class="help-page">
    <div class="text-popular-question">หัวข้อยอดนิยม</div>
    <div class="bg-banner">
      <div class="frame-for-banner"></div>
      <img class="img-magnifying-glass" alt="" src="./public/magnifying-glass.png" />

      <img class="img-person1-icon" alt="" src="./public/person1.png" />

      <img class="img-person2-icon" alt="" src="./public/person2.png" />

      <img class="img-folder-icon" alt="" src="./public/folder.png">
    </div>
    <div class="how-can-we-help">
      <div class="text-how-can">เราจะช่วยคุณได้อย่างไร?</div>
    </div>
    <div class="group-q5">
      <div class="animateion-q5">
        <div class="text-question5">ฉันจะได้รับตั๋วของฉันได้อย่างไร</div>
        <img class="icon-plus" onclick="hideshow5()" alt="" src="./public/icon-plus.svg" />
      </div>
      <div id="text-q5" class="text-q5" style="display: none">
        <p class="p">
          เว็บ I_LANDED AIRLINE ของเราจะออกตั๋วอิเล็กทรอนิกส์ให้คุณหลังจากที่คุณทำการชำระเงินเรียบร้อยแล้ว
          ตั๋วอิเล็กทรอนิกส์นี้คุณสามารถนำไปยื่นหน้าเคาท์เตอร์ที่สนามบินเพื่อขอรับบอร์ดดิ้งพาสของคุณได้
        </p>
      </div>
    </div>
    <div class="group-q4">
      <div class="animateion-q4">
        <div class="text-question4">จะตรวจสอบสถานะการคืนเงินได้อย่างไร</div>
        <img class="icon-plus" onclick="hideshow4()" alt="" src="./public/icon-plus.svg" />
      </div>
      <div id="text-q4" class="text-q4" style="display: none"">
          <p class=" p">
        หากต้องการตรวจสอบสถานะการคืนเงิน คุณสามารถไปที่ 'คำสั่งซื้อ' เมนู
        </p>
        <p class="p">
          จากนั้น กรอกรหัสและอีเมลที่คุณลงทะเบียนหากคุณขอเงินคืน
          สถานะจะแสดงที่นั่นหากคุณเคยลงทะเบียนและมีบัญชีมาก่อน
          โปรดลงชื่อเข้าใช้บัญชีของคุณก่อนไปที่ 'คำสั่งซื้อ' เมนู
        </p>
      </div>
    </div>
    <div class="group-q3">
      <div class="animateion-q3">
        <div class="text-question3">ฉันจะจองที่นั่งได้อย่างไร?</div>
        <img class="icon-plus" onclick="hideshow3()" alt="" src="./public/icon-plus.svg" />
      </div>
      <div id="text-q3" class="text-q3" style="display: none">
        สำหรับการจองที่นั่งนั้น
        สามารถทำได้ตอนเลือกเที่ยวบินที่คุณต้องการโดยคุณสามารถเลือกคลาสที่นั่งได้ที่หน้าหลัก
        จากนั้นเลือกเที่ยวบินที่ตรงตามวันและเวลาที่คุณอยากไป
      </div>
    </div>
    <div class="group-q2">
      <div class="animateion-q2">
        <div class="text-question2">
          การจองหนึ่งครั้งสามารถมีผู้โดยสารได้กี่คน
        </div>
        <img class="icon-plus" onclick="hideshow2()" alt="" src="./public/icon-plus.svg" />
      </div>
      <div id="text-q2" class="text-q2" style="display: none">
        สามารถจองผู้โดยสารได้สูงสุดหก (6)
        คนในหนึ่งธุรกรรมหากต้องการจองผู้โดยสารตั้งแต่เจ็ด (7)
        คนขึ้นไปคุณต้องทำการจองแยกกันสำหรับผู้โดยสาร 6 คน
      </div>
    </div>
    <div class="group-q1">
      <div class="animation-q1">
        <div class="text-question1">ฉันจะดูราคาตั๋วของฉันได้ที่ไหน?</div>
        <img class="icon-plus" onclick="hideshow1()" alt="" src="./public/icon-plus.svg" />
      </div>
      <div id="text-q1" class="text-q1" style="display: none">
        สำหรับราคาตั๋วแต่ละเที่ยวบินนั้น
        สามารถดูได้ที่หน้าเที่ยวบินโดยที่หน้าเที่ยวบินนั้นยังบอกรายละเอียดต่างๆที่คุณต้องการทราบอีกด้วย
        เช่น เวลาในการเดินทางและรายละเอียดเพิ่มเติมเกี่ยวกับเที่ยวบิน
      </div>
    </div>
  </div>

  <!-- footer -->
  <script src="scrip.js"></script>
</body>

</html>