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
        $stmt = $conn->prepare("UPDATE airport SET airport_name=?, airport_address=? WHERE airport_id=?");
        $stmt->bindParam(1, $data->airport_name);
        $stmt->bindParam(2, $data->airport_address);
        $stmt->bindParam(3, $data->airport_id);

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