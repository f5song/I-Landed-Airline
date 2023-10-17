<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset=utf-8");
    include '../db.php';
    try {
        $users = array();
        foreach($dbh->query('SELECT * FROM user') as $row){
            array_push($users, array(
                'user_id' => $row['user_id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email']
            ));
        }
        echo json_encode($users);
        $dbh = null;
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>