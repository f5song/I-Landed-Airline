
<!-- http://localhost/ISAD-ilal/PAGE/SIGNUPLOGIN/register.php -->


<?php
  session_start();
  require_once '../../CRUD/config/db.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />

  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap" />

</head>

<body>
  <div class="backgroundlock">
    <div class="left">
      <img class="img1" src="./img/cloud1.svg" alt="">
      <img src="./img/logo_airline.png" alt="">
      <img class="img2" src="./img/cloud2.svg" alt="">
    </div>
    <div class="right">
      <form class="form" id="register-form" action="register_db.php" method="POST">
        
        <p class="title">สมัครสมาชิก/สร้างบัญชี</p>
        <p class="message">จัดการการจองง่ายดาย พร้อมรับสิทธิประโยชน์เฉพาะสมาชิก</p>

        <label>
          <input required placeholder="" type="email" class="input" name="email">
          <span>Email</span>
        </label>

        <label>
          <input required placeholder="" type="password" class="input" name="password">
          <span>Password</span>
        </label>
        <label>
          <input required placeholder="" type="password" class="input" name="c_password">
          <span>Confirm password</span>
        </label>
        <button class="submit" name="signup">ลงทะเบียน</button>
        <p class="signin">มีบัญชีอยู่แล้วใช่หรือไม่? <a href="login.php">เข้าสู่ระบบ</a> </p>

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
</body>

</html>