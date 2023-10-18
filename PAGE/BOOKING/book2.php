<?php
$servername = "localhost"; // เซิร์ฟเวอร์ MySQL
$username = "root"; // ชื่อผู้ใช้ฐานข้อมูล
$password = ""; // รหัสผ่านฐานข้อมูล
$dbname = "mydb"; // ชื่อฐานข้อมูล

$conn = mysqli_connect($servername, $username, $password, $dbname);
$flight_id = $_GET['flight_id'];



$sql_flight = "SELECT 
            f.`flight_id`,
            f.`departure_airport`, 
            f.`arrival_airport`,
            f.`travel_date`, 
            a1.`state` AS departure_airport_state, 
            a2.`state` AS arrival_airport_state, 
            DATE_FORMAT(f.`departure_time`, '%H:%i') AS formatted_departure_time, 
            DATE_FORMAT(f.`arrival_time`, '%H:%i') AS formatted_arrival_time, 
            f.`available_seats`
        FROM 
            `flight` f
        JOIN 
            `airport` a1 ON f.`departure_airport` = a1.`airport_code`
        JOIN 
            `airport` a2 ON f.`arrival_airport` = a2.`airport_code`
        WHERE 
            f.`flight_id` = '$flight_id'";
$result_flight = mysqli_query($conn, $sql_flight);

if (!$result_flight) {
    die("คำสั่ง SQL ผิดพลาด: " . mysqli_error($conn));
}
if (mysqli_num_rows($result_flight) > 0) {
    $row = mysqli_fetch_assoc($result_flight);
} else {
    echo "ไม่พบข้อมูลสำหรับ flight_id ที่ระบุ";
}
session_start();
?>
<!-- for go to browser -->

<!-- http://localhost/I-Land-Airline/frontend/book2/book2.php -->



<!--    echo $row["flight_id"] ";
        echo $row["departure_airport"];
        echo "Arrival Airport: $row["arrival_airport"] ;        -->




<!DOCTYPE html>

<html>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />

<link rel="stylesheet" href="b_insert_info.css" />

