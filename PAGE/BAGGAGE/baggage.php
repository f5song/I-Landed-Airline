<!-- http://localhost/ISAD-ILAL/PAGE/BAGGAGE/baggage.php -->


<?php
session_start();
if (!isset($_SESSION['user_login'])) {
  $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
  header('location: ../SIGNUPLOGIN/login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: ' . $_SESSION['redirect_url']);
}


$servername = "localhost"; // เซิร์ฟเวอร์ MySQL
$username = "root"; // ชื่อผู้ใช้ฐานข้อมูล
$password = ""; // รหัสผ่านฐานข้อมูล
$dbname = "mydb"; // ชื่อฐานข้อมูล

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM `baggage_pricing`";
$result = mysqli_query($conn, $sql);

$user_id = $_SESSION['user_id']; // แทนค่านี้ด้วยวิธีการเก็บข้อมูล user_id ของผู้ใช้ที่เข้าสู่ระบบ


if (!$result) {
    die("คำสั่ง SQL ผิดพลาด: " . mysqli_error($conn));
}
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "ไม่พบข้อมูลสำหรับ baggage price ที่ระบุ";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }
    $conn->close();
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
              <?php
      
                  $user_id = $_SESSION['user_id']; 
                  
                  $sql = "SELECT
                  f.flight_id,
                  f.travel_date,
                  dep.state AS departure_state,
                  arr.state AS arrival_state,
                  DATE_FORMAT(f.`departure_time`, '%H:%i') AS formatted_departure_time, 
                  DATE_FORMAT(f.`arrival_time`, '%H:%i') AS formatted_arrival_time, 
                  f.available_seats,
                  f.flight_cost
              FROM flight AS f
              JOIN airport AS dep ON f.departure_airport = dep.airport_code
              JOIN airport AS arr ON f.arrival_airport = arr.airport_code";
    
                  $result = mysqli_query($conn, $sql);

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="topbox">';
                    echo '<div class="mix-text-name">';
                    echo '<h2>' . $row['title'] . '</h2>';
                    echo '<h2>' . $row['first_name'] . '</h2>';
                    echo '<h2>' . $row['last_name'] . '</h2>';
                    echo '</div>';
                    echo '</div>';
                  }
                  ?>
              <div class="bottombox">
                <div class="radio-group">
                  <?php
                    echo '<input type="radio" id="radio' . $row['baggage_weight'] . '" name="radio-group" class="radio-input">';
                    echo '<label for="radio' . $row['baggage_weight'] . '" class="radio-label">';
                    echo '<div class="groupcircle-' . $row['baggage_weight'] . '">';
                    echo '<span class="radio-inner-circle"></span>';
                    echo '+ ' . $row['baggage_weight'] . ' กิโลกรัม';
                    echo '</div>';
                    echo '<p>' . $row['baggage_price'] . ' บาท</p>';
                    echo '</label>';
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<input type="radio" id="radio' . $row['baggage_weight'] . '" name="radio-group" class="radio-input">';
                    echo '<label for="radio' . $row['baggage_weight'] . '" class="radio-label">';
                    echo '<div class="groupcircle-' . $row['baggage_weight'] . '">';
                    echo '<span class="radio-inner-circle"></span>';
                    echo '+ ' . $row['baggage_weight'] . ' กิโลกรัม';
                    echo '</div>';
                    echo '<p>' . $row['baggage_price'] . ' บาท</p>';
                    echo '</label>';
                  }
                  ?>
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