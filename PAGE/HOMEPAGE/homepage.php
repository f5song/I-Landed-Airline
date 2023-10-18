<?php
session_start();
require_once '../../CRUD/config/db.php';
if (!isset($_SESSION['user_login'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: ' . $_SESSION['redirect_url']);
}

?>


<!-- http://localhost/ISAD-ilal/PAGE/HOMEPAGE/homepage.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheest" href="./global.css" />
    <link rel="stylesheet" href="./homepage.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />
    <link rel="stylesheet" href="../ALLNAVBAR/navbar.css" />

</head>

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
                    <?php echo $_SESSION['user_login']; ?>
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
                <button class="button-sign-up" type="button" onclick="toSignup()"> ลงทะเบียน </button>
            </div>
        </nav>

    <?php } ?>

    <script>
        function toLogin() {
            window.location.href = "../SIGNUPLOGIN/login.php";
        }
        function toSignup(){
            window.location.href = "../SIGNUPLOGIN/register.php";
        }
    </script>


    <!-- ส่วนหน้าจองตั๋วเครื่องบินบนสุด -->



    <div class="content">
        <div class="bluelock">
            <img src="./img/slideshow.gif" alt="" class="img_samui">
            <div class="header">
                <div class="header-content"><img src="./img/logo_thailand.png" alt="" class="logo_thailand">
                    <p>จองตั๋วเครื่องบินในประเทศไทย</p>
                </div>
            </div>
        </div>
        <div class="whitelock">


            <div class="leftcontent">
                <div class="topcontent">
                    <div class="leftbooking">
                        <div class="lefttopbooking">
                            <img src="./svg/airplane.svg" alt="">
                            <p>จาก</p>
                        </div>
                        <div class="leftbottombooking">
                            <select class="dropdownselect_province" id="departure">
                                <option value="" disabled selected>เลือกเที่ยวบินของคุณ</option>
                                <option value="BKK">กรุงเทพฯ(BKK)</option>
                                <option value="CNX">เชียงใหม่(CNX)</option>
                                <option value="HKT">ภูเก็ต(HKT)</option>
                                <option value="UTH">อุดรธานี(UTH)</option>
                                <option value="HDY">หาดใหญ่(HDY)</option>
                                <option value="KBV">กระบี่(KBV)</option>
                                <option value="BTZ">ยะลา(BTZ)</option>
                                <option value="CEI">เชียงราย(CEI)</option>
                            </select>
                        </div>
                    </div>
                    <img class="icon_reverse" src="./svg/vector3.svg" alt="">
                    <div class="rightbooking">
                        <div class="righttopbooking">
                            <img src="./svg/airplane.svg" alt="">
                            <p>ถึง</p>
                        </div>
                        <div class="rightbottombooking">
                            <select class="dropdownselect_province" id="arrival">
                                <option value="" disabled selected>เลือกเที่ยวบินของคุณ</option>
                                <option value="BKK">กรุงเทพฯ(BKK)</option>
                                <option value="CNX">เชียงใหม่(CNX)</option>
                                <option value="HKT">ภูเก็ต(HKT)</option>
                                <option value="UTH">อุดรธานี(UTH)</option>
                                <option value="HDY">หาดใหญ่(HDY)</option>
                                <option value="KBV">กระบี่(KBV)</option>
                                <option value="BTZ">ยะลา(BTZ)</option>
                                <option value="CEI">เชียงราย(CEI)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bottomcontent">
                    <button class="button-search">ค้นหาเที่ยวบิน </button>
                </div>
            </div>

            <script>
                document.querySelector('.button-search').addEventListener('click', function() {
                const departureValue = document.getElementById('departure').value;
                const arrivalValue = document.getElementById('arrival').value;
                window.location.href = `../FLIGHT/flight.php?departure=${departureValue}&arrival=${arrivalValue}`;
            });
            </script>


            <div class="rightcontent">
                <div class="righttopcotent">
                    <div class="righttop1">
                        <p>จำนวนผู้โดยสาร</p>
                        <select class="dropdownselect_people">
                            <option value="" disabled selected>จำนวนผู้โดยสาร</option>
                            <option value="one">1</option>
                            <option value="two">2</option>
                            <option value="three">3</option>
                            <option value="four">4</option>
                            <option value="five">5</option>
                            <option value="six">6</option>
                        </select>
                    </div>
                </div>
                <div class="rightbottomcontent">
                    <div class="rightbottom1">
                        <p>ชั้นผู้โดยสาร</p>
                        <select class="dropdownselect_class">
                            <option value="" disabled selected>เลือกชั้นโดยสาร</option>
                            <option value="economy">ชั้นประหยัด (Economy Class)</option>
                            <option value="business">ชั้นธุรกิจ (Business Class)</option>
                            <option value="first">ชั้นหนึ่ง (First Class)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <!-- ส่วนของแนะนำสถานที่ท่องเที่ยว -->

        <div class="recommendlock">
            <div class="header-recomment">
                <div>
                    <h1>แนะนำสถานที่ท่องเที่ยว</h1>
                    <p>เลือกสถานที่และการเดินทาง</p>
                </div>
                <a href="../RECCOMMEND/reccom.php">
                    <button>เพิ่มเติม</button>
                </a>
            </div>
            <div class="have2go-content">
                <div class="placerow1">
                    <div class="place1">
                        <div><img src="./img/patong.png" alt=""></div>
                        <div class="placetext">
                            <p>หาดป่าตอง</p>
                            <p>ป่าตอง | ภูเก็ต | ประเทศไทย</p>
                        </div>
                    </div>
                    <div class="place2">
                        <div><img src="./img/mud.png" alt=""></div>
                        <div class="placetext">
                            <p>มัสยิดกลางสงขลา</p>
                            <p>คลองแห | สงขลา | ประเทศไทย</p>
                        </div>
                    </div>
                    <div class="place3">
                        <div><img src="./img/ifpare.png" alt=""></div>
                        <div class="placetext">
                            <p>ถนนคนเดินท่าแพ</p>
                            <p>ศรีภูมิ | เชียงใหม่ | ประเทศไทย</p>
                        </div>
                    </div>
                </div>
                <div class="placerow2">
                    <div class="place4">
                        <div><img src="./img/sky.png" alt=""></div>
                        <div class="placetext">
                            <p>มหานคร สกายวอล์ค</p>
                            <p>บางรัก| กรุงเทพฯ | ประเทศไทย</p>
                        </div>
                    </div>
                    <div class="place5">
                        <div><img src="./img/temple.png" alt=""></div>
                        <div class="placetext">
                            <p>วัดป่าภูก้อน</p>
                            <p>บ้านก้อง | อุดรธานี | ประเทศไทย</p>
                        </div>
                    </div>
                    <div class="place6">
                        <div><img src="./img/iconsiam.png" alt=""></div>
                        <div class="placetext">
                            <p>ไอคอนสยาม</p>
                            <p>คลองสาน | กรุงเทพฯ | ประเทศไทย</p>
                        </div>
                    </div>
                </div>
                <div class="placerow3">
                    <div class="place7">
                        <div><img src="./img/he.png" alt=""></div>
                        <div class="placetext">
                            <p>ทะเลหมอกฆูนุงซีลีปัต</p>
                            <p>อัยเยอร์เวง | ยะลา| ประเทศไทย</p>
                        </div>
                    </div>
                    <div class="place8">
                        <div><img src="./img/sirikit.png" alt=""></div>
                        <div class="placetext">
                            <p>สวนพฤกษศาสตร์พระนางเจ้าสิริกิติ์</p>
                            <p>แม่ริม | เชียงใหม่ | ประเทศไทย</p>
                        </div>
                    </div>
                    <div class="place9">
                        <div><img src="./img/pp.png" alt=""></div>
                        <div class="placetext">
                            <p>เกาะพีพี</p>
                            <p>หมู่เกาะ | ภูเก็ต | ประเทศไทย</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ส่วนดีลเที่ยวบินไป-กลับยอดนิยม -->

        <div class="deallock">
            <div class="header-deal">
                <h1>ดีลเที่ยวบินไป-กลับยอดนิยม</h1>
                <img src="./img/startag.png" alt="">
            </div>
            <div class="deal-content">
                <div class="placemost1">
                    <img src="./img/chiangnew.png" alt="">
                </div>
                <div class="placemost2">
                    <img src="./img/chiangnew.png" alt="">
                </div>
                <div class="placemost3">
                    <img src="./img/chiangnew.png" alt="">
                </div>
            </div>
        </div>

        <div class="whylock">
            <div class="header-why">
                <h1>ทำไมถึงต้องเดินทางกับ I Landed Airline</h1>
            </div>
            <div class="why-content">
                <div class="why-content1">
                    <img src="./img/travel1.png" alt="">
                    <h3>ผลิตภัณฑ์ท่องเที่ยวที่มีให้เลือกมากมาย</h3>
                    <p>เพลิดเพลินไปกับช่วงเวลาที่น่าจดจำของคุณด้วย</p>
                    <p>เที่ยวบินและที่พักที่น่าพอใจนับล้าน</p>
                </div>
                <div class="why-content2">
                    <img src="./img/travel2.png" alt="">
                    <h3>ผลิตภัณฑ์ท่องเที่ยวที่มีให้เลือกมากมาย</h3>
                    <p>เพลิดเพลินไปกับช่วงเวลาที่น่าจดจำของคุณด้วย</p>
                    <p>เที่ยวบินและที่พักที่น่าพอใจนับล้าน</p>
                </div>
                <div class="why-content3">
                    <img src="./img/travel3.png" alt="">
                    <h3>ผลิตภัณฑ์ท่องเที่ยวที่มีให้เลือกมากมาย</h3>
                    <p>เพลิดเพลินไปกับช่วงเวลาที่น่าจดจำของคุณด้วย</p>
                    <p>เที่ยวบินและที่พักที่น่าพอใจนับล้าน</p>
                </div>
                <div class="why-content4">
                    <img src="./img/travel4.png" alt="">
                    <h3>ผลิตภัณฑ์ท่องเที่ยวที่มีให้เลือกมากมาย</h3>
                    <p>เพลิดเพลินไปกับช่วงเวลาที่น่าจดจำของคุณด้วย</p>
                    <p>เที่ยวบินและที่พักที่น่าพอใจนับล้าน</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="footer-content1">
                <h2>I-LANDED AIRLINE</h2>
                <a href="../HOMEPAGE/homepage.php"><p>หน้าแรก</p></a>
                <a href="../RECCOMMEND/reccom.php"><p>แนะนำสถานที่</p></a>
                <a href="../HELP/help.php"><p>ช่วยเหลือ</p></a>
            </div>
            <div class="footer-content2">
                <h2>ACCOUNT</h2>
                <a href="../SIGNUPLOGIN/register.php"><p>ลงทะเบียน</p></a>
                <a href="../SIGNUPLOGIN/login.php"><p>เข้าสู่ระบบ</p></a>
            </div>
            <div class="footer-content4">
                <img src="./img/logo_airline_footer.png" alt="">
            </div>
        </div>
    </footer>



</body>



</html>