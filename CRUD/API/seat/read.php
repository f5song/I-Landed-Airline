<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    try {
        $seats = array();
        foreach($conn->query('SELECT * FROM seats') as $row){
            array_push($seats, array(
                'seat_number' => $row['seat_number'],
                'flight_id' => $row['flight_id'],
                'seat_status' => $row['seat_status'],
                'class' => $row['class'],
                'aircraft_id' => $row['aircraft_id'],
                'seat_price' => $row['seat_price'],
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

