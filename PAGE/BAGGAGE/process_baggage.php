+<?php
session_start();
require_once '../../CRUD/config/db.php';

if (!isset($_SESSION['user_login'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('location: ../SIGNUPLOGIN/login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    if (isset($_POST['passengers']) && is_array($_POST['passengers'])) {
        foreach ($_POST['passengers'] as $passengerId => $data) {
            $baggageWeight = $data['baggage_weight'];

            $stmt = $conn->prepare("UPDATE reservations AS r
            JOIN baggage_pricing AS b ON r.baggage_weight = b.baggage_weight
            SET r.baggage_weight = ?, r.total_price = r.total_price + b.baggage_price
            WHERE r.passenger_id = ?");

            $stmt->bind_param("di", $baggageWeight, $passengerId);

            if ($stmt->execute()) {
                echo "บันทึกข้อมูลสำเร็จสำหรับผู้โดยสาร ID: " . $passengerId;

                // Redirect ไปยังหน้าอื่น ยกตัวอย่างเช่น:
                header('Location: ../PAYMENT/book3.php');
                
            } else {
                echo "ผิดพลาดในการบันทึกข้อมูลสำหรรับผู้โดยสาร ID: " . $passengerId . ", ข้อความผิดพลาด: " . $conn->error;
            }
        }
    } else {
        echo "ไม่พบข้อมูลผู้โดยสารที่ส่งมา";
    }

    $conn->close();
} else {
    header('Location: ../../PAYMENT/book3.php');
}
?>