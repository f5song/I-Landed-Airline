

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
                    <li><a href="../RECCOMMEND/reccom.html"> แนะนำสถานที่ </a></li>
                    <li><a href="../ORDER/order.html"> คำสั่งซื้อ </a></li>
                    <li><a href="../HELP/help.html"> ช่วยเหลือ </a></li>
                </ul>
            
                <div class="rightcontainer">
                    <p>สวัสดี,</p>
                    <p> <?php echo $_SESSION['user_login']; ?> </p>
                    <a href="flight.php?logout='1'">
                        <img class="img-logout-icon" id="button-logout"alt="" src="../ALLNAVBAR/logout.png" />
                    </a>
                </div>
            </nav>




        <?php } else {?>

            <nav>
                <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline"> </a>

                    <ul>
                        <li><a href="../HOMEPAGE/homepage.php"> หน้าแรก </a></li>
                        <li><a href="../FLIGHT/flight.php"> เที่ยวบิน </a></li>
                        <li><a href="../RECCOMMEND/reccom.html"> แนะนำสถานที่ </a></li>
                        <li><a href="../ORDER/order.html"> คำสั่งซื้อ </a></li>
                        <li><a href="../HELP/help.html"> ช่วยเหลือ </a></li>
                    </ul>
                
                <div class="rightcontainer">
                        <button class = "button-sign-in" type="button" onclick="toLogin()" > เข้าสู่ระบบ </button>
                        <button class = "button-sign-up" type="button" > ลงทะเบียน </button>  
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
                        <select class="dropdown-menu">
                            <option value="" disabled selected>เลือกเที่ยวบินของคุณ</option>
                            <option value="bkk">กรุงเทพฯ(BKK)</option>
                            <option value="hkt">ภูเก็ต(HKT)</option>
                            <option value="uth">อุดรธานี(UTH)</option>
                            <option value="hdy">หาดใหญ่(HDY)</option>
                            <option value="kbv">กระบี่(KBV)</option>
                            <option value="btz">ยะลา(BTZ)</option>
                            <option value="cei">เชียงราย(CEI)</option>
                          </select>
                    </div>
                </div>
                <img src="./img/exchange.png" alt="exchange" class="exchange">
                <div class="to">
                    <p> ถึง: </p>
                    <div class="box-search">
                        <select class="dropdown-menu">
                            <option value="" disabled selected>เลือกเที่ยวบินของคุณ</option>
                            <option value="bkk">กรุงเทพฯ(BKK)</option>
                            <option value="hkt">ภูเก็ต(HKT)</option>
                            <option value="uth">อุดรธานี(UTH)</option>
                            <option value="hdy">หาดใหญ่(HDY)</option>
                            <option value="kbv">กระบี่(KBV)</option>
                            <option value="btz">ยะลา(BTZ)</option>
                            <option value="cei">เชียงราย(CEI)</option>
                          </select>
                    </div>
                </div>
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
                  $servername = "localhost"; // เซิร์ฟเวอร์ MySQL
                  $username = "root"; // ชื่อผู้ใช้ฐานข้อมูล
                  $password = ""; // รหัสผ่านฐานข้อมูล
                  $dbname = "mydb"; // ชื่อฐานข้อมูล
                  
                  // สร้างการเชื่อมต่อ
                  $conn = mysqli_connect($servername, $username, $password, $dbname);
        
                  // ตรวจสอบการเชื่อมต่อ
                  if (!$conn) {
                    die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
                  }
        
                  $sql = "SELECT * FROM flight";
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
                      echo "<td data-label='Booking Status'><a href='../book2/book2.php?flight_id=" . $row["flight_id"] . "' class='btn btn__active' id='btn_active'>Booking Now</a></td>";
                      echo "</tr>";
                    }
                  }
        
                  // ปิดการเชื่อมต่อฐานข้อมูล
                  mysqli_close($conn);
                  ?>
                </tbody>
              </table>
        </div>
    </div>
</body>

</html>