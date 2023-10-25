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

// ljlkllllklklklklklklklklklklklkklklkk



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

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

    $conn->close();
    
}
?>
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