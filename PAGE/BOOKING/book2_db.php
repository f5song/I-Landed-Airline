
<?php

    session_start();
    require_once '../../CRUD/config/db.php';
    

    if(isset($_POST['test'])){

        $user_id = $_SESSION['user_login'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $phone_number = $_POST['phone_number'];
        $id_card = $_POST['id_card'];
        $title = $_POST['title'];

        if(empty($firstname)){
            $_SESSION['error'] = "กรุณากรอกชื่อ";
            header("location: book2.php");
        } else if(empty($lastname)){
            $_SESSION['error'] = "กรุณากรอกนามสกุล";
            header("location: book2.php");
        } else if(empty($dob)){
            $_SESSION['error'] = "กรุณาใส่วันเกิด";
            header("location: book2.php");
        }else if(empty($phone_number)){
            $_SESSION['error'] = "กรุณากรอกเบอร์โทรศัพท์";
            header("location: book2.php");
        }else if(empty($id_card)){
            $_SESSION['error'] = "กรุณากรอกบัตรประชาชน";
            header("location: book2.php");
        }else if(empty($title)){
            $_SESSION['error'] = "กรุณาเลือกคำนำหน้า";
            header("location: book2.php");
        }else {
            try{
                if (!isset($_SESSION['error'])){
                    $stmt = $conn->prepare(
                    "UPDATE users
                    set firstname=:firstname, lastname=:lastname, dob=:dob, phone_number=:phone_number, id_card=:id_card, title=:title
                    WHERE id=:user_id");

                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":dob", $dob);
                    $stmt->bindParam(":phone_number", $phone_number);
                    $stmt->bindParam(":id_card", $id_card);
                    $stmt->bindParam(":title", $title);
                    $stmt->bindParam(":user_id", $user_id);
                    
                    $stmt->execute();
                    $_SESSION['success'] = "";
                    header("location: ../baggage/baggage.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: book2.php");
                }
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        

    }
?>
