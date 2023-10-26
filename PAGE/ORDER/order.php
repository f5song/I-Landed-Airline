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
$user_id = $_SESSION['user_login'];

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
p.last_name,
f.flight_id,
f.travel_date,
dep.state AS departure_state,
arr.state AS arrival_state,
DATE_FORMAT(f.departure_time, '%H:%i') AS formatted_departure_time, 
DATE_FORMAT(f.arrival_time, '%H:%i') AS formatted_arrival_time, 
f.available_seats,
f.aircraft_id,
f.flight_cost,
s.class
FROM reservations AS r
JOIN passengers AS p ON r.passenger_id = p.passenger_id
JOIN flight AS f ON r.flight_id = f.flight_id
JOIN seats AS s ON r.seat_number = s.seat_number
JOIN airport AS dep ON f.departure_airport = dep.airport_code
JOIN airport AS arr ON f.arrival_airport = arr.airport_code
GROUP BY p.passenger_id;";
?>

<!DOCTYPE html>

<html>

<meta charset="utf-8" />
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />
<link rel="stylesheet" href="../ALLNAVBAR/navbar.css" />
<link rel="stylesheet" href="order.css" />

<body>
    <!-- ส่วน bar -->
    <?php if (isset($_SESSION['user_login'])) { ?>

        <nav>
            <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline">
            </a>
            <ul>
                <li><a href="../HOMEPAGE/homepage.php"> หน้าแรก </a></li>
                <li><a href="../FLIGHT/flight.php"> เที่ยวบิน </a></li>
                <li><a href="../RECCOMMEND/reccom.php"> แนะนำสถานที่ </a></li>
                <li><a href="../ORDER/order.php"> คำสั่งซื้อ </a></li>
                <li><a href="../HELP/help.php"> ช่วยเหลือ </a></li>
            </ul>

            <div class="rightcontainer">
                <p>สวัสดี,</p>
                <p>
                    <?php echo $_SESSION['hello_user']; ?>
                </p>
                <a href="homepage.php?logout='1'">
                    <img class="img-logout-icon" id="button-logout" alt="" src="../ALLNAVBAR/logout.png" />
                </a>
            </div>
        </nav>




    <?php } else { ?>

        <nav>
            <a href="../HOMEPAGE/homepage.php"> <img src="../ALLNAVBAR/logo_airline.png" alt="logo" class="logo_airline">
            </a>

            <ul>
                <li><a href="../HOMEPAGE/homepage.php"> หน้าแรก </a></li>
                <li><a href="../FLIGHT/flight.php"> เที่ยวบิน </a></li>
                <li><a href="../RECCOMMEND/reccom.php"> แนะนำสถานที่ </a></li>
                <li><a href="../ORDER/order.php"> คำสั่งซื้อ </a></li>
                <li><a href="../HELP/help.php"> ช่วยเหลือ </a></li>
            </ul>

            <div class="rightcontainer">
                <button class="button-sign-in" type="button" onclick="toLogin()"> เข้าสู่ระบบ </button>
                <button class="button-sign-up" type="button"> ลงทะเบียน </button>
            </div>
        </nav>

    <?php } ?>

    <div class="box">
        <div class="leftlock">
            <div class="headerleftlock">
                <div class="myorder">
                    <div class="img-order">
                        <img src="./img/myorder.png" alt="">
                    </div>
                    <div class="text-myorder" id="myorderforbutton">
                        <p>คำสั่งซื้อของฉัน</p>
                    </div>
                </div>
                <div class="myacc">
                    <div class="img-order">
                        <img src="./img/myacc.png" alt="">
                    </div>
                    <div class="text-myacc" id="myaccforbutton">
                        <p>ข้อมูลส่วนตัว</p>
                    </div>
                </div>
                <div class="editacc">
                    <div class="img-order">
                        <img src="./img/edit.png" alt="">
                    </div>
                    <div class="text-editacc" id="editaccforbutton">
                        <p>แก้ไขข้อมูลส่วนตัว</p>
                    </div>
                </div>
                <div class="deleteacc">
                    <div class="img-order">
                        <img src="./img/deleteacc.png" alt="">
                    </div>
                    <div class="text-deleteacc" id="deleteaccforbutton">
                        <p>ลบบัญชีผู้ใช้</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightlock">
            <div class="show-hide-myorder" id="myorder-content">
                <div class="header-myorder">
                    <h1>คำสั่งซื้อทั้งหมด</h1>
                </div>
                    <?php
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="content-myorder">';
                            echo '<div class="list1-order">';
                            echo '<div class="listbarblue">';
                            echo '<p1>หมายเลขการจอง</p1>';
                            echo '<p3>' . $row['reservation_id'] . '</p3>';
                            echo '</div>';
                            echo '<div class="listcontent">';
                            echo '<div class="listname">';
                            echo '<img src="./img/user.png" alt="">';
                            echo '<span>' . $row['title'] . ' ' . $row['first_name'] . ' ' . $row['last_name'] . '</span>';
                            echo '</div>';
                            echo '<div class="listwhere">';
                            echo '<img src="./img/logo_airline.png" alt="">';
                            echo '<span>' . $row['departure_state'] . '</span>';
                            echo '<span>ไป</span>';
                            echo '<span>' . $row['arrival_state'] . '</span>';
                            echo '</div>';
                            echo '<div class="listclass">';
                            echo '<div class="allin-listclass">';
                            echo '<img src="./img/seat.png" alt="">';
                            echo '<p>' . $row['class'] . '</p>';
                            echo '</div>';
                            echo '<div id="goToPageButton" class="button-seeticket">'; // ใช้ ID ที่ไม่ซ้ำกัน
                            echo '<button>ดูตั๋ว</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                        }
                    }
                    mysqli_close($conn);
                    ?>
            </div>

            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "mydb";
                $conn = new mysqli($servername, $username, $password, $dbname);
                $user_id = $_SESSION['user_login'];
                $user_sql = "SELECT * FROM users WHERE user_id = '$user_id'";
                $user_result = mysqli_query($conn, $user_sql);

                if (!$user_result) {
                    die("คำสั่ง SQL ผิดพลาด: " . mysqli_error($conn));
                }

                // ดึงข้อมูลผู้ใช้จากผลลัพธ์ของ SQL
                if (mysqli_num_rows($user_result) > 0) {
                    $user_row = mysqli_fetch_assoc($user_result);
                } else {
                    echo "ไม่พบข้อมูลผู้ใช้";
                }
            ?>

            <div class="show-hide-listbook" id="listbook-content"></div>
            <div class="show-hide-myacc" id="myacc-content">
                <div class="myacclock">
                    <div class="myaccpv">
                        <div class="header-pv">
                            <p>ข้อมูลส่วนตัว</p>
                        </div>
                        <div class="content-pv">
                            <div class="name-title">
                                <p>คำนำหน้า</p>
                                <div class="box-title">
                                    <p><?php echo $user_row['title']; ?> </p>
                                </div>
                            </div>
                            <div class="allname">
                                <p>ชื่อจริง-นามสกุล</p>
                                <div class="box-name">
                                    <span><?php echo $user_row['first_name']; ?>  </span>
                                    <span><?php echo $user_row['last_name']; ?> </span>
                                </div>
                            </div>
                            <div class="phone-pv">
                                <p>เบอร์โทรศัพท์</p>
                                <div class="box-phone">
                                    <p><?php echo $user_row['phone_number']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="myaccemail">
                        <div class="header-email">
                            <p>อีเมล์</p>
                        </div>
                        <div class="content-email">
                            <div class="box-email">
                                <p><?php echo $_SESSION['hello_user']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="show-hide-editacc" id="editacc-content">
                <div class="myacclock">
                    <div class="myaccpv">
                        <div class="header-pv">
                            <p>ข้อมูลส่วนตัว</p>
                        </div>
                        <div class="content-pv">
                            <div class="name-title">
                                <p>คำนำหน้า</p>
                                <div class="box-title">
                                    <p><?php echo $user_row['title']; ?></p>
                                </div>
                            </div>
                            <div class="allname">
                                <p>ชื่อจริง-นามสกุล</p>
                                <div class="box-name">
                                    <span><?php echo $user_row['first_name']; ?></span>
                                    <span><?php echo $user_row['last_name']; ?></span>
                                </div>
                            </div>
                            <div class="phone-pv">
                                <p>เบอร์โทรศัพท์</p>
                                <div class="box-phone">
                                    <p><?php echo $user_row['phone_number']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <form class="form" action="change_password_db.php" method="POST">
                        

                        <div class="header-password">
                                <p>รหัสผ่าน*</p>
                            </div>
                            <div class="content-password">
                                <div class="box-password-edit">
                                    <input required placeholder="รหัสผ่านใหม่" type="password" class="input" name="password">
                                </div>
                                <div class="box-password-edit">
                                    <input required placeholder="กรอกรหัสผ่านใหม่อีกครั้ง" type="password" class="input" name="c_password">
                                </div>
                        </div>
                        <div class="submitform2">
                            <button class="submit" name="signup">บันทึกข้อมูลใหม่</button>
                        </div>

                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert-danger" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert-success" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['warning'])) { ?>
                        <div class="alert-warning" role="alert">
                            <?php
                            echo $_SESSION['warning'];
                            unset($_SESSION['warning']);
                            ?>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
            <div class="show-hide-deleteacc" id="deleteacc-content">
                <div class="deletelock">
                    <div class="deletelock2">
                        <img src="./img/bin.png" alt="">
                        <div class="header-delete">
                            <p1>ต้องการลบบัญชีผู้ใช้?</p1>
                            <p2>คุณจะสูญเสียสิ่งเหล่านี้ของคุณอย่างถาวร</p2>
                        </div>
                        <div class="delete-content">
                            <p>- โปรไฟล์</p>
                            <p>- ประวัติการจอง</p>
                        </div>
                        <div class="all-button-delete">
                            <button>ลบบัญชี</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        document.getElementById("goToPageButton").addEventListener("click", function() {
            // เปลี่ยนหน้าเว็บไปยัง URL ของหน้าอื่น
            window.location.href = "../ETICKET/checkticket.php";
        });


        document.getElementById("myorderforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");

            // ตรวจสอบสถานะการแสดงของ div
            if (myorder.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "My Order" และซ่อน "List of Books"
                myorder.style.display = "flex";
                myacc.style.display = "none";
                editacc.style.display = "none";
                deleteacc.style.display = "none";
            } else {
                // ถ้าแสดงอยู่ให้ซ่อน "My Order"
                myorder.style.display = "none";
            }
        });
        
        document.getElementById("myaccforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");


            // ตรวจสอบสถานะการแสดงของ div
            if (myacc.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                myacc.style.display = "block";
                editacc.style.display = "none";
                deleteacc.style.display = "none";
            } else {
                // ถ้าแสดงอยู่ให้ซ่อน "List of Books"
                myacc.style.display = "none";
            }
        });

        document.getElementById("editaccforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");


            // ตรวจสอบสถานะการแสดงของ div
            if (editacc.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                myacc.style.display = "none";
                editacc.style.display = "block";
                deleteacc.style.display = "none";
            } else {
                // ถ้าแสดงอยู่ให้ซ่อน "List of Books"
                editacc.style.display = "none";
            }
        });

        document.getElementById("deleteaccforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");


            // ตรวจสอบสถานะการแสดงของ div
            if (deleteacc.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                myacc.style.display = "none";
                editacc.style.display = "none";
                deleteacc.style.display = "block";
            } else {
                // ถ้าแสดงอยู่ให้ซ่อน "List of Books"
                deleteacc.style.display = "none";
            }
        });

    </script>
</body>

</html>