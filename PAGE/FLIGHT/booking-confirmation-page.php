<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./flight.css" />
    <link rel="stylesheet" href="./navbar.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@400;500;600&display=swap"
    />
</head>
<body>
    <div id="bookingConfirmationPage1" class="popup-overlay">
        <div class="booking-confirmation-page1">
          <div class="bar">
            <div class="frame-for-bar"></div>
            <img id="closeButton" class="buttob-click-out" alt="" src="./public_flight/buttob-click-out.svg"/>
  
            <div class="text-your-travel">การเดินทางของคุณ</div>
          </div>
          <div class="frame-for-choose-ticket"></div>
          <div class="continue-order">
            <div class="frame-for-continue-order"></div>
            <div class="text-price">THB 1000</div>
            <img class="vector-up-icon" alt="" src="./public_flight/vector-up.svg" />
  
            <div class="text-total-for">รวม สำหรับ 1 คน</div>
            <div class="button-continue-order" id="next-button">
              <div class="text-continue-order">ทำการจองต่อ</div>
            </div>
          </div>
  
          <!-- // first-class // -->
  
          <div class="first-class" id="first-class">
            <div class="frame-for-fisrt-class"></div>
            <img class="img-seat-icon" alt="" src="./public_flight/img-seat@2x.png" />
  
            <div class="text-first-class">ชั้นหนึ่ง</div>
            <div class="text-price-oer">THB 1000.00 /คน</div>
            <div class="text-desrip-refund">คืนเงินได้ 80% จากราคาตั๋วเดิม</div>
            <img
              class="img-refund-icon"
              alt=""
              src="./public_flight/img-refund@2x.png"
            />
          </div>
  
          <!-- // business-class // -->
  
          <div class="business-class" id="business-class">
            <div class="frame-for-fisrt-class"></div>
            <img class="img-seat-icon" alt="" src="./public_flight/img-seat@2x.png" />
  
            <div class="text-business-class">ชั้นธุรกิจ</div>
            <div class="text-price-oer">THB 1000.00 /คน</div>
            <div class="text-descrip-refund">คืนเงินได้ 50% จากราคาตั๋วเดิม</div>
            <img
              class="img-refund-icon"
              alt=""
              src="./public_flight/img-refund@2x.png"
            />
          </div>
  
  
          <!-- // economy class // -->
  
          <div class="economy-class" id="economy-class">
            <div class="frame-for-fisrt-class"></div>
            <img class="img-seat-icon" alt="" src="./public_flight/img-seat@2x.png" />
  
            <div class="text-economy-class">ชั้นประหยัด</div>
            <div class="text-price-oer">THB 1000.00 /คน</div>
            <img
              class="img-refund-icon2"
              alt=""
              src="./public_flight/img-refund@2x.png"
            />
          </div>
  
  
          <div class="div">เลือกประเภทตั๋วของคุณ</div>
          <div class="ticket-11">
            <div class="bg-for-ticket"></div>
            <div class="text-time-departure-and-arriva">
              <div class="text-time-departure-container10">
                <span class="text-time-departure-container11">
            <!-- departure time -->
              <?php
                $stmt = $conn->prepare("SELECT DATE_FORMAT(departure_time, '%H:%i') AS formatted_departure_time FROM flight WHERE flight_id = 'FOLK69'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);       
              ?>
                <p class="p10"> <?php echo $row['formatted_departure_time'] . " "?> </p>
            <!-- departure id airport -->
              <?php
                $stmt = $conn->prepare("SELECT departure_airport FROM flight WHERE flight_id = 'FOLK69'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);            
              ?>
                  <p class="bkk5"><?php echo $row['departure_airport'] . " "?></p>
                </span>
              </div>


              <div class="text-time-arrival-container10">
                <span class="text-time-departure-container11">
              <!-- arrival time -->
                <?php
                  $stmt = $conn->prepare("SELECT DATE_FORMAT(arrival_time, '%H:%i') AS formatted_arrival_time FROM flight WHERE flight_id = 'FOLK69'");
                  $stmt->execute();
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);            
                ?>
                  <p class="p10"> <?php echo $row['formatted_arrival_time'] . " "?> </p>

              <!-- arrival airport -->
              <?php
                  $stmt = $conn->prepare("SELECT arrival_airport FROM flight WHERE flight_id = '568SRC'");
                  $stmt->execute();
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);            
                ?>  
              <p class="bkk5"> <?php echo $row['arrival_airport'] . " "?> </p>
                </span>


              </div>
              <div class="to"></div>
              <div class="from"></div>
              <div class="line-btw"></div>
              <div class="text-direct-flight5">บินตรง</div>
              <div class="text-time">1 ชม.</div>
            </div>
            <div class="button-pricelock">
              <div class="text-recomm">Price Lock</div>
            </div>
            <div class="button-recomm">
              <div class="text-recomm">แนะนำ</div>
            </div>
            <div class="logo-and-name5">
              <div class="text-i-landed5">I Landed Airline</div>
              <img
                class="img-logo-icon6"
                alt=""
                src="./public_flight/img-logo1@2x.png"
              />
            </div>
            <div class="line-separator"></div>
            <div class="text-date">Fri, 22 Oct 2023</div>
          </div>
          <div class="from-to">
            <div class="text-from1">กรุงเทพฯ</div>
            <div class="text-to1">เชียงใหม่</div>
            <img
              class="icon-arrow-right"
              alt=""
              src="./public_flight/icon-arrowright.svg"
            />
          </div>
        </div>
      </div>
  
      <!-- <div class="footer">
        <div class="footber-bg"></div>
        <div class="line-bottom-page"></div>
        <img class="logo-3-icon" alt="" src="../homepage/public/4137364-logo-3@2x.png" />
  
        <div class="text-and-button">
          <img
            class="icon-instagram"
            alt=""
            src="../homepage/public/vector.svg"
          />
  
          <img class="icon-envelope" alt="" src="../homepage/public/vector1.svg" />
  
          <b class="text-contact-us">ติดต่อเรา</b>
          <div class="button-ani-sign-up">
            <div class="text-sign-up-container">
              <p class="p">ลงทะเบียน</p>
            </div>
          </div>
          <div class="button-ani-login">
            <div class="text-sign-up-container">เข้าสู่ระบบ</div>
          </div>
          <b class="text-account">ACCOUNT</b>
          <div class="ani-help">
            <div class="p">ช่วยเหลือ</div>
          </div>
          <div class="ani-homepage">
            <div class="text-homepage">
              <p class="p">หน้าแรก</p>
            </div>
          </div>
          <div class="ani-recomm-place">
            <div class="text-recomm-footer">
              <p class="p">แนะนำสถานที่</p>
            </div>
          </div>
          <b class="text-ilanded-airline">I-LANDED AIRLINE</b>
        </div>
      </div> -->

      <script>


        // สร้างตัวแปรสำหรับเก็บ Object ที่กำลังเลือก
        let selectedObject = null;
        
        // เลือกทั้งหมดของ Object และเก็บไว้ในตัวแปร
        const economyClass = document.getElementById("economy-class");
        const businessClass = document.getElementById("business-class");
        const firstClass = document.getElementById("first-class");
        const nextButton = document.getElementById("next-button");
        
        // สร้างฟังก์ชันสำหรับการเปลี่ยนสีของ Object
        function changeColor(element) {
          element.style.backgroundColor = "rgba(1, 148, 243, 0.3)";
        }
        
        // เพิ่มการฟังก์ชันในการคลิก Object แต่ละอัน
        economyClass.addEventListener("click", function() {
          if (selectedObject) {
            selectedObject.style.backgroundColor = "";
          }
          selectedObject = economyClass;
          changeColor(economyClass);
          enableNextButton();
        });
        
        businessClass.addEventListener("click", function() {
          if (selectedObject) {
            selectedObject.style.backgroundColor = "";
          }
          selectedObject = businessClass;
          changeColor(businessClass);
          enableNextButton();
        });
        
        firstClass.addEventListener("click", function() {
          if (selectedObject) {
            selectedObject.style.backgroundColor = "";
          }
          selectedObject = firstClass;
          changeColor(firstClass);
          enableNextButton();
        });
        
        // ฟังก์ชันเพื่อเปิดใช้งานหรือปิดใช้งานปุ่ม "ไปหน้าต่อไป"
        function enableNextButton() {
          if (selectedObject) {
            nextButton.removeAttribute("disabled");
          } else {
            nextButton.setAttribute("disabled", "true");
          }
        }
        
        // กำหนดปุ่ม "ไปหน้าต่อไป" ให้ไม่สามารถคลิกได้ในเริ่มต้น
        nextButton.setAttribute("disabled", "true");
        
        // เมื่อคลิกปุ่ม "ไปหน้าต่อไป" ตรวจสอบว่ามี Object ที่ถูกเลือกแล้วหรือไม่
        nextButton.addEventListener("click", function(event) {
          if (!selectedObject) {
            alert("Please select a class.");
            event.preventDefault(); // หยุดการทำงานของปุ่มถ้ายังไม่ได้เลือก Object
          } else {
            window.location.href = "../book2/book2.php";
          }
        });
          
        
        
        
        
        
        
        
        
        
        
        
        
          const buttobClickOut = document.getElementById("closeButton");
          const popUp = document.getElementById("bookingConfirmationPage1");
          
          buttobClickOut.addEventListener("click", function() {
            window.location.href = "./flight.php";
          });
        
          var buttonContinueOrder = document.getElementById("popupbuttonContinueOrder");
          if (buttonContinueOrder) {
            buttonContinueOrder.addEventListener("click", function (e) {
              window.location.href = "../book2/book2.php";
            });
          }
          </script>
</body>
</html>