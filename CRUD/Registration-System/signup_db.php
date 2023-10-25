<?php

    session_start();
    require_once '../config/db.php';

    if(isset($_POST['signup'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $userrole = 'admin';

        if(empty($email)){
            $_SESSION['error'] = "กรุณากรอกอีเมลล์";
            header("location: Register.php");
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "รูปแบบอีเมลล์ไม่ถูกต้อง";
            header("location: Register.php");
        } else if(empty($password)){
            $_SESSION['error'] = "กรุณากรอกรัสผ่าน";
            header("location: Register.php");
        } else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
            $_SESSION['error'] = "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร";
            header("location: Register.php");
        } else if(empty($c_password) || ($password != $c_password)){
            $_SESSION['error'] = "กรุณายืนยันรหัสผ่านที่ตรงกัน";
            header("location: Register.php");
        } else {
            try{
                $check_email = $conn->prepare("SELECT email FROM admin WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email']==$email){
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: Register.php");
                } else if (!isset($_SESSION['error'])){
                    $stmt = $conn->prepare("INSERT INTO admin (email, password, userrole) 
                    VALUES (:email, :password, :userrole)");
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":userrole", $userrole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a>เพื่อเข้าสู่ระบบ";
                    header("location: Register.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: Register.php");
                }
                
                

            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }

    }
?>