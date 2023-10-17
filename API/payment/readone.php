<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../CRUD/config/db.php';
    try {
        $payment = array();
        $stmt = $conn->prepare("SELECT * FROM payment where booking_id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row) {
            $payment = array(
                'booking_id' => $row['booking_id'],
                'user_id' => $row['user_id'],
                'payment_type' => $row['payment_type'],
                'payment_date' => $row['payment_date'],
                'payment_status' => $row['payment_status'],
            );
            echo json_encode($payment);
            break;
        }
        $conn = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>