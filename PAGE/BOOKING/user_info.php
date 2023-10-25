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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // ดึง user_id จากเซสชัน
    $user_id = $_SESSION['user_login'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูล
    $sql = "UPDATE users SET title='$title', first_name='$first_name', last_name='$last_name', phone_number='$phone_number' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "อัปเดตข้อมูลสำเร็จ";
    } else {
        echo "ผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }

    $conn->close();
}
?>