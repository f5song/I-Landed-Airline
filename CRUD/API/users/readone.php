<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../db.php';
    try {
        $users = array();
        $stmt = $dbh->prepare("SELECT * FROM user where user_id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row) {
            $user = array(
                'user_id' => $row['user_id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number']
            );
            echo json_encode($user);
            break;
        }
        $dbh = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>