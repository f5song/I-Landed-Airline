<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include '../../config/db.php';
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
    die();
}

try {
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM flight WHERE flight_id = ?");
    $checkStmt->execute([$data->flight_id]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(array("status" => "error", "message" => "Flight ID already exists."));
        die();
    }

    $stmt = $conn->prepare("INSERT INTO flight (departure_airport, arrival_airport, aircraft_id, departure_time, arrival_time, flight_cost, travel_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindValue(1, $data->departure_airport);
    $stmt->bindValue(2, $data->arrival_airport);
    $stmt->bindValue(3, $data->aircraft_id);
    $stmt->bindValue(4, $data->departure_time);
    $stmt->bindValue(5, $data->arrival_time);
    $stmt->bindValue(6, $data->flight_cost);
    $stmt->bindValue(7, $data->travel_date);

    if($stmt->execute()){
        echo json_encode(array("status" => "complete"));
        echo "<script>alert('Flight data added successfully.');</script>";
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to create flight."));
    }

    $conn = null;
} catch (PDOException $e) {
    $errorInfo = $stmt->errorInfo();
    echo json_encode(array("status" => "error", "message" => "Failed to create flight. Error: " . $errorInfo[2]));
}
?>
