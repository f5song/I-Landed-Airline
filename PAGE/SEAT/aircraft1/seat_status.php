<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$flight_id = $_GET["flight_id"];

// ดึงข้อมูลที่นั่งที่ถูกจองสำหรับเที่ยวบินที่ระบุ
$sql = "SELECT seat_number FROM reservations WHERE flight_id = '$flight_id'";
$result = $conn->query($sql);

$reservedSeats = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservedSeats[] = $row["seat_number"];
    }
}

echo json_encode($reservedSeats);

$conn->close();
?>