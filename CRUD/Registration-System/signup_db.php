<?php

    session_start();
    require_once '../config/db.php';

    if(isset($_POST['signup'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $userrole = 'user';

        if(empty($firstname)){
            $_SESSION['error'] = "กรุณากรอกชื่อ";
            header("location: Register.php");
        } else if(empty($lastname)){
            $_SESSION['error'] = "กรุณากรอกนามสกุล";
            header("location: Register.php");
        } else if(empty($email)){
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
                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email']==$email){
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: Register.php");
                } else if (!isset($_SESSION['error'])){
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, userrole) 
                    VALUES (:firstname, :lastname, :email, :password, :userrole)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
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