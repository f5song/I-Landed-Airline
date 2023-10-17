<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    $data = json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(array("status" => "error", "message" => "Invalid request method."));
        die();
    }

    try {
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM flight WHERE flight_id = ?");
        $checkStmt->execute([$data->flight_id]);
        $count = $checkStmt->fetchColumn();

        if($count > 0) {
            echo json_encode(array("status" => "error", "message" => "Flight ID already exists."));
            die();
        }

        $stmt = $conn->prepare("INSERT INTO flight (flight_id, departure_airport, arrival_airport, travel_date, 
        departure_time, arrival_date, arrival_time, economy_class_price, business_class_price, first_class_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $data->flight_id);
        $stmt->bindParam(2, $data->departure_airport);
        $stmt->bindParam(3, $data->arrival_airport);
        $stmt->bindParam(4, $data->travel_date);
        $stmt->bindParam(5, $data->departure_time);
        $stmt->bindParam(6, $data->arrival_date);
        $stmt->bindParam(7, $data->arrival_time);
        $stmt->bindParam(8, $data->economy_class_price);
        $stmt->bindParam(9, $data->business_class_price);
        $stmt->bindParam(10, $data->first_class_price);

        if($stmt->execute()){
            echo json_encode(array("status" => "complete"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Failed to create flight."));
        }

        $conn = null;

    } catch (PDOException $e) {
        echo json_encode(array("status" => "error", "message" => "Error: " . $e->getMessage()));
    }
?>

