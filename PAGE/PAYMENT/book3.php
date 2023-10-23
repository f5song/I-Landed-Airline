<!-- http://localhost/ISAD-ilal/PAGE/PAYMENT/book3.php -->

<?php
session_start();
require_once '../../CRUD/config/db.php';

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_login'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
  header('location: ../SIGNUPLOGIN/login.php');
}

// ตรวจสอบการออกจากระบบ
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: ' . $_SESSION['redirect_url']);
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ดึงข้อมูลผู้โดยสาร
$sql = "SELECT
    r.reservation_id,
    r.passenger_id,
    r.flight_id,
    r.baggage_weight,
    r.total_price,
    r.seat_number,
    p.passenger_id,
    p.title,
    p.first_name,
    p.last_name,
    f.flight_id,
    f.travel_date,
    dep.state AS departure_state,
    arr.state AS arrival_state,
    DATE_FORMAT(f.`departure_time`, '%H:%i') AS formatted_departure_time, 
    DATE_FORMAT(f.`arrival_time`, '%H:%i') AS formatted_arrival_time, 
    f.available_seats,
    f.flight_cost
FROM reservations AS r
JOIN passengers AS p ON r.passenger_id = p.passenger_id
JOIN flight AS f ON r.flight_id = f.flight_id
JOIN airport AS dep ON f.departure_airport = dep.airport_code
JOIN airport AS arr ON f.arrival_airport = arr.airport_code";


$result = mysqli_query($conn, $sql);

$passengers = array();

