

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./help-page.css" />
    <link rel="stylesheet" href="../navbar/index.css" />
  <link rel="stylesheet" href="../navbar_login/index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap"
    />
  </head>
  <body>


    <!-- help-page -->
    <div class="help-page">
      <div class="text-popular- uestion">หัวข้อยอดนิยม</div>
      <div class="bg-banner">
        <div class="frame-for-banner"></div>
        <img
          class="img-magnifying-glass"
          alt=""
          src="./public/magnifying-glass.png"
        />

        <img
          class="img-person1-icon"
          alt=""
          src="./public/person1.png"
        />

        <img
          class="img-person2-icon"
          alt=""
          src="./public/person2.png"
        />

        <img class="img-folder-icon" alt="" src="./public/folder.png">
      </div>
      <div class="how-can-we-help">
        <div class="text-how-can">เราจะช่วยคุณได้อย่างไร?</div>
      </div>
      <div class="group-q5">
        <div class="animateion-q5">
          <div class="text-question5">ฉันจะได้รับตั๋วของฉันได้อย่างไร</div>
          <img class="icon-plus" onclick="hideshow5()" alt="" src="./public/icon-plus.svg" />
        </div>
        <div id="text-q5" class="text-q5" style="display: none">
          <p class="p">
          เว็บ I_LANDED AIRLINE ของเราจะออกตั๋วอิเล็กทรอนิกส์ให้คุณหลังจากที่คุณทำการชำระเงินเรียบร้อยแล้ว
            ตั๋วอิเล็กทรอนิกส์นี้คุณสามารถนำไปยื่นหน้าเคาท์เตอร์ที่สนามบินเพื่อขอรับบอร์ดดิ้งพาสของคุณได้
          </p>
        </div>
      </div>
      <div class="group-q4">
        <div class="animateion-q4">
          <div class="text-question4">จะตรวจสอบสถานะการคืนเงินได้อย่างไร</div>
          <img class="icon-plus" onclick="hideshow4()" alt="" src="./public/icon-plus.svg" />
        </div>
        <div id="text-q4" class="text-q4" style="display: none"">
          <p class="p">
            หากต้องการตรวจสอบสถานะการคืนเงิน คุณสามารถไปที่ 'คำสั่งซื้อ' เมนู
          </p>
          <p class="p">
            จากนั้น กรอกรหัสและอีเมลที่คุณลงทะเบียนหากคุณขอเงินคืน
            สถานะจะแสดงที่นั่นหากคุณเคยลงทะเบียนและมีบัญชีมาก่อน
            โปรดลงชื่อเข้าใช้บัญชีของคุณก่อนไปที่ 'คำสั่งซื้อ' เมนู
          </p>
        </div>
      </div>
      <div class="group-q3">
        <div class="animateion-q3">
          <div class="text-question3">ฉันจะจองที่นั่งได้อย่างไร?</div>
          <img class="icon-plus" onclick="hideshow3()" alt="" src="./public/icon-plus.svg" />
        </div>
        <div id="text-q3" class="text-q3" style="display: none">
          สำหรับการจองที่นั่งนั้น
          สามารถทำได้ตอนเลือกเที่ยวบินที่คุณต้องการโดยคุณสามารถเลือกคลาสที่นั่งได้ที่หน้าหลัก
          จากนั้นเลือกเที่ยวบินที่ตรงตามวันและเวลาที่คุณอยากไป
        </div>
      </div>
      <div class="group-q2">
        <div class="animateion-q2">
          <div class="text-question2">
            การจองหนึ่งครั้งสามารถมีผู้โดยสารได้กี่คน
          </div>
          <img class="icon-plus" onclick="hideshow2()" alt="" src="./public/icon-plus.svg" />
        </div>
        <div id="text-q2" class="text-q2" style="display: none">
          สามารถจองผู้โดยสารได้สูงสุดหก (6)
          คนในหนึ่งธุรกรรมหากต้องการจองผู้โดยสารตั้งแต่เจ็ด (7)
          คนขึ้นไปคุณต้องทำการจองแยกกันสำหรับผู้โดยสาร 6 คน
        </div>
      </div>
      <div class="group-q1">
        <div class="animation-q1">
          <div class="text-question1">ฉันจะดูราคาตั๋วของฉันได้ที่ไหน?</div>
          <img class="icon-plus"  onclick="hideshow1()" alt="" src="./public/icon-plus.svg" />
        </div>
        <div id="text-q1" class="text-q1" style="display: none">
          สำหรับราคาตั๋วแต่ละเที่ยวบินนั้น
          สามารถดูได้ที่หน้าเที่ยวบินโดยที่หน้าเที่ยวบินนั้นยังบอกรายละเอียดต่างๆที่คุณต้องการทราบอีกด้วย
          เช่น เวลาในการเดินทางและรายละเอียดเพิ่มเติมเกี่ยวกับเที่ยวบิน
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="footer">
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
    </div>


    <script src="scrip.js"></script>
  </body>
</html>
