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
        $stmt = $conn->prepare("UPDATE seats SET seat_status=?, class=?, seat_price=? WHERE seat_number=? AND flight_id=?");
        $stmt->bindValue(1, $data->seat_status);
        $stmt->bindValue(2, $data->class);
        $stmt->bindValue(3, $data->seat_price);
        $stmt->bindValue(4, $data->seat_number);
        $stmt->bindValue(5, $data->flight_id);

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