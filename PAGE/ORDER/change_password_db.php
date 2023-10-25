<?php
    session_start();
    require_once '../../CRUD/config/db.php';

    if(isset($_POST['signup'])){
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $userrole = 'user';
        $user_id = $_SESSION['user_login'];

        // สามารถแก้ html ใน session ได้เลย
        if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
            $_SESSION['error'] = "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร";
            header("location: order.php");
        } else if(empty($c_password) || ($password != $c_password)){
            $_SESSION['error'] = "กรุณายืนยันรหัสผ่านที่ตรงกัน";
            header("location: order.php");
        } else {
            try{

                if (!isset($_SESSION['error'])){
                    $stmt = $conn->prepare("UPDATE users SET password = :password WHERE user_id = :user_id");
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":user_id", $user_id);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='login.php' class='alert-link'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: order.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header('location: order.php');
                }
                
                

            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }

    }
?>