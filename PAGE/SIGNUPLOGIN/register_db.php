<?php

    session_start();
    require_once '../../CRUD/config/db.php';

    if(isset($_POST['signup'])){
        // $firstname = $_POST['firstname'];
        // $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $userrole = 'user';

        // สามารถแก้ html ใน session ได้เลย
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "รูปแบบอีเมลล์ไม่ถูกต้อง";
            header("location: register.php");
        } else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
            $_SESSION['error'] = "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร";
            header("location: register.php");
        } else if(empty($c_password) || ($password != $c_password)){
            $_SESSION['error'] = "กรุณายืนยันรหัสผ่านที่ตรงกัน";
            header("location: register.php");
        } else {
            try{
                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email']==$email){
                    // เปลี่ยน a href = ' ' เวลามีหน้า login
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='login.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ"; 
                    header("location: register.php");
                } else if (!isset($_SESSION['error'])){
                    $stmt = $conn->prepare("INSERT INTO users (email, password, userrole) 
                    VALUES (:email, :password, :userrole)");
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":userrole", $userrole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='login.php' class='alert-link'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: register.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: register.php");
                }
                
                

            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }

    }
?>