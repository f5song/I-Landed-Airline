<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    $data = json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] !== 'PATCH'){
        echo json_encode(array("status" => "error"));
        die();
    }

    try {
        $stmt = $conn->prepare("UPDATE flight SET departure_airport=?, arrival_airport=?, travel_date=?, departure_time=?, arrival_date=?,
        arrival_time=?, economy_class_price=?, business_class_price=?, first_class_price=? WHERE flight_id=?");
        $stmt->bindParam(1, $data->departure_airport);
        $stmt->bindParam(2, $data->arrival_airport);
        $stmt->bindParam(3, $data->travel_date);
        $stmt->bindParam(4, $data->departure_time);
        $stmt->bindParam(5, $data->arrival_date);
        $stmt->bindParam(6, $data->arrival_time);
        $stmt->bindParam(7, $data->economy_class_price);
        $stmt->bindParam(8, $data->business_class_price);
        $stmt->bindParam(9, $data->first_class_price);
        $stmt->bindParam(10, $data->flight_id);

        if($stmt->execute()){
            echo json_encode(array("status" => "complete"));
        }else{
            echo json_encode(array("status" => "error"));
        }
        $conn = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>