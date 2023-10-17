


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
  </head>
  <body>
    <div class="real-sign-up-page">
      <img
        class="real-sign-up-page-child"
        alt=""
        src="./public/ellipse-3.svg"
      />
      <img class="real-sign-up-page-item" alt="" src="./public/group-4.svg" />
      <img class="logo-3-icon" alt="" src="./public/4137363-logo-3@2x.png" />
      <div class="frame-div">
        <form id="register-form" action="register_db.php" method="POST">


        <!-- http://localhost/ISAD-ilal/PAGE/SIGNUPLOGIN//register.php -->
          
          <!-- P -->
          <!-- H -->
          <!-- P -->
          
          <?php if(isset($_SESSION['error'])) { ?>
            <div class="alert-danger" role="alert">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert-success" role="alert">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>

        <?php if(isset($_SESSION['warning'])) { ?>
            <div class="alert-warning" role="alert">
                <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                ?>
            </div>
        <?php } ?>

        <!-- component -->
          <div class="div">สมัครสมาชิก/สร้างบัญชี</div>
          <div class="div1">
            จัดการการจองง่ายดาย พร้อมรับสิทธิประโยชน์เฉพาะสมาชิก
          </div>
          <div class="form-group">
            <label for="usernameEmail">Email</label>
            <input type="text" id="usernameEmail" name="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="c_password" required>
          </div>
          <div class="submit-form">
            <button type="submit" id="submitbutton" name="signup" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap">ลงทะเบียน</button>
          </div>
        </form>
    </div>


    <!-- หาลิ้งค์ด้วยอีควาย ไปหน้า HOME ตรงbutton  -->


  </body>
</html>
