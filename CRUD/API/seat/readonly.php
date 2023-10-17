<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    try {
        $seats = array();
        $stmt = $conn->prepare("SELECT * FROM seat where flight_id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row) {
            array_push($seats, array(
                'seat_id' => $row['seat_id'],
                'flight_id' => $row['flight_id'],
                'seat_status' => $row['seat_status'],
                'seat_class' => $row['seat_class']
            ));
        }
        echo json_encode($seats);
        $conn = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>