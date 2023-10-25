
<!-- http://localhost/ISAD-ilal/PAGE/ETICKET/checkticket.php -->
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
$user_id = $_SESSION['user_login'];

// ดึงข้อมูลผู้โดยสาร
$sql = "SELECT DISTINCT
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
    f.aircraft_id,
    f.flight_cost,
    s.class,
    a.aircraft_code,
    a.aircraft_name
FROM reservations AS r
JOIN passengers AS p ON r.passenger_id = p.passenger_id
JOIN flight AS f ON r.flight_id = f.flight_id
JOIN aircraft AS a ON f.aircraft_id = a.aircraft_id
JOIN seats AS s ON r.seat_number = s.seat_number
JOIN airport AS dep ON f.departure_airport = dep.airport_code
JOIN airport AS arr ON f.arrival_airport = arr.airport_code
GROUP BY p.passenger_id;";

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
    'departure_state' => $row['departure_state'],
    'arrival_state' => $row['arrival_state'],
    'formatted_departure_time' => $row['formatted_departure_time'],
    'formatted_arrival_time' => $row['formatted_arrival_time'],
    'aircraft_id' => $row['aircraft_id'],
    'class' => $row['class'],
    'aircraft_code' => $row['aircraft_code'],
    'aircraft_name' => $row['aircraft_name']
  );
  $passengers[] = $passenger;
}
?>
<!DOCTYPE html>

<html>

