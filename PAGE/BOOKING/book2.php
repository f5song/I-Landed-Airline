<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
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
$flight_id = $_GET['flight_id'];


$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql_flight = "SELECT 
            f.`flight_id`,
            f.`departure_airport`, 
            f.`arrival_airport`,
            f.`travel_date`, 
            f.`aircraft_id`, 
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title1 = $_POST['title'];
    $first_name1 = $_POST['first_name'];
    $last_name1 = $_POST['last_name'];
    $phone_number1 = $_POST['phone_number'];
    $user_id = $_SESSION['user_login'];


    $conn = new mysqli($servername, $username, $password, $dbname);



    $formNumber = 1;
    while (isset($_POST["passenger{$formNumber}_firstname"])) {
        $user_id = $_SESSION['user_login'];
        $title = $_POST["passenger{$formNumber}_title"];
        $firstname = $_POST["passenger{$formNumber}_firstname"];
        $lastname = $_POST["passenger{$formNumber}_lastname"];
        $phone_number = $_POST["passenger{$formNumber}_phone_number"];
        $dob = $_POST["passenger{$formNumber}_dob"];

        if (!empty($title) && !empty($firstname) && !empty($lastname) && !empty($phone_number) && !empty($dob)) {

        $sql = "INSERT INTO passengers (user_id, first_name, last_name, phone_number, title, dob) 
                VALUES ('$user_id', '$firstname', '$lastname', '$phone_number', '$title', '$dob')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "";
            if($row['aircraft_id'] == 1){
                header("location: ../SEAT/aircraft1/aircraft1.php?flight_id=$flight_id");
            }
            elseif($row['aircraft_id'] == 2){
                header("location: ../SEAT/aircraft2/aircraft2.php?flight_id=$flight_id");
            }
        } else {
            echo "ข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
        }
    }

        $formNumber++;
    }


    $sql = "UPDATE users SET title='$title1', first_name='$first_name1', last_name='$last_name1', phone_number='$phone_number1' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "ผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }


    $conn->close();
}
?>
<!-- for go to browser -->

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
                    <?php echo $_SESSION['hello_user']; ?>
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


    <form method="post">
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

                                <div class="xxxy">
                                    <label for="title">คำนำหน้าชื่อ:</label>
                                    <select id="title" name="title">
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                    </select>
                                </div>
                                <div class="row1-info">
                                    <div class="firstname-info">
                                        <div class="text-firstname">
                                            <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                            <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                        </div>
                                        <div class="input-firstname">
                                            <input type="text"  name="first_name" placeholder="กรอกข้อมูล">
                                        </div>
                                    </div>
                                    <div class="lastname-info">
                                        <div class="text-lastname">
                                            <p1>นามสกุล</p1>
                                            <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                        </div>
                                        <div class="input-lastname">
                                            <input type="text"  name="last_name" placeholder="กรอกข้อมูล">
                                        </div>
                                    </div>
                                </div>

                                <div class="phone-info">
                                    <div class="text-phone">
                                        <p1>หมายเลขโทรศัพท์</p1>
                                    </div>
                                    <div class="input-phone">
                                        <input type="text" name="phone_number" placeholder="กรอกหมายเลข">
                                    </div>
                                </div>

                            </div>
                        </div>
