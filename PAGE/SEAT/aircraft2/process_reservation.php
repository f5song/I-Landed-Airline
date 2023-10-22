<?php
session_start();
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลที่นั่งและผู้โดยสารจากแบบฟอร์ม
$seatNumbers = $_POST["selectedSeats"];
$passengerIDs = $_POST["selectedPassengers"];
$flight_id = $_GET["flight_id"];
$user_id = $_SESSION['user_login'];


// ในตัวอย่างนี้เรากำหนดไว้ว่า $seatNumbers และ $passengerIDs ต้องมีขนาดเท่ากัน
if (count($seatNumbers) != count($passengerIDs))  {
    echo "จำนวนที่นั่งและผู้โดยสารไม่สอดคล้อง";
} else {
    // วนลูปผู้โดยสารและที่นั่งที่ถูกเลือกและสร้างรายการการจอง
    for ($i = 0; $i < count($seatNumbers); $i++) {
        $seatNumber = $seatNumbers[$i];
        $passengerID = $passengerIDs[$i];

        $sql = "INSERT INTO reservations (passenger_id, flight_id, user_id, seat_number)
        VALUES ('$passengerID', '$flight_id', '$user_id', '$seatNumber')";

        if ($conn->query($sql) === TRUE) {
            // การเพิ่มข้อมูลเสร็จสมบูรณ์
            echo "จองที่นั่งเรียบร้อย: $passengerID - $seatNumber<br>";
        } else {
            echo "เกิดข้อผิดพลาดในการจองที่นั่ง: " . $conn->error;
        }
    }
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>