<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../db.php';
    $data = json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] !== 'PATCH'){
        echo json_encode(array("status" => "error"));
        die();
    }

    try {
        $stmt = $dbh->prepare("UPDATE user SET first_name=?, last_name=?, email=?, password=? WHERE user_id=?");
        $stmt->bindParam(1, $data->first_name);
        $stmt->bindParam(2, $data->last_name);
        $stmt->bindParam(3, $data->email);
        $stmt->bindParam(4, $data->password);
        $stmt->bindParam(5, $data->user_id);

        if($stmt->execute()){
            echo json_encode(array("status" => "complete"));
        }else{
            echo json_encode(array("status" => "error"));
        }
        $dbh = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>