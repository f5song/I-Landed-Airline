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
        $stmt = $conn->prepare("UPDATE seat SET flight_id=?, seat_status=?, seat_class=? WHERE seat_id=?");
        $stmt->bindParam(1, $data->flight_id);
        $stmt->bindParam(2, $data->seat_status);
        $stmt->bindParam(3, $data->seat_class);
        $stmt->bindParam(4, $data->seat_id);

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