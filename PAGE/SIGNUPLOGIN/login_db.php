<?php

    session_start();
    require_once '../../CRUD/config/db.php';

    if(isset($_POST['signin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $_SESSION['error'] = "กรุณากรอกอีเมลล์";
            header("location: login.php");
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "รูปแบบอีเมลล์ไม่ถูกต้อง";
            header("location: login.php");
        } else if(empty($password)){
            $_SESSION['error'] = "กรุณากรอกรัสผ่าน";
            header("location: login.php");
        } else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
            $_SESSION['error'] = "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร";
            header("location: login.php");
        } else {
            try{
                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0){

                    if($email == $row['email']){
                        if($password == $row['password']){
                            if($row['userrole']=='admin'){
                                $_SESSION['admin_login'] = $row['user_id'];
                                // ลิ้งค์หน้า admin จะใช้หน้าของฉันก็ได้ หรือจะดึงมาก็ได้
                                header("location: ../../CRUD/Admin/adminpage.php");
                            } else{
                                $_SESSION['user_login'] = $row['user_id'];
                                // ลิ้งค์หน้า homepage
                                if (isset($_SESSION['redirect_url'])) {
                                    header('Location: ' . $_SESSION['redirect_url']);
                                    exit;
                                }
                                header("location: ../HOMEPAGE/homepage.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: login.php");
                        }
                    }else{
                        $_SESSION['error'] = 'อีเมลล์ผิด';
                        header("location: login.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่พบข้อมูลอีเมลล์ในระบบ";
                    header("location: login.php");
                }
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }

    }
?>