<head>
    <link 
    rel="stylesheet" 
    href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap"
    />

    <link rel="stylesheet" href="checkticket.css"/>
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
                    <?php echo $_SESSION['user_login']; ?>
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

    
    <div class="paid-box">

        <div class="left-box">
            <div class="box">
                <p> ชำระเงินเสร็จสิ้น </p>
                <div class="blue-blox">
                    <text-e-ticket> E-Ticket/ตั๋วอิเล็กทรอนิกส์ </text-e-ticket>
                </div>
                <div class="white-box">
                        <img src="./checkticketpics/logo_airline.png" alt="logo" class="logo_airline">
    
                        <div style="padding-top: 30px;">
                            <p class="reserv-id"> 
                                รหัสการจอง
                            </p>
                            <p class="reserv-info"> 
                            <?php echo $passenger['reservation_id']; ?>
                            </p>
                        </div>
                </div>
                <div>
                    <div class="between-line">
                        <div style="width: 100%; height: 1px; background: #C2BFBF;"></div>
                    </div>
                </div>
                <div class="important-info">
                    <div class="aircraft-id">
                        <div>       
                            <p style="font-size: large; color: #7a7a7a;"> 
                                i landed airline 
                            </p>
                            <p style="font-size: large;">
                                <p><?php echo $passenger['aircraft_code']; ?> <?php echo $passenger['aircraft_name']; ?></p> 
                            </p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="dpt-arv">     
                        <div class="dpt-box">
                            <p class="dpt-time"> 
                                <?php echo $passenger['departure_state']; ?> 
                            </p>
                            <p class="dpt-airport"> 
                                <?php echo $passenger['formatted_departure_time']; ?>
                            </p>
                        </div>
                        <div class="dpt-arv-line">
                            <svg class="blank-circle" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M11.2144 6C11.2144 9.06965 8.89506 11.5 6.1033 11.5C3.31154 11.5 0.992188 9.06965 0.992188 6C0.992188 2.93035 3.31154 0.5 6.1033 0.5C8.89506 0.5 11.2144 2.93035 11.2144 6Z" stroke="#A2A2A2"/>
                            </svg>
    
                            <div class="between-line">
                                <div style="width: 57.046px; height: 1px; background: #C2BFBF;"></div>
                            </div>
    
                            <svg class="fill-circle" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
                                <ellipse cx="6.43679" cy="6" rx="5.61111" ry="6" fill="#868686"/>
                            </svg>
                        </div>
    
                        <div class="arv-box">
                            <p class="arv-time">
                                <?php echo $passenger['arrival_state']; ?>  
                            </p>
                            <p class="arv-airport">
                                <?php echo $passenger['formatted_arrival_time']; ?> 
                            </p>
                        </div>
                    </div>
    
                    <div class="top-right" style="padding-bottom: 20px;">   
                        <p  style="font-size: large;"> วันที่ออกเดินทาง </p>
                        <p  style="font-size: small;"> <?php echo $passenger['travel_date']; ?>  </p>
                    </div> 
                </div>

                
    
                <table-box>
                    <div class="text-ticket-info-box">
                        <table-head> ข้อมูล </table-head>
                    </div>
                    <div class="for-space">
                        <table>
                            <tr>
                                <th>รหัสผู้โดยสาร</th>
                                <th>ชื่อผู้โดยสาร</th>
                                <th>ที่นั่ง</th>
                                <th>คลาส</th>
                                <th>กระเป๋า</th>                         
                            </tr>
                            <?php

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td data-label='Departure State'>" . $row["passenger_id"] . "</td>";
                                    echo "<td data-label='Arrival Time'>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>";
                                    echo "<td data-label='Arrival State'>" . $row["seat_number"] . "</td>";
                                    echo "<td data-label='Departure Time'>" . $row['class'] . "</td>";
                                    echo "<td data-label='Departure Time'>" . $row['baggage_weight'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            mysqli_close($conn);
                            
                            ?>      
                        </table>
                        
                    </div>

                    <?php
                    // ตั้งค่าการเชื่อมต่อฐานข้อมูล
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "mydb";

                    // ทำการเชื่อมต่อ
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // ตรวจสอบการเชื่อมต่อ
                    if ($conn->connect_error) {
                        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
                    }

                    // สร้างสอบงสำหรับการค้นหาราคาของ reservation_id โดยรวมกันตาม user_id
                    $sql = "SELECT user_id, SUM(total_price) AS total_price FROM reservations GROUP BY user_id";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // วนลูปผลลัพธ์และแสดงผล
                        while($row = $result->fetch_assoc()) {
                            $userId = $row["user_id"];
                            $totalPrice = $row["total_price"];
                        }
                    }

                    // ปิดการเชื่อมต่อฐานข้อมูล
                    $conn->close();
                    ?>

                    <p class="total-price">ราคารวม: <?php echo "$totalPrice"; ?> THB</p>


                </table-box>

                <div class="backtohomeframe" id="backtohome">
                    <p class="backtohome" id="backtohome"> กลับหน้าหลัก</p>
                </div>
                
                
            </div>  

        </div>


        <div class="right-box">
            <div class="contact-info-box">
                <div class="content-airplane">
                    
                    <div class="booking-number">
                        <pgrey>หมายเลขการจอง</pgrey>
                        <?php foreach ($passengers as $passenger): ?>
                            <pblack><?php echo $passenger['reservation_id']; ?>  </pblack>
                        <?php endforeach; ?>
                        
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" width="439" height="2" viewBox="0 0 439 2" fill="none">
                        <path d="M0 1H439" stroke="#A8A4A4"/>
                    </svg>

                    <div class="travelinfo">
                        <pgrey>การเดินทางของคุณ</p>

                            <div class="flight-in-travelinfo">
                                <pblack>เที่ยวบิน</pblack>
                                <pgrey style="font-size: 15px;"><?php echo $passenger['flight_id']; ?></pgrey>
                            </div>

                        <div class="fromto">
                            <pblack>จาก</pblack>
                            <pgrey ><?php echo $passenger['departure_state']; ?>  </pgrey>
                            <pblack>ไปถึง</pblack>
                            <pgrey><?php echo $passenger['arrival_state']; ?>  </pgrey>
                        </div>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" width="439" height="2" viewBox="0 0 439 2" fill="none">
                        <path d="M0 1H439" stroke="#A8A4A4"/>
                    </svg>
                
                    <div class="passenger">
                        <pgrey>ชื่อผู้จอง</pgrey>
                        <pname><?php echo $passenger['first_name'] . ' '. $passenger['last_name']; ?></pname>
                    </div>
                </div>
            </div>
            
        </div>
        

    </div>




    <script>
    var backtohome = document.getElementById("backtohome");

    if (backtohome) {
      backtohome.addEventListener("click", function (e) {
        window.location.href = "../HOMEPAGE/homepage.php";
      });
    }
  </script>



</body>

</html>







