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

$seatNumbers = $_POST["selectedSeats"];
$passengerIDs = $_POST["selectedPassengers"];
$flight_id = $_GET["flight_id"];
$user_id = $_SESSION['user_login'];


if (count($seatNumbers) != count($passengerIDs))  {
    echo "จำนวนที่นั่งและผู้โดยสารไม่สอดคล้อง";
} else {
    for ($i = 0; $i < count($seatNumbers); $i++) {
        $seatNumber = $seatNumbers[$i];
        $passengerID = $passengerIDs[$i];

        $sql = "INSERT INTO reservations (passenger_id, flight_id, user_id, seat_number)
        VALUES ('$passengerID', '$flight_id', '$user_id', '$seatNumber')";

        if ($conn->query($sql) === TRUE) {
            echo "จองที่นั่งเรียบร้อย: $passengerID - $seatNumber<br>";
        } else {
            echo "เกิดข้อผิดพลาดในการจองที่นั่ง: " . $conn->error;
        }
    }

    header('Location: ../../BAGGAGE/baggage.php');
    exit;


}

$conn->close();
?>