<link rel="stylesheet" href="../ALLNAVBAR/navbar.css" />


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
                <a href="../HOMEPAGE/homepage.php?logout='1'">
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


    <div class="box-for-fill-info">
        <div class="box-of-item">
            <!-- blank -->
            <div class="mid">
                <div class="for-top-item">
                    <!-- text -->
                    <div class="text-book">
                        <txt>การจองของคุณ</txt>
                        <p class="undertext">กรอกข้อมูลและตรวจสอบการจอง</p>
                    </div>
                    <!-- circle -->
                    <div class="circle1-2-3">
                        <div class="circ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                fill="none">
                                <circle cx="13" cy="13" r="13" fill="#1F97D4" />
                                <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
                                    1
                                </text>
                            </svg>
                        </div>
                        <p style="color: #696969;" class="txt123">การจอง</p>
                        <div class="between-line">
                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="2" viewBox="0 0 29 2"
                                fill="none">
                                <path d="M0 1H29" stroke="#7C7C7C" />
                            </svg>
                        </div>
                        <div class="circ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                fill="none">
                                <circle cx="13" cy="13" r="13" fill="#696969" />
                                <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
                                    2
                                </text>
                            </svg>
                        </div>
                        <p style="color: #696969;" class="txt123">ชำระเงิน</p>
                        <div class="between-line">
                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="2" viewBox="0 0 29 2"
                                fill="none">
                                <path d="M0 1H29" stroke="#7C7C7C" />
                            </svg>
                        </div>
                        <div class="circ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                fill="none">
                                <circle cx="13" cy="13" r="13" fill="#696969" />
                                <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
                                    3
                                </text>
                            </svg>
                        </div>
                        <p style="color: #696969;" class="txt123">รับตั๋ว</p>
                    </div>

                </div>

                <div class="contact-info">
                    <p>รายละเอียดการติดต่อ</p>
                    <div class="contact-info-box">
                        <div class="content-contact">
                            <div class="header-content-contact">
                                <text>ข้อมูลการติดต่อ (สำหรับส่งตั๋ว/ใบจอง)</text>
                            </div>
                            <div class="personal-info">
                                <div class="row1-info">
                                    <div class="firstname-info">
                                        <div class="text-firstname">
                                            <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                            <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                        </div>
                                        <div class="input-firstname">
                                            <input type="text" placeholder="กรอกข้อมูล">
                                        </div>
                                    </div>
                                    <div class="lastname-info">
                                        <div class="text-lastname">
                                            <p1>นามสกุล</p1>
                                            <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                        </div>
                                        <div class="input-lastname">
                                            <input type="text" placeholder="กรอกข้อมูล">
                                        </div>
                                    </div>
                                </div>
                                <div class="row2-info">
                                    <div class="phone-info">
                                        <div class="text-phone">
                                            <p1>หมายเลขโทรศัพท์</p1>
                                        </div>
                                        <div class="input-phone">
                                            <input type="text" placeholder="กรอกหมายเลข">
                                        </div>
                                    </div>
                                    <div class="email-info">
                                        <div class="text-email">
                                            <p1>อีเมล์</p1>
                                        </div>
                                        <div class="input-email">
                                            <input type="text" placeholder="กรอกอีเมล์">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-airplane">
                            <div class="content-fromto">
                                <img class="img1" src="./public/airplane.png" alt="">
                                <h1>
                                    <?php echo $row['departure_airport_state'] ?>
                                </h1>
                                <img class="img2" src="./public/right-arrow.png" alt="">
                                <h1>
                                    <?php echo $row['arrival_airport_state'] ?>
                                </h1>
                            </div>
                            <div class="content-date">
                                <p1>วันที่บิน</p1>
                                <p2>
                                    <?php echo $row['travel_date'] ?>
                                </p2>
                            </div>
                            <div class="content-iconair">
                                <img src="public/img-logo@2x.png" alt="">
                                <h1>I Landed Airline</h1>
                            </div>
                            <div class="content-idair">
                                <div class="airfrom">
                                    <p1>
                                        <?php echo $row['formatted_departure_time'] ?>
                                    </p1>
                                    <p2>
                                        <?php echo $row['departure_airport'] ?>
                                    </p2>
                                </div>
                                <div class="lineair">
                                    <img src="./public/right-arrow.png" alt="">
                                </div>
                                <div class="airto">
                                    <p1>
                                        <?php echo $row['formatted_arrival_time'] ?>
                                    </p1>
                                    <p2>
                                        <?php echo $row['arrival_airport'] ?>
                                    </p2>
                                </div>
                            </div>
                            <div class="content-cant">
                                <img src="./public/info.png" alt="">
                                <p>ไม่สามารถคืนเงินได้</p>
                            </div>
                        </div>
                    </div>

                    <!-- 1 -->

                    <div class="bottom-content-1">
                        <div class="for-bottom-content">
                            <div class="header-friend">
                                <p>รายละเอียดผู้เดินทาง</p>
                                <!-- add passenger -->
                                <div class="mix-button">
                                    <p>โปรดเลือกจำนวนผู้โดยสาร: </p>
                                    <select class="dropdown-menu"id="dropdown-menu">
                                        <option value="" disabled select>จำนวนผู้โดยสาร</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    <button class="button-add"id="addfriend">ยืนยัน</button>
                                </div>
                            </div>
                            <div class="friend-info">
                                <div class="header-friend1">
                                    <p>ผู้โดยสาร 1</p>
                                </div>
                                <div class="friend1-info">
                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข">
                                            </div>
                                        </div>
                                        <div class="email-info-friend">
                                            <div class="text-email-friend">
                                                <p1>อีเมล์</p1>
                                            </div>
                                            <div class="input-email-friend">
                                                <input type="text" placeholder="กรอกอีเมล์">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->

                    <div class="bottom-content-2">
                        <div class="for-bottom-content">
                            <div class="friend-info">
                                <div class="header-friend1">
                                    <p>ผู้โดยสาร 2</p>
                                </div>
                                <div class="friend1-info">
                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข">
                                            </div>
                                        </div>
                                        <div class="email-info-friend">
                                            <div class="text-email-friend">
                                                <p1>อีเมล์</p1>
                                            </div>
                                            <div class="input-email-friend">
                                                <input type="text" placeholder="กรอกอีเมล์">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->

                    <div class="bottom-content-3">
                        <div class="for-bottom-content">
                            <div class="friend-info">
                                <div class="header-friend1">
                                    <p>ผู้โดยสาร 3</p>
                                </div>
                                <div class="friend1-info">
                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข">
                                            </div>
                                        </div>
                                        <div class="email-info-friend">
                                            <div class="text-email-friend">
                                                <p1>อีเมล์</p1>
                                            </div>
                                            <div class="input-email-friend">
                                                <input type="text" placeholder="กรอกอีเมล์">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 -->

                    <div class="bottom-content-4">
                        <div class="for-bottom-content">
                            <div class="friend-info">
                                <div class="header-friend1">
                                    <p>ผู้โดยสาร 4</p>
                                </div>
                                <div class="friend1-info">
                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข">
                                            </div>
                                        </div>
                                        <div class="email-info-friend">
                                            <div class="text-email-friend">
                                                <p1>อีเมล์</p1>
                                            </div>
                                            <div class="input-email-friend">
                                                <input type="text" placeholder="กรอกอีเมล์">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5 -->

                    <div class="bottom-content-5">
                        <div class="for-bottom-content">
                            <div class="friend-info">
                                <div class="header-friend1">
                                    <p>ผู้โดยสาร 5</p>
                                </div>
                                <div class="friend1-info">
                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข">
                                            </div>
                                        </div>
                                        <div class="email-info-friend">
                                            <div class="text-email-friend">
                                                <p1>อีเมล์</p1>
                                            </div>
                                            <div class="input-email-friend">
                                                <input type="text" placeholder="กรอกอีเมล์">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6 -->

                    <div class="bottom-content-6">
                        <div class="for-bottom-content">
                            <div class="friend-info">
                                <div class="header-friend1">
                                    <p>ผู้โดยสาร 6</p>
                                </div>
                                <div class="friend1-info">
                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข">
                                            </div>
                                        </div>
                                        <div class="email-info-friend">
                                            <div class="text-email-friend">
                                                <p1>อีเมล์</p1>
                                            </div>
                                            <div class="input-email-friend">
                                                <input type="text" placeholder="กรอกอีเมล์">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button-gogolock">
                        <div class="button-mama">
                            <button>ดำเนินการต่อ</button>
                        </div>
                    </div>
                </div>

            </div>



            <script>
                function toLogin() {
                    window.location.href = "../SIGNUPLOGIN/login.php";
                }

                function toSignup() {
                    window.location.href = "../SIGNUPLOGIN/register.php";
                }
            </script>


            <script>

                var button = document.getElementById("addfriend");
                var dropdown = document.getElementById("dropdown-menu");
                var bottomContent1 = document.querySelector(".bottom-content-1");
                var bottomContent2 = document.querySelector(".bottom-content-2");
                var bottomContent3 = document.querySelector(".bottom-content-3");
                var bottomContent4 = document.querySelector(".bottom-content-4");
                var bottomContent5 = document.querySelector(".bottom-content-5");
                var bottomContent6 = document.querySelector(".bottom-content-6");

                bottomContent1.style.display = "block";
                bottomContent2.style.display = "none";
                bottomContent3.style.display = "none";
                bottomContent4.style.display = "none";
                bottomContent5.style.display = "none";
                bottomContent6.style.display = "none";



                function selectAmountPassenger() {
                    var selectedValue = dropdown.value;
                    console.log("คุณเลือก: " + selectedValue);


                    bottomContent1.style.display = "none";
                    bottomContent2.style.display = "none";
                    bottomContent3.style.display = "none";
                    bottomContent4.style.display = "none";
                    bottomContent5.style.display = "none";
                    bottomContent6.style.display = "none";

                    // แสดงส่วนตามที่ถูกเลือก
                    if (selectedValue >= "1") {
                        bottomContent1.style.display = "block";
                    }
                    if (selectedValue >= "2") {
                        bottomContent2.style.display = "block";
                    }
                    if (selectedValue >= "3") {
                        bottomContent3.style.display = "block";
                    }
                    if (selectedValue >= "4") {
                        bottomContent4.style.display = "block";
                    }
                    if (selectedValue >= "5") {
                        bottomContent5.style.display = "block";
                    }
                    if (selectedValue === "6") {
                        bottomContent6.style.display = "block";
                    }
                }
                button.addEventListener("click", selectAmountPassenger);


            </script>



</body>

</html>