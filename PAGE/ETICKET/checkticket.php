
<!-- http://localhost/ISAD-ilal/PAGE/ETICKET/checkticket.php -->

<!DOCTYPE html>

<html>

<head>
    <link 
    rel="stylesheet" 
    href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap"
    />

    <link 
    rel="stylesheet" 
    href="checkticket.css"
    />

    <link 
    rel="stylesheet" 
    href="../BOOKING/b_insert_info.css"
    />

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
                <button class="button-sign-up" type="button"> ลงทะเบียน </button>
            </div>
        </nav>

    <?php } ?>

    
    <div class="paid-box">

        <div class="left-box">
            <div class="box">
                <p> ชำระเงินเสร็จสิ้น </p>
                <div class="blue-blox">
                    <text-e-ticket> E-Ticket/ตั๋วอิเล็กทรอนิกส์ </text-e-ticket>
                </div>
                <div class="white-box">
                        <img src="./checkticketpics/logo_airline.png" alt="logo" class="logo_airline">
    
                        <div style="padding-top: 30px;">
                            <p class="reserv-id"> 
                                รหัสการจอง
                            </p>
                            <p class="reserv-info"> 
                                **ใส่ด้วย** 
                            </p>
                        </div>
                </div>
                <div>
                    <div class="between-line">
                        <div style="width: 100%; height: 1px; background: #C2BFBF;"></div>
                    </div>
                </div>
                <div class="important-info">
                    <div class="aircraft-id">
                        <div>       
                            <p style="font-size: large; color: #7a7a7a;"> 
                                i landed airline 
                            </p>
                            <p style="font-size: large;">
                                **aircraft-id**
                            </p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="dpt-arv">     
                        <div class="dpt-box">
                            <p class="dpt-time"> 
                                **00:00** 
                            </p>
                            <p class="dpt-airport"> 
                                **BKK** 
                            </p>
                        </div>
                        <div class="dpt-arv-line">
                            <svg class="blank-circle" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M11.2144 6C11.2144 9.06965 8.89506 11.5 6.1033 11.5C3.31154 11.5 0.992188 9.06965 0.992188 6C0.992188 2.93035 3.31154 0.5 6.1033 0.5C8.89506 0.5 11.2144 2.93035 11.2144 6Z" stroke="#A2A2A2"/>
                            </svg>
    
                            <div class="between-line">
                                <div style="width: 57.046px; height: 1px; background: #C2BFBF;"></div>
                            </div>
    
                            <svg class="fill-circle" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
                                <ellipse cx="6.43679" cy="6" rx="5.61111" ry="6" fill="#868686"/>
                            </svg>
                        </div>
    
                        <div class="arv-box">
                            <p class="arv-time">
                                **11:11** 
                            </p>
                            <p class="arv-airport">
                                **CNX**
                            </p>
                        </div>
                    </div>
    
                    <div class="top-right" style="padding-bottom: 20px;">   
                        <p  style="font-size: large;"> วันที่ออกเดินทาง </p>
                        <p  style="font-size: small;"> **datetime** </p>
                    </div> 
                </div>
    
                <table-box>
                    <div class="text-ticket-info-box">
                        <table-head> ข้อมูล </table-head>
                    </div>
    
                    <table>
                        <tr>
                            <th>ชื่อผู้โดยสาร?</th>
                            <th>ที่นั่ง?</th>
                            <th>กระเป๋า?</th>
                            <th>บลาๆๆ</th>
                        </tr>
                        <tr>
                            <td>Alfreds Futterkiste</td>
                            <td>Maria Anders</td>
                            <td>Germany</td>
                            <th>บลาๆๆ</th>
                        </tr>
                        <tr>
                            <td>Centro comercial Moctezuma</td>
                            <td>Francisco Chang</td>
                            <td>Mexico</td>
                            <th>บลาๆๆ</th>
                        </tr>
                        <tr>
                            <td>Ernst Handel</td>
                            <td>Roland Mendel</td>
                            <td>Austria</td>
                            <th>บลาๆๆ</th>
                        </tr>
                        <tr>
                            <td>Island Trading</td>
                            <td>Helen Bennett</td>
                            <td>UK</td>
                            <th>บลาๆๆ</th>
                        </tr>
                        <tr>
                            <td>Laughing Bacchus Winecellars</td>
                            <td>Yoshi Tannamuri</td>
                            <td>Canada</td>
                            <th>บลาๆๆ</th>
                        </tr>
                        <tr>
                            <td>Magazzini Alimentari Riuniti</td>
                            <td>Giovanni Rovelli</td>
                            <td>Italy</td>
                            <th>บลาๆๆ</th>
                        </tr>
                    </table>
                </table-box>
            </div>  
        </div>


        <div class="right-box">
            <div class="contact-info-box">
                <div class="content-airplane">
                    
                    <div class="booking-number">
                        <pgrey>หมายเลขการจอง</pgrey>
                        <pblack>**ควยหีแตดใส่ด้วยควยๆๆๆ**</pblack>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" width="439" height="2" viewBox="0 0 439 2" fill="none">
                        <path d="M0 1H439" stroke="#A8A4A4"/>
                    </svg>

                    <div class="travelinfo">
                        <pgrey>การเดินทางของคุณ</p>

                            <div class="flight-in-travelinfo">
                                <pblack>เที่ยวบิน</pblack>
                                <pgrey style="font-size: 15px;">**22 กย 17800**</pgrey>
                            </div>

                        <div class="fromto">
                            <pblack>จาก</pblack>
                            <pgrey >กรุงเทพ(bkk)</pgrey>
                            <pblack>ไปถึง</pblack>
                            <pgrey>เชียงใหม่(cnx)</pgrey>
                        </div>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" width="439" height="2" viewBox="0 0 439 2" fill="none">
                        <path d="M0 1H439" stroke="#A8A4A4"/>
                    </svg>
                
                    <div class="passenger">
                        <pgrey>ชื่อผู้จอง</pgrey>
                        <pname>**ควยหีแตดใส่ด้วยควยๆๆๆ**</pname>
                    </div>
                </div>
            </div>
            
        </div>
        

    </div>

    <div class="bottom-frame">
        <div class="backtohomeframe" id="backtohome">
            <p class="backtohome" id="backtohome"> กลับหน้าหลัก</p>
        </div>
    </div>




    <script>
    var backtohome = document.getElementById("backtohome");

    if (backtohome) {
      backtohome.addEventListener("click", function (e) {
        window.location.href = "../HOMEPAGE/homepage.php";
      });
    }
  </script>



</body>

</html>







