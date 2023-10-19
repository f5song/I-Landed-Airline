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
      <form class="form">
        <?php if (isset($_SESSION['error'])) { ?>
          <div class="alert alert-danger" role="alert">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
          </div>

        <?php } ?>

        <?php if (isset($_SESSION['success'])) { ?>
          <div class="alert alert-success" role="alert">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
          </div>

        <?php } ?>

        <?php if (isset($_SESSION['notify'])) { ?>
          <div class="alert alert-warning" role="alert">
            <?php
            echo $_SESSION['notify'];
            unset($_SESSION['notify']);
            ?>
          </div>

        <?php } ?>
        <p class="title">เข้าสู่ระบบ</p>
        <p class="message">จัดการการจองง่ายดาย พร้อมรับสิทธิประโยชน์เฉพาะสมาชิก</p>

        <label>
          <input required placeholder="" type="email" class="input">
          <span>Email</span>
        </label>

        <label>
          <input required placeholder="" type="password" class="input">
          <span>Password</span>
        </label>
        <button class="submit">เข้าสู่ระบบ</button>
        <p class="signin">ยังไม่มีบัญชีใช่หรือไม่? <a href="register.php">สมัครเลย!</a> </p>
      </form>
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