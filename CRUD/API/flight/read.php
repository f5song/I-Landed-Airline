<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    try {
        $flights = array();
        foreach($conn->query('SELECT * FROM flight') as $row){
            array_push($flights, array(
                'flight_id' => $row['flight_id'],
                'departure_airport' => $row['departure_airport'],
                'arrival_airport' => $row['arrival_airport'],
                'travel_date' => $row['travel_date'],
                'departure_time' => $row['departure_time'],
                'arrival_time' => $row['arrival_time'],
                'flight_cost' => $row['flight_cost'],
                'aircraft_id' => $row['aircraft_id'],
                'available_seats' => $row['available_seats'],
            ));
        }
        echo json_encode($flights);
        $conn = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>