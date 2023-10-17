<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    try {
        $airports = array();
        $stmt = $conn->prepare("SELECT * FROM airport where airport_id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row) {
            $airports = array(
                'airport_id' => $row['airport_id'],
                'airport_name' => $row['airport_name'],
                'airport_address' => $row['airport_address']
            );
            echo json_encode($airports);
            break;
        }
        $conn = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>