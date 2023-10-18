<!-- http://localhost/ISAD-ilal/PAGE/FLIGHT/flight.php -->


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

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />
<link rel="stylesheet" href="flight.css" />
<link rel="stylesheet" href="../ALLNAVBAR/navbar.css" />

<body>
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
          <?php echo $_SESSION['user_login']; ?>
        </p>
        <a href="flight.php?logout='1'">
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
        <button class="button-sign-up" type="button"> ลงทะเบียน </button>
      </div>
    </nav>

  <?php } ?>

  <div class="all-content">
    <div class="searchlock">
      <div class="search-bar">
        <img src="./img/ilandedairlinelogo.png" alt="logo" class="logo">
        <div class="from">
          <p> จาก: </p>
          <div class="box-search">
            <select class="dropdownselect_province" id="departure">
              <option value="" disabled selected>เลือกเที่ยวบินของคุณ</option>
              <option value="BKK">กรุงเทพฯ(BKK)</option>
              <option value="CNX">เชียงใหม่(CNX)</option>
              <option value="HKT">ภูเก็ต(HKT)</option>
              <option value="UTH">อุดรธานี(UTH)</option>
              <option value="HDY">หาดใหญ่(HDY)</option>
              <option value="KBV">กระบี่(KBV)</option>
              <option value="BTZ">ยะลา(BTZ)</option>
              <option value="CEI">เชียงราย(CEI)</option>
            </select>
          </div>
        </div>
        <img src="./img/exchange.png" alt="exchange" class="exchange">
        <div class="to">
          <p> ถึง: </p>
          <div class="box-search">
            <select class="dropdownselect_province" id="arrival">
                <option value="" disabled selected>เลือกเที่ยวบินของคุณ</option>
                <option value="BKK">กรุงเทพฯ(BKK)</option>
                <option value="CNX">เชียงใหม่(CNX)</option>
                <option value="HKT">ภูเก็ต(HKT)</option>
                <option value="UTH">อุดรธานี(UTH)</option>
                <option value="HDY">หาดใหญ่(HDY)</option>
                <option value="KBV">กระบี่(KBV)</option>
                <option value="BTZ">ยะลา(BTZ)</option>
                <option value="CEI">เชียงราย(CEI)</option>
            </select>
          </div>
        </div>
      </div>
      <div class="bottomcontent">
        <button class="button-search">ค้นหาเที่ยวบิน </button>
      </div>
    </div>

    <div class="flightlock">
      <table class="table">
        <thead>
          <tr>
            <th>Flight ID</th>
            <th>Departure Airport</th>
            <th>Arrival Airport</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Available Seats</th>
            <th>Price</th>
            <th>Booking Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost"; 
          $username = "root"; 
          $password = ""; 
          $dbname = "mydb"; 

          $conn = mysqli_connect($servername, $username, $password, $dbname);

          if (!$conn) {
            die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
          }

          $departure = isset($_GET['departure']) ? $_GET['departure'] : '';
          $arrival = isset($_GET['arrival']) ? $_GET['arrival'] : '';

          $sql = "SELECT * FROM flight";

          if (!empty($departure) && !empty($arrival)) {
              $sql .= " WHERE departure_airport = '$departure' AND arrival_airport = '$arrival'";
          }

          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td data-label='Flight ID'>" . $row["flight_id"] . "</td>";
                  echo "<td data-label='Departure Airport'>" . $row["departure_airport"] . "</td>";
                  echo "<td data-label='Arrival Airport'>" . $row["arrival_airport"] . "</td>";
                  echo "<td data-label='Departure Time'>" . $row["departure_time"] . "</td>";
                  echo "<td data-label='Arrival Time'>" . $row["arrival_time"] . "</td>";
                  echo "<td data-label='Available Seats'>" . $row["available_seats"] . "</td>";
                  echo "<td data-label='Price'>" . $row["flight_cost"] . "</td>";
                  echo "<td data-label='Booking Status'><a href='../BOOKING/book2.php?flight_id=" . $row["flight_id"] . "' class='btn btn__active' id='btn_active'>Booking Now</a></td>";
                  echo "</tr>";
              }
          }
          mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
    <script>
      document.querySelector('.button-search').addEventListener('click', function() {
      const departureValue = document.getElementById('departure').value;
      const arrivalValue = document.getElementById('arrival').value;
       window.location.href = `../FLIGHT/flight.php?departure=${departureValue}&arrival=${arrivalValue}`;
      });
    </script>
  </div>
</body>

</html>