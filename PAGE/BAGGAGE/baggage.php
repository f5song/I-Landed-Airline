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
    p.last_name
FROM reservations AS r
JOIN passengers AS p ON r.passenger_id = p.passenger_id";

$result = mysqli_query($conn, $sql);

$passengers = array();

while ($row = mysqli_fetch_assoc($result)) {
    $passenger = array(
        'title' => $row['title'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'baggage_weight' => $row['baggage_weight'],
        'passenger_id' => $row['passenger_id']
    );
    $passengers[] = $passenger;
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$sql_baggage = "SELECT * FROM baggage_pricing";
$result_baggage = mysqli_query($conn, $sql_baggage);

$baggageOptions = array();

if ($result_baggage) {
    while ($row = mysqli_fetch_assoc($result_baggage)) {
        $option = array(
            'baggage_weight' => $row['baggage_weight'],
            'baggage_price' => $row['baggage_price']
        );
        $baggageOptions[] = $option;
    }
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
            <!-- เนื่องจากไม่มีข้อมูลในตัวแปร $_SESSION['user_login'] ดังนั้นควรตรวจสอบการล็อกอินอื่น ๆ และรับข้อมูลผู้ใช้ที่จำเป็นตามความต้องการ -->
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
                </div>
                <div class="righttop">
                    <div class="contentright1">
                        <div class="bottomright1">
                            <img src="./img/logo_for_baggage.png" alt="">
                            <p>I Landed Airline</p>
                        </div>
                    </div>
                    <div class="content-box-right2">

                        <body>
                            <div class="box-white">
                                <form method="post" action="process_baggage.php">
                                    <?php foreach ($passengers as $passenger): ?>
                                        <div class="topbox">
                                            <div class="mix-text-name">
                                                <h2>
                                                    <?= $passenger['title'] ?>
                                                </h2>
                                                <h2>
                                                    <?= $passenger['first_name'] ?>
                                                </h2>
                                                <h2>
                                                    <?= $passenger['last_name'] ?>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="radio-group">
                                            <input type="radio" id="radio<?= $passenger['passenger_id'] ?>_0"
                                                name="passengers[<?= $passenger['passenger_id'] ?>][baggage_weight]"
                                                value="0.00" class="radio-input">
                                            <label for="radio<?= $passenger['passenger_id'] ?>_0" class="radio-label">
                                                <div class="groupcircle-2kg">
                                                    <span class="radio-inner-circle"></span>
                                                    0 กิโลกรัม
                                                </div>
                                                <p>ราคา 0 บาท</p>
                                            </label>
                                        </div>
                                        <div class="radio-group">
                                            <input type="radio" id="radio<?= $passenger['passenger_id'] ?>_5"
                                                name="passengers[<?= $passenger['passenger_id'] ?>][baggage_weight]"
                                                value="5.00" class="radio-input">
                                            <label for="radio<?= $passenger['passenger_id'] ?>_5" class="radio-label">
                                                <div class="groupcircle-2kg">
                                                    <span class="radio-inner-circle"></span>
                                                    5 กิโลกรัม
                                                </div>
                                                <p>ราคา 250 บาท</p>
                                            </label>
                                        </div>
                                        <div class="radio-group">
                                            <input type="radio" id="radio<?= $passenger['passenger_id'] ?>_10"
                                                name="passengers[<?= $passenger['passenger_id'] ?>][baggage_weight]"
                                                value="10.00" class="radio-input">
                                            <label for="radio<?= $passenger['passenger_id'] ?>_10" class="radio-label">
                                                <div class="groupcircle-2kg">
                                                    <span class="radio-inner-circle"></span>
                                                    10 กิโลกรัม
                                                </div>
                                                <p>ราคา 320 บาท</p>
                                            </label>
                                        </div>
                                        <div class="radio-group">
                                            <input type="radio" id="radio<?= $passenger['passenger_id'] ?>_15"
                                                name="passengers[<?= $passenger['passenger_id'] ?>][baggage_weight]"
                                                value="15.00" class="radio-input">
                                            <label for="radio<?= $passenger['passenger_id'] ?>_15" class="radio-label">
                                                <div class="groupcircle-2kg">
                                                    <span class="radio-inner-circle"></span>
                                                    15 กิโลกรัม
                                                </div>
                                                <p>ราคา 425 บาท</p>
                                            </label>
                                        </div>
                                        <div class="radio-group">
                                            <input type="radio" id="radio<?= $passenger['passenger_id'] ?>_20"
                                                name="passengers[<?= $passenger['passenger_id'] ?>][baggage_weight]"
                                                value="20.00" class="radio-input">
                                            <label for="radio<?= $passenger['passenger_id'] ?>_20" class="radio-label">
                                                <div class="groupcircle-2kg">
                                                    <span class="radio-inner-circle"></span>
                                                    20 กิโลกรัม
                                                </div>
                                                <p>ราคา 455 บาท</p>
                                            </label>
                                        </div>
                                        <!-- ... และ Radio buttons อื่น ๆ ... -->
                                    <?php endforeach; ?>
                                    <div class="for-button">
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </body>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var submitButton = document.getElementById('submit_button');

        submitButton.addEventListener('click', function () {
            var formData = {};

            // รวบรวมข้อมูลจากฟอร์ม
            var formData = {};
            var radioInputs = document.querySelectorAll('.radio-input');

            radioInputs.forEach(function (input) {
                var passengerId = input.name;
                var baggageWeight = input.value;
                formData[passengerId] = baggageWeight;
            });

            // ส่งข้อมูลไปยัง process_baggage.php
            fetch('process_baggage.php', {
                method: 'POST',
                body: JSON.stringify(formData),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.text()) // รับข้อมูลผลลัพธ์เป็นข้อความ
                .then(data => {
                    // ทำสิ่งที่คุณต้องการกับข้อมูลผลลัพธ์ที่ได้รับ
                    alert(data); // แสดงข้อความเพื่อตรวจสอบเท่านั้น
                })
                .catch(error => {
                    console.error('เกิดข้อผิดพลาดในการส่งข้อมูล: ' + error);
                });
        });
    });
</script>

</html>