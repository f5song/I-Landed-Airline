<?php
session_start();
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
$user_id = $_SESSION['user_login'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the payment method is set
    if (isset($_POST["payment_method"])) {
        $paymentMethod = $_POST["payment_method"];
        $reservationId = $passenger['reservation_id'];  // Assuming you have this value available

        // Insert payment information into the database
        $insertPaymentSQL = "INSERT INTO payment (reservation_id, payment_method) VALUES (?, ?)";
        $stmt = $conn->prepare($insertPaymentSQL);


        if ($stmt->execute()) {
            // Payment information inserted successfully
            echo "Payment information recorded successfully";
        } else {
            // Handle the case where the insertion failed
            echo "Error: ";
        }
    }
}

?>