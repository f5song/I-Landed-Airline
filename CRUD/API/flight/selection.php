<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';

    try {
        $flight_ids = array();
        $stmt = $conn->prepare("SELECT DISTINCT flight_id FROM flight");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $flight_ids[] = $row['flight_id'];
        }

        echo json_encode($flight_ids);

        $conn = null;
    }
    catch (PDOException $e) {
        echo json_encode(array("error" => "Failed to fetch flight IDs. Error: " . $e->getMessage()));
        die();
    }
?>