while ($row = mysqli_fetch_assoc($result)) {
  $passenger = array(
    'title' => $row['title'],
    'first_name' => $row['first_name'],
    'last_name' => $row['last_name'],
    'passenger_id' => $row['passenger_id'],
    'reservation_id' => $row['reservation_id'],
    'flight_id' => $row['flight_id'],
    'travel_date' => $row['travel_date'],
  );
  $passengers[] = $passenger;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />

  <link rel="stylesheet" href="./global3.css" />
  <link rel="stylesheet" href="./book3.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@400;500;600;700&display=swap" />
</head>

<body>
  <?php echo $passenger['travel_date']; ?>
  <div class="payment-confirmation-page">
    <div class="frame-for-descrip-customer">
      <div class="frame-for-all-descrip-customer"></div>
      <div class="descrip-customer">
        <div class="text-descrip-customer">รายละเอียดผู้สั่งซื้อ</div>
        <div class="frame-fill-email">
          <div class="info-paid"><?php echo $_SESSION['hello_user']; ?></div>
        </div>
        <div class="text-email">ที่อยู่อีเมล์</div>
      </div>
    </div>
    <div class="detail-number-order">
      <div class="frame-for-all-detail-num-order"></div>
      <div class="book-id">
        <div class="text-book-id">หมายเลขการจอง</div>
        <div class="text-fake-id"><?php echo $passenger['reservation_id']; ?></div>
      </div>
      <div class="your-travel">
          <div class="text-depart-to-arri">
            <div class="text-depart">
              <ul class="bkk">
                Hua Hin
              </ul>
            </div>
            <div class="text-arri">Chiangmai</div>
            <img
              class="icon-arrow-right"
              alt=""
              src="./public/-icon-arrowright.svg"
            />
          </div>
          <div class="text-your-travel">การเดินทางของคุณ</div>
          <div class="text-date">2023-10-02</div>
          <div class="fligh">
            <div class="text-flight">เที่ยวบิน</div>
          </div>
        </div>

        <div class="name-passenger">
          <div class="text-paeesnger-name">รายชื่อผู้โดยสาร</div>
          <div class="text-name1"> อิอิ</div>
        </div>

      <img class="separate-line-icon" alt="" src="./public/separate-line.svg" />

      <img class="separate-line-icon1" alt="" src="./public/separate-line.svg" />
    </div>
    <div class="frame-for-paying">
      <div class="top-frame">
        <div class="frame-for-payment-way"></div>
        <div class="text-payment-way">ทางเลือกการชำระเงินในประเทศไทย</div>
      </div>
      <div class="blue-frame">
        <div class="blue-bar">
          <div class="bar"></div>
        </div>
        <div class="text-i-laned-container">
          <span>I Laned Airline</span>
          <span class="pay">Pay</span>
        </div>
        <div class="animation-credit" onclick="hideshow1()">
          <div class="text-credit">บัตรเครดิต/เดบิต</div>
        </div>
        <div class="animation-bank" onclick="hideshow2()">
          <div class="text-credit">โอนเงินผ่านธนาคาร</div>
        </div>
        <div class="animation-counter" onclick="hideshow3()"">
            <div class=" text-credit">เคาน์เตอร์ชำระเงิน</div>
      </div>
    </div>
    <div class="frame-available"></div>
  </div>





  <div class="payment-three-ways">

    <div class="div3" style="display: none;" id="3.1">
      <div class="text-paid-by">เคาน์เตอร์ชำระเงิน</div>
      <div class="text-descrip-before">กรุณาอ่านก่อนชำระเงิน</div>
      <div class="text-select-payment">เลือกช่องทางชำระ</div>
      <div class="descrip-price">
        <div class="frame-for-all-descrip-price"></div>
        <div class="text-descrip-price">รายละเอียดราคา</div>
        <div class="text-i-landed">I Landed Airline x *1*</div>
        <div class="text-total-price3">ราคารวม</div>
        <div class="text-num-price">THB *1000.00*</div>
        <div class="text-num-total">THB *1000.00*</div>
        <img class="separate-icon" alt="" src="./public/separate.svg" />
      </div>
      <div class="paid-by-counter" id="buttonContinueOrder3">
        <div class="text-paid-by1">ชำระโดย เคาน์เตอร์ชำระเงิน</div>
      </div>
      <div class="text-click-to">
        เมื่อคลิกปุ่มด้านล่าง จะถือว่าเสร็จสิ้นการชำระเงินโดยทันที
      </div>
      <div class="description-counter">
        <div class="text-description-counter-container">
          <ul class="mobile-banking-atm">
            <li class="li">
              ผู้ให้บริการช่องทางชำระเงินอาจเรียกเก็บค่าธรรมเนียมเพิ่มเติม
            </li>
            <li class="li">
              คุณสามารถชำระผ่านการโอนเงิน (Mobile Banking หรือ ATM)
              โดยไม่ต้องเสียค่าธรรมเนียมใดๆ
            </li>
            <li class="li">ค่าธรรมเนียมจะไม่สามารถขอคืนได้</li>
          </ul>
        </div>
      </div>
      <div class="eleven1">
        <div class="text-7-eleven">7-Eleven</div>
        <img class="img-7-eleven-icon1" alt="" src="./public/img-7eleven1@2x.png" />
      </div>
      <div class="familymart4">
        <div class="text-familymart">FamilyMart</div>
        <img class="img-familymart-icon1" alt="" src="./public/img-familymart1@2x.png" />
      </div>
      <div class="tesco-lotus">
        <div class="text-tesco-lotus">Tesco Lotus</div>
        <img class="img-tesco-icon" alt="" src="./public/img-lotus@2x.png" />
      </div>
    </div>


    <div class="div3" id="2.1" style="display: none;">
      <div class="descrip-price">
        <div class="frame-for-all-descrip-price"></div>
        <div class="text-descrip-price">รายละเอียดราคา</div>
        <div class="text-i-landed">I Landed Airline x *1*</div>
        <div class="text-total-price3">ราคารวม</div>
        <div class="text-num-price">THB *1000.00*</div>
        <div class="text-num-total">THB *1000.00*</div>
        <img class="separate-icon" alt="" src="./public/separate.svg" />
      </div>
      <div class="paid-by-bank" id="buttonContinueOrder2">
        <div class="text-paid-by1">โอนเงินผ่านธนาคาร</div>
      </div>
      <div class="text-click-to">
        เมื่อคลิกปุ่มด้านล่าง จะถือว่าเสร็จสิ้นการชำระเงินโดยทันที
      </div>
      <div class="text-description-paid-container">
        <span class="text-name-txt-container">
          <p class="blank-line">
            ชำระเงินได้ผ่านโมบายแบงก์กิ้ง ตู้ ATM หรือเคาน์เตอร์ธนาคาร
            และสามารถชำระผ่านอินเทอร์เน็ตแบงก์กิ้งได้ทั้ง
          </p>
          <p class="blank-line">
            ช่องทางนี้ หรือช่องทาง “อินเทอร์เน็ตแบงก์กิ้ง” ในหน้า
            “เลือกวิธีชำระเงิน”
          </p>
          <p class="blank-line">&nbsp;</p>
          <p class="blank-line">
            กรุณาชำระเงินโดยตรงผ่านธนาคารด้านล่างเท่านั้น
            โดยไม่ผ่านตัวแทนชำระเงิน
          </p>
        </span>
      </div>
      <div class="text-paid-by6">โอนเงินผ่านธนาคาร</div>
      <div class="description-counter1">
        <div class="text-description-counter-container">
          <ul class="ul6">
            <li class="li">
              จำนวนเงินที่โอนจะต้องตรงกับจำนวนเงินที่ระบุด้านล่าง(รวมหน่วยสตางค์)
              มิเช่นนั้น การจองจะไม่ได้รับการดำเนินการ
            </li>
            <li class="li">
              ธนาคารที่ใช้โอนกับธนาคารที่รับโอน จะต้องเป็นธนาคารเดียวกัน
              เพื่อให้ยืนยันการชำระเงินได้รวดเร็วขึ้น
            </li>
            <li class="li">
              สามารถโอนเงินผ่านช่องทาง โมบายแบงก์กิ้ง อินเตอร์เน็ตแบงก์กิ้ง
              เอทีเอ็ม หรือ เคาน์เตอร์ธนาคาร
            </li>
          </ul>
        </div>
        <div class="text-descrip-before1">กรุณาอ่านก่อนชำระเงิน</div>
      </div>
      <div class="text-select-bank">เลือกธนาคาร</div>
      <div class="krungth-bank">
        <div class="text-krungth-bank1">ธนาคารกรุงไทย</div>
        <img class="img-krungth-bank" alt="" src="./public/img-krungth-bank@2x.png" />
      </div>
      <div class="kasikorn-bank">
        <div class="text-kasikorn-bank1">ธนาคารกสิกรไทย</div>
        <img class="img-kasikorn-bank" alt="" src="./public/img-kasikorn-bank@2x.png" />
      </div>
      <div class="th-panit-bank">
        <div class="text-panit-bank1">ธนาคารไทยพาณิชย์</div>
        <img class="img-panit-bank1" alt="" src="./public/img-panit-bank1@2x.png" />
      </div>
    </div>


    <div class="div8" style="display: none;" id="1.1">
      <div class="frame-for-all-descrip-price2"></div>
      <div class="paid-by-credit" id="buttonContinueOrder1">
        <div class="text-paid-by1">ชำระโดย บัตรเครดิต/เดบิต</div>
      </div>
      <div class="text-click-to">
        เมื่อคลิกปุ่มด้านล่าง จะถือว่าเสร็จสิ้นการชำระเงินโดยทันที
      </div>
      <div class="descrip-price2">
        <div class="text-descrip-price2">รายละเอียดราคา</div>
        <div class="text-i-landed2">I Landed Airline x *1*</div>
        <div class="text-total-price11">ราคารวม</div>
        <div class="text-num-price2">THB *1000.00*</div>
        <div class="text-num-total2">THB *1000.00*</div>
        <img class="separate-line-icon2" alt="" src="./public/separate.svg" />
      </div>
      <div class="pic">
        <img class="img-visa-icon" alt="" src="./public/img-visa@2x.png" />

        <img class="img-master-card" alt="" src="./public/img-master-card@2x.png" />

        <img class="img-secure-icon" alt="" src="./public/img-secure@2x.png" />

        <img class="img-jcb-icon" alt="" src="./public/img-jcb@2x.png" />
      </div>
      <input type="text" id="credit-id" name="credit-id" class="frame-name-card">
      <div class="text-name-card">ชื่อบนบัตร</div>
      <!-- <div class="frame-credit-id">
            <div class="text-fill-name">หมายเลขบัตรเครดิต</div>
          </div> -->
      <input type="text" id="credit-id" name="credit-id" class="frame-credit-id">
      <div class="text-credit-card">หมายเลขบนบัตรเครดิต</div>
      <div class="textt-credit-debit">บัตรเครดิต/เดบิต</div>
    </div>
  </div>
  <div class="payment">
    <div class="text-payment">การชำระเงิน</div>
  </div>
  <div class="navbar">
    <div class="navbar1"></div>
    <img class="img-logo-icon" alt="" src="./public/img-logo@2x.png" />

    <div class="process-three-step">
      <div class="received-ticket">
        <div class="text-received-ticket">รับตั๋ว</div>
        <div class="num3">
          <div class="pic-circle"></div>
          <div class="text-3">3</div>
        </div>
      </div>
      <img class="separate-line-icon3" alt="" src="./public/separate-line1.svg" />

      <div class="paid">
        <div class="text-paid">ชำระเงิน</div>
        <div class="num2">
          <div class="circle-2"></div>
          <div class="text-3">2</div>
        </div>
      </div>
      <img class="seperate-line-icon" alt="" src="./public/separate-line1.svg" />

      <div class="order">
        <div class="text-order">จอง</div>
        <div class="num1">
          <div class="pic-circle"></div>
          <div class="text-3">1</div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="footber-bg"></div>
    <div class="line-bottom-page"></div>
    <img class="img-logo-icon1" alt="" src="./public/img-logo1@2x.png" />

    <div class="text-and-button">
      <img class="icon-instagram" alt="" src="./public/icon-instagram.svg" />

      <img class="icon-envelope" alt="" src="./public/icon-envelope.svg" />

      <b class="text-contact-us">ติดต่อเรา</b>
      <div class="button-ani-sign-up">
        <div class="text-sign-up-container">
          <p class="blank-line">ลงทะเบียน</p>
        </div>
      </div>
      <div class="button-ani-login">
        <div class="text-sign-up-container">เข้าสู่ระบบ</div>
      </div>
      <b class="text-account">ACCOUNT</b>
      <div class="button-ani-help">
        <div class="text-help">ช่วยเหลือ</div>
      </div>
      <div class="button-ani-homepage">
        <div class="text-homepage">
          <p class="blank-line">หน้าแรก</p>
        </div>
      </div>
      <div class="button-ani-recomm-place">
        <div class="text-recomm">
          <p class="blank-line">แนะนำสถานที่</p>
        </div>
      </div>
      <b class="text-ilanded-airline">I-LANDED AIRLINE</b>
    </div>
  </div>
  </div>
</body>


<script src="script.js"></script>
<script>
  var buttonContinueOrder1 = document.getElementById("buttonContinueOrder1");
  var buttonContinueOrder2 = document.getElementById("buttonContinueOrder2");
  var buttonContinueOrder3 = document.getElementById("buttonContinueOrder3");
  if (buttonContinueOrder1 || buttonContinueOrder2 || buttonContinueOrder3) {
    buttonContinueOrder1.addEventListener("click", function(e) {
      window.location.href = "../ETICKET/checkticket.php";
    });
    buttonContinueOrder2.addEventListener("click", function(e) {
      window.location.href = "../ETICKET/checkticket.php";
    });
    buttonContinueOrder3.addEventListener("click", function(e) {
      window.location.href = "../ETICKET/checkticket.php";
    });
  }
</script>

</html>