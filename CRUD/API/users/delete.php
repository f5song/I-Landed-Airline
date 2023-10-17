<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../db.php';
    $data = json_decode(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
        echo json_encode(array("status" => "error"));
        die();
    }

    try {
        $stmt = $dbh->prepare("DELETE FROM user WHERE user_id=?");
        $stmt->bindParam(1, $data->user_id);

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