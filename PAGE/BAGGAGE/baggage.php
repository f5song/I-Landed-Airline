<!-- http://localhost/ISAD-ILAL/PAGE/BAGGAGE/baggage.php -->


<?php
session_start();
require_once '../../CRUD/config/db.php';
if (!isset($_SESSION['user_login'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
  header('location: ../SIGNUPLOGIN/login.php');
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
  <link rel="stylesheet" href="./baggage.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@500;600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" />
</head>

<body>
  <div class="bar">
    <!-- circle -->
    <div><img src="./img/logo_for_bar.png" alt=""></div>
    <div class="circle1-2-3">
      <div class="circ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
          <circle cx="13" cy="13" r="13" fill="#1F97D4" />
          <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
            1
          </text>
        </svg>
      </div>
      <p style="color: #696969;" class="txt123">การจอง</p>
      <div class="between-line">
        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="2" viewBox="0 0 29 2" fill="none">
          <path d="M0 1H29" stroke="#7C7C7C" />
        </svg>
      </div>
      <div class="circ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
          <circle cx="13" cy="13" r="13" fill="#696969" />
          <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
            2
          </text>
        </svg>
      </div>
      <p style="color: #696969;" class="txt123">ชำระเงิน</p>
      <div class="between-line">
        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="2" viewBox="0 0 29 2" fill="none">
          <path d="M0 1H29" stroke="#7C7C7C" />
        </svg>
      </div>
      <div class="circ">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
          <circle cx="13" cy="13" r="13" fill="#696969" />
          <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
            3
          </text>
        </svg>
      </div>
      <p style="color: #696969;" class="txt123">รับตั๋ว</p>
    </div>
  </div>
  <div class="backgroundlock">
    <div class="boxlock">
      <div class="toplock">
        <div class="lefttop">
          <div class="contentleft1">
            <div class="img_baggage"><img src="./img/icon_baggage.png" alt=""></div>
            <h1>สัมภาระ</h1>
          </div>
          <div class="contentleft2">
            <h3>เลือกเที่ยวบินของคุณ</h3>
            <p1>เลือกสัมภาระของคุณ</p1>
          </div>
          <div class="contentleft3">
            <p>**from</p>
            <p>ไป</p>
            <p>**to</p>
          </div>
        </div>
        <div class="righttop">
          <div class="contentright1">
            <div class="topright1">
              <h1>**from</h1>
              <h1>ไป</h1>
              <h1>**to</h1>
            </div>
            <div class="bottomright1">
              <img src="./img/logo_for_baggage.png" alt="">
              <p>I Landed Airline</p>
            </div>
          </div>
          <div class="content-box-right2">
            <div class="box-white">
              <div class="topbox">
                <div class="mix-text-name">
                  <h2>นาย</h2>
                  <h2>ปะราณี</h2>
                  <h2>จักสีดู</h2>
                </div>
                <div class="mix-text-sampara">
                  <p>สัมภาระทั้งหมด</p>
                  <div>
                    <p1>0 กิโลกรัม</p1>
                  </div>
                </div>
              </div>
              <div class="bottombox">
                <div class="radio-group">
                  <input type="radio" id="radio1" name="radio-group" class="radio-input" checked>
                  <label for="radio1" class="radio-label">
                    <div class="groupcircle-0kg">
                      <span class="radio-inner-circle"></span>
                      ไม่มีสัมภาระ
                    </div>
                    <p>0 บาท</p>
                  </label>

                  <input type="radio" id="radio2" name="radio-group" class="radio-input">
                  <label for="radio2" class="radio-label">
                    <div class="groupcircle-5kg">
                      <span class="radio-inner-circle"></span>
                      +5 กิโลกรัม
                    </div>
                    <p>250 บาท</p>
                  </label>

                  <input type="radio" id="radio3" name="radio-group" class="radio-input">
                  <label for="radio3" class="radio-label">
                    <div class="groupcircle-10kg">
                      <span class="radio-inner-circle"></span>
                      +10 กิโลกรัม
                    </div>
                    <p>320 บาท</p>
                  </label>

                  <input type="radio" id="radio4" name="radio-group" class="radio-input">
                  <label for="radio4" class="radio-label">
                    <div class="groupcircle-15kg">
                      <span class="radio-inner-circle"></span>
                      +15 กิโลกรัม
                    </div>
                    <p>425 บาท</p>
                  </label>

                  <input type="radio" id="radio5" name="radio-group" class="radio-input">
                  <label for="radio5" class="radio-label">
                    <div class="groupcircle-20kg">
                      <span class="radio-inner-circle"></span>
                      +20 กิโลกรัม
                    </div>
                    <p>455 บาท</p>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bottomlock">
        <div class="leftbottom">
          <div class="mix-text-price">
            <h1>ราคาทั้งหมด</h1>
            <div style="display: flex;">
              <h1>THB</h1>
              <h1>**1000</h1>
            </div>
          </div>
          <p>(สำหรับทุกเที่ยวบินและทุกผู้โดยสาร)</p>
        </div>
        <div class="rightbottom">
          <button id="gopaymentbutton">ดำเนินการต่อ</button>
        </div>
      </div>
    </div>
  </div>

  <script>

    function toPayment() {
        window.location.href = "../PAYMENT/book3.php";
    }

    gopaymentbutton = document.getElementById("gopaymentbutton");
    gopaymentbutton.addEventListener("click", toPayment);

  </script>


</body>

</html>