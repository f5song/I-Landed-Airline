<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    $data = json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
        echo json_encode(array("status" => "error"));
        die();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO airport (airport_id, airport_name, airport_address) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $data->airport_id);
        $stmt->bindParam(2, $data->airport_name);
        $stmt->bindParam(3, $data->airport_address);

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