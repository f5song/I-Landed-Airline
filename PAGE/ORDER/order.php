<?php
session_start();
require_once '../../CRUD/config/db.php';
if (!isset($_SESSION['user_login'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    $_SESSION['notify'] = "กรุณาเข้าสู่ระบบก่อนใช้งาน";
    header('location: ../SIGNUPLOGIN/login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: ' . $_SESSION['redirect_url']);
}
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
                <div class="listbook">
                    <div class="img-order">
                        <img src="./img/listbook.png" alt="">
                    </div>
                    <div class="text-listbook" id="listbookforbutton">
                        <p>รายการจองทั้งหมด</p>
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
                <div class="content-myorder">
                    <div class="list1-order">
                        <div class="listbarblue">
                            <p1>หมายเลขการจอง</p1>
                            <p3>108256480</p3>
                        </div>
                        <div class="listcontent">
                            <div class="listname">
                                <img src="./img/user.png" alt="">
                                <span>นาย</span>
                                <span>พ่อมึงดิ</span>
                                <span>แม่มึงอะ</span>
                            </div>
                            <div class="listwhere">
                                <img src="./img/logo_airline.png" alt="">
                                <span>กรุงเทพ(BKK)</span>
                                <span>ไป</span>
                                <span>เชียงใหม่(CNX)</span>
                            </div>
                            <div class="listclass">
                                <div class="allin-listclass">
                                    <img src="./img/seat.png" alt="">
                                    <p>ชั้นธุรกิจ(Businees Class)</p>
                                </div>
                                <div class="button-seeticket">
                                    <button>ดูตั๋วอิเล็กทรอนิกส์</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <p>นาย</p>
                                </div>
                            </div>
                            <div class="allname">
                                <p>ชื่อจริง-นามสกุล</p>
                                <div class="box-name">
                                    <span>พิราภรณ์</span>
                                    <span>ประเสริฐ</span>
                                </div>
                            </div>
                            <div class="data-pv">
                                <p>วันเกิด</p>
                                <div class="box-date">
                                    <p>21/08/2546</p>
                                </div>
                            </div>
                            <div class="phone-pv">
                                <p>เบอร์โทรศัพท์</p>
                                <div class="box-phone">
                                    <p>0993961932</p>
                                </div>
                            </div>
                            <div class="iduser-pv">
                                <p>เลขประจำตัวประชาชน</p>
                                <div class="box-iduser">
                                    <p>1210958421213</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="myaccemail">
                        <div class="header-email">
                            <p>อีเมล์*</p>
                        </div>
                        <div class="content-email">
                            <div class="box-email">
                                <p>fonlnwzaza@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="myaccpassword">
                        <div class="header-password">
                            <p>รหัสผ่าน*</p>
                        </div>
                        <div class="content-password">
                            <div class="box-password">
                                <p>1234</p>
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
                                    <p>นาย</p>
                                </div>
                            </div>
                            <div class="allname">
                                <p>ชื่อจริง-นามสกุล</p>
                                <div class="box-name">
                                    <span>พิราภรณ์</span>
                                    <span>ประเสริฐ</span>
                                </div>
                            </div>
                            <div class="data-pv">
                                <p>วันเกิด</p>
                                <div class="box-date">
                                    <p>21/08/2546</p>
                                </div>
                            </div>
                            <div class="phone-pv">
                                <p>เบอร์โทรศัพท์</p>
                                <div class="box-phone">
                                    <p>0993961932</p>
                                </div>
                            </div>
                            <div class="iduser-pv">
                                <p>เลขประจำตัวประชาชน</p>
                                <div class="box-iduser">
                                    <p>1210958421213</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="myaccemail">
                        <div class="header-email">
                            <p>อีเมล์*</p>
                        </div>
                        <div class="content-email">
                            <div class="box-email-edit">
                                <input type="text" placeholder="กรอกอีเมล์ใหม่">
                            </div>
                        </div>
                    </div>
                    
                    <form method="post" action="change_password_db.php" class="myaccpassword">
                            <div class="header-password">
                                <p>รหัสผ่าน*</p>
                            </div>
                            <div class="content-password">
                                <div class="box-password-edit">
                                    <input type="password" name="old_password" placeholder="กรอกรหัสผ่านเก่า" required>
                                </div>
                                <div class="box-password-edit">
                                    <input type="password" name="new_password" placeholder="กรอกรหัสผ่านใหม่" required>
                                </div>
                            </div>
                            <div class="submitform2">
                            <button>บันทึกรหัสผ่านใหม่</button>
                            </div>
                    <!-- <button>ยืนยันการแก้ไข</button> -->
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


        document.getElementById("myorderforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var listbook = document.getElementById("listbook-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");

            // ตรวจสอบสถานะการแสดงของ div
            if (myorder.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "My Order" และซ่อน "List of Books"
                myorder.style.display = "flex";
                listbook.style.display = "none";
                myacc.style.display = "none";
                editacc.style.display = "none";
                deleteacc.style.display = "none";
            } else {
                // ถ้าแสดงอยู่ให้ซ่อน "My Order"
                myorder.style.display = "none";
            }
        });

        document.getElementById("listbookforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var listbook = document.getElementById("listbook-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");

            // ตรวจสอบสถานะการแสดงของ div
            if (listbook.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                listbook.style.display = "block";
                myacc.style.display = "none";
                editacc.style.display = "none";
                deleteacc.style.display = "none";
            } else {
                // ถ้าแสดงอยู่ให้ซ่อน "List of Books"
                listbook.style.display = "none";
            }
        });

        document.getElementById("myaccforbutton").addEventListener("click", function () {
            var myorder = document.getElementById("myorder-content");
            var listbook = document.getElementById("listbook-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");


            // ตรวจสอบสถานะการแสดงของ div
            if (myacc.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                listbook.style.display = "none";
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
            var listbook = document.getElementById("listbook-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");


            // ตรวจสอบสถานะการแสดงของ div
            if (editacc.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                listbook.style.display = "none";
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
            var listbook = document.getElementById("listbook-content");
            var myacc = document.getElementById("myacc-content");
            var editacc = document.getElementById("editacc-content");
            var deleteacc = document.getElementById("deleteacc-content");


            // ตรวจสอบสถานะการแสดงของ div
            if (deleteacc.style.display === "none") {
                // ถ้าซ่อนอยู่ให้โชว์ "List of Books" และซ่อน "My Order"
                myorder.style.display = "none";
                listbook.style.display = "none";
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