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
    f.aircraft_id,
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
        'departure_state' => $row['departure_state'],
        'arrival_state' => $row['arrival_state'],
        'formatted_departure_time' => $row['formatted_departure_time'],
        'formatted_arrival_time' => $row['formatted_arrival_time'],
        'aircraft_id' => $row['aircraft_id'],
    );
    $passengers[] = $passenger;
}
?>
<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />

    <link rel="stylesheet" href="checkticket.css" />
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
        <div class="header-paid">
            <h3>ชำระเงินเสร็จสิ้น</h3>
        </div>
        <div class="top-content">
            <div class="left-box">
                <div class="box">
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
                                <p style="font-size: large;">
                                    i landed airline
                                </p>
                                <div class="text-aircraft">
                                    <p> aircraft id :</p>
                                    <span class="text-airid">
                                        <?php echo $passenger['aircraft_id']; ?>
                                    </span>
                                </div>
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
                            <p style="font-size: large;"> วันที่ออกเดินทาง </p>
                            <p  class="text_date" style="font-size: large;">
                                <?php echo $passenger['travel_date']; ?>
                            </p>
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
                                        echo "<td data-label='Departure Time'>" . $row['baggage_weight'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($conn);

                                ?>
                            </table>

                        </div>

                        <p class="total-price">ราคารวม:
                            <?php echo $passenger['travel_date']; ?>
                        </p>


                    </table-box>
                </div>
            </div>


            <div class="right-box">
                <div cslass="contact-info-box">
                    <div class="content-airplane">

                        <div class="booking-number">
                            <pgrey>หมายเลขการจอง</pgrey>
                            <pblack>
                                <?php echo $passenger['reservation_id']; ?>
                            </pblack>
                        </div>
                        <div class="travelinfo">
                            <pgrey>การเดินทางของคุณ</p>

                                <div class="flight-in-travelinfo">
                                    <pblack>เที่ยวบิน</pblack>
                                    <pgrey style="font-size: 15px;">
                                        <?php echo $passenger['flight_id']; ?>
                                    </pgrey>
                                </div>

                                <div class="fromto">
                                    <pblack>จาก</pblack>
                                    <pgrey>
                                        <?php echo $passenger['departure_state']; ?>
                                    </pgrey>
                                    <pblack>ไปถึง</pblack>
                                    <pgrey>
                                        <?php echo $passenger['arrival_state']; ?>
                                    </pgrey>
                                </div>

                        </div>


                        <div class="passenger">
                            <pgrey>ชื่อผู้จอง</pgrey>
                            <pname>
                                <?php echo $passenger['first_name'] . ' ' . $passenger['last_name']; ?>
                            </pname>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="bottom-content">
            <div class="backtohomeframe" id="backtohome">
                <p class="backtohome" id="backtohome"> กลับหน้าหลัก</p>
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