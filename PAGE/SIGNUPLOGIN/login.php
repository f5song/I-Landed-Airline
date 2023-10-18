
<!-- for go to browser -->

<!-- http://localhost/ISAD-ilal/PAGE/SIGNUPLOGIN/login.php -->


<?php
    session_start();
    require_once '../../CRUD/config/db.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap"
    />
  </head>
  <body>
  
    <div class="real-login-page">
      <img class="real-login-page-child" alt="" src="../SIGNUPLOGIN/public/ellipse-3.svg"/>
      <img class="real-login-page-item" alt="" src="./public/group-4.svg" />
      <img class="logo-3-icon" alt="" src="./public/4137363-logo-3@2x.png" />

        <div class="group-parent">          
          <div class="parent1">
            <div class="div77">เข้าสู่ระบบ</div>
            <div class="div78">จัดการการจองง่ายดาย พร้อมรับสิทธิประโยชน์เฉพาะสมาชิก</div>
          </div>

          <form id="login-form" action="login_db.php" method="POST">


          <!-- P -->
          <!-- H -->
          <!-- P -->

          <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>

            <?php } ?>

            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>

            <?php } ?>

            <div class="form-group1">
              <label for="usernameEmail">Email</label>
              <input type="text" id="usernameEmail" name="email" required>
            </div>
            <div class="form-group1">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
            </div>
            <div class="submit-form1">
              <button class="logintohomepage" type="submit" id="submitbutton1" name="signin">เข้าสู่ระบบ</button>
            </div>
          </form>
          <div class="goto-sing-in">ยังไม่มีบัญชีใช่หรือไม่? <a href="register.php" style="color: #003a6c;">สมัครเลย!</a></div>
        </div>
    </div>

    
    <script>
      var usernameEmailText = document.getElementById("usernameEmailText");
      if (usernameEmailText) {
        usernameEmailText.addEventListener("click", function () {
          var anchor = document.querySelector("[data-scroll-to='rectangle']");
          if (anchor) {
            anchor.scrollIntoView({ block: "start", behavior: "smooth" });
          }
        });
      }
      </script>
  </body>
</html>