>
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

                    <div class="header-friend">
                        <p>รายละเอียดผู้เดินทาง</p>
                        <!-- add passenger -->
                        <div class="mix-button">
                            <p>โปรดเลือกจำนวนผู้โดยสาร: </p>
                            <select class="dropdown-menu" id="dropdown-menu">
                                <option value="" disabled selected>จำนวน</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>

                            </select>
                            <div class="button-add" id="addfriend">ยืนยัน</div>
                        </div>
                    </div>


                        <div class="content-friend-info">
                            <!-- 1 -->
                            <div class="bottom-content-1">
                                <div class="for-bottom-content">
                                </div>
                                <div class="friend-info">
                                    <div class="header-friend1">
                                        <p>ผู้โดยสาร 1</p>
                                    </div>
                                    <div class="friend1-info">

                                        <div class="xxxy">
                                            <label for="title">คำนำหน้าชื่อ:</label>
                                            <select class="selectxxxy" id="title" name="passenger1_title">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss">Miss</option>
                                            </select>
                                        </div>

                                    <div class="row1-info-friend">
                                        <div class="firstname-info-friend">
                                            <div class="text-firstname-friend">
                                                <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-firstname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล" name="passenger1_firstname">
                                            </div>
                                        </div>
                                        <div class="lastname-info-friend">
                                            <div class="text-lastname-friend">
                                                <p1>นามสกุล</p1>
                                                <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                            </div>
                                            <div class="input-lastname-friend">
                                                <input type="text" placeholder="กรอกข้อมูล" name="passenger1_lastname">
                                            </div>
                                        </div>
                                        <div class="birthday-info">
                                            <div class="text-birthday-friend">
                                                <p>วันเกิด</p>
                                            </div>
                                            <div class="input-birthday-friend">
                                                <input type="date" name="passenger1_dob">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row2-info-friend">
                                        <div class="phone-info-friend">
                                            <div class="text-phone-friend">
                                                <p1>หมายเลขโทรศัพท์</p1>
                                            </div>
                                            <div class="input-phone-friend">
                                                <input type="text" placeholder="กรอกหมายเลข" name="passenger1_phone_number">
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

                                            <div class="xxxy">
                                                <label for="title">คำนำหน้าชื่อ:</label>
                                                <select class="selectxxxy" id="title" name="passenger2_title">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>

                                            <div class="row1-info-friend">
                                                <div class="firstname-info-friend">
                                                    <div class="text-firstname-friend">
                                                        <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-firstname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger2_firstname">
                                                    </div>
                                                </div>
                                                <div class="lastname-info-friend">
                                                    <div class="text-lastname-friend">
                                                        <p1>นามสกุล</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-lastname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger2_lastname">
                                                    </div>
                                                </div>
                                                <div class="birthday-info">
                                                    <div class="text-birthday-friend">
                                                        <p>วันเกิด</p>
                                                    </div>
                                                    <div class="input-birthday-friend">
                                                        <input type="date" name="passenger2_dob">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row2-info-friend">
                                                <div class="phone-info-friend">
                                                    <div class="text-phone-friend">
                                                        <p1>หมายเลขโทรศัพท์</p1>
                                                    </div>
                                                    <div class="input-phone-friend">
                                                        <input type="text" placeholder="กรอกหมายเลข"
                                                            name="passenger2_phone_number">
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

                                            <div class="xxxy">
                                                <label for="title">คำนำหน้าชื่อ:</label>
                                                <select class="selectxxxy" id="title" name="passenger3_title">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>

                                            <div class="row1-info-friend">
                                                <div class="firstname-info-friend">
                                                    <div class="text-firstname-friend">
                                                        <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-firstname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger3_firstname">
                                                    </div>
                                                </div>
                                                <div class="lastname-info-friend">
                                                    <div class="text-lastname-friend">
                                                        <p1>นามสกุล</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-lastname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger3_lastname">
                                                    </div>
                                                </div>
                                                <div class="birthday-info">
                                                    <div class="text-birthday-friend">
                                                        <p>วันเกิด</p>
                                                    </div>
                                                    <div class="input-birthday-friend">
                                                        <input type="date" name="passenger3_dob">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row2-info-friend">
                                                <div class="phone-info-friend">
                                                    <div class="text-phone-friend">
                                                        <p1>หมายเลขโทรศัพท์</p1>
                                                    </div>
                                                    <div class="input-phone-friend">
                                                        <input type="text" placeholder="กรอกหมายเลข"
                                                            name="passenger3_phone_number">
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

                                            <div class="xxxy">
                                                <label for="title">คำนำหน้าชื่อ:</label>
                                                <select class="selectxxxy" id="title" name="passenger4_title">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>

                                            <div class="row1-info-friend">
                                                <div class="firstname-info-friend">
                                                    <div class="text-firstname-friend">
                                                        <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-firstname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger4_firstname">
                                                    </div>
                                                </div>
                                                <div class="lastname-info-friend">
                                                    <div class="text-lastname-friend">
                                                        <p1>นามสกุล</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-lastname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger4_lastname">
                                                    </div>
                                                </div>
                                                <div class="birthday-info">
                                                    <div class="text-birthday-friend">
                                                        <p>วันเกิด</p>
                                                    </div>
                                                    <div class="input-birthday-friend">
                                                        <input type="date" name="passenger4_dob">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row2-info-friend">
                                                <div class="phone-info-friend">
                                                    <div class="text-phone-friend">
                                                        <p1>หมายเลขโทรศัพท์</p1>
                                                    </div>
                                                    <div class="input-phone-friend">
                                                        <input type="text" placeholder="กรอกหมายเลข"
                                                            name="passenger4_phone_number">
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

                                            <div class="xxxy">
                                                <label for="title">คำนำหน้าชื่อ:</label>
                                                <select class="selectxxxy" id="title" name="passenger5_title">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>

                                            <div class="row1-info-friend">
                                                <div class="firstname-info-friend">
                                                    <div class="text-firstname-friend">
                                                        <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-firstname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger5_firstname">
                                                    </div>
                                                </div>
                                                <div class="lastname-info-friend">
                                                    <div class="text-lastname-friend">
                                                        <p1>นามสกุล</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-lastname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger5_lastname">
                                                    </div>
                                                </div>
                                                <div class="birthday-info">
                                                    <div class="text-birthday-friend">
                                                        <p>วันเกิด</p>
                                                    </div>
                                                    <div class="input-birthday-friend">
                                                        <input type="date" name="passenger5_dob">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row2-info-friend">
                                                <div class="phone-info-friend">
                                                    <div class="text-phone-friend">
                                                        <p1>หมายเลขโทรศัพท์</p1>
                                                    </div>
                                                    <div class="input-phone-friend">
                                                        <input type="text" placeholder="กรอกหมายเลข"
                                                            name="passenger5_phone_number">
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

                                            <div class="xxxy">
                                                <label for="title">คำนำหน้าชื่อ:</label>
                                                <select class="selectxxxy" id="title" name="passenger6_title">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                </select>
                                            </div>

                                            <div class="row1-info-friend">
                                                <div class="firstname-info-friend">
                                                    <div class="text-firstname-friend">
                                                        <p1>ชื่อจริงและชื่อกลาง (หากมี)</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-firstname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger6_firstname">
                                                    </div>
                                                </div>
                                                <div class="lastname-info-friend">
                                                    <div class="text-lastname-friend">
                                                        <p1>นามสกุล</p1>
                                                        <p2>*(กรุณากรอกA-Zเท่านั้น)</p2>
                                                    </div>
                                                    <div class="input-lastname-friend">
                                                        <input type="text" placeholder="กรอกข้อมูล"
                                                            name="passenger6_lastname">
                                                    </div>
                                                </div>
                                                <div class="birthday-info">
                                                    <div class="text-birthday-friend">
                                                        <p>วันเกิด</p>
                                                    </div>
                                                    <div class="input-birthday-friend">
                                                        <input type="date" name="passenger6_dob">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row2-info-friend">
                                                <div class="phone-info-friend">
                                                    <div class="text-phone-friend">
                                                        <p1>หมายเลขโทรศัพท์</p1>
                                                    </div>
                                                    <div class="input-phone-friend">
                                                        <input type="text" placeholder="กรอกหมายเลข"
                                                            name="passenger6_phone_number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-gogolock">
                        <div class="button-mama">
                            <button id="button-mama">ดำเนินการต่อ</button>
                        </div>
                    </div>
                    </div>
                </div>
                </form>
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

                bottomContent1.style.display = "none";
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
                        bottomContent5.style.display = "block";ห
                    }
                    if (selectedValue === "6") {
                        bottomContent6.style.display = "block";
                    }
                }
                button.addEventListener("click", selectAmountPassenger);

            </script>


</body>

</html>