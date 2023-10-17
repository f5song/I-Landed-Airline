<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    $data = json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
        echo json_encode(array("status" => "error", "message" => "Invalid request method"));
        die();
    }

    if (!isset($data->flight_id)) {
        echo json_encode(array("status" => "error", "message" => "Flight ID is missing"));
        die();
    }

    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM seat WHERE flight_id = ?");
        $stmt->execute([$data->flight_id]);
        $seatCount = $stmt->fetchColumn();

        if($seatCount > 0) {
            echo json_encode(array("status" => "error", "message" => "Cannot delete flight as seats are associated."));
            die();
        }

        $stmt = $conn->prepare("DELETE FROM flight WHERE flight_id=?");
        $stmt->bindParam(1, $data->flight_id);

        if($stmt->execute()){
            echo json_encode(array("status" => "complete"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Deletion failed"));
        }
        $conn = null;
    }
    catch (PDOException $e) {
        echo json_encode(array("status" => "error", "message" => "Database error: " . $e->getMessage()));
        die();
    }  
?>
