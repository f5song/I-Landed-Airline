<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    $formNumber = 1;
    while (isset($_POST["passenger{$formNumber}_firstname"])) {
        $title = $_POST["passenger{$formNumber}_title"];
        $firstname = $_POST["passenger{$formNumber}_firstname"];
        $lastname = $_POST["passenger{$formNumber}_lastname"];
        $phone_number = $_POST["passenger{$formNumber}_phone_number"];
        $dob = $_POST["passenger{$formNumber}_dob"];

        $sql = "INSERT INTO passengers (firstname, lastname, phone_number, title, dob) 
                VALUES ('$firstname', '$lastname', '$phone_number', '$title', '$dob')";

        if ($conn->query($sql) === TRUE) {
            echo "บันทึกข้อมูลสำเร็จสำหรับผู้โดยสารที่ $formNumber";
        } else {
            echo "ข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
        }

        $formNumber++;
    }

    $conn->close();
}
?>
