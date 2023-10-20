<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_login'];

// session_start();
// รับข้อมูลจากแบบฟอร์ม
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];

// ตรวจสอบรหัสผ่านเก่า
// คำสั่ง SQL นี้จำเป็นต้องป้องกัน SQL Injection
$query = "SELECT * FROM users WHERE user_id = '$user_id' AND password = '$oldPassword'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // รหัสผ่านเก่าถูกต้อง
    // อัปเดตรหัสผ่านใหม่
    $updateQuery = "UPDATE users SET password = '$newPassword' WHERE user_id = '$user_id'";
    
    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['success'] = "รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว";
        header("location: order.php");
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน: " . $conn->error;
        header("location: order.php");

    }
} else {
    $_SESSION['error'] = "รหัสผ่านเก่าไม่ถูกต้อง";
    header("location: order.php");


}

$conn->close();
?>
