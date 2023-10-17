<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../../config/db.php';
    try {
        $airports = array();
        foreach($conn->query('SELECT * FROM airport') as $row){
            array_push($airports, array(
                'airport_id' => $row['airport_id'],
                'airport_name' => $row['airport_name'],
                'airport_address' => $row['airport_address']
            ));
        }
        echo json_encode($airports);
        $conn = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>