<?php
    session_start();
    require_once '../config/db.php';
    if(!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header('location: ../Registration-System/signin.php');
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Admin Panel</title>
    </head>
    <body onload="flight_read()">
        <div style="padding: 25px;" class="container">
            <div class="row justify-content-between" id="admin">
                <div class="col-sm">
                    <h1>Admin Panel</h1>
                  </div>
                  <div class="col-auto">
                    <a href="flightmanagement.html" class="btn btn-primary">Add Flight list</a>
                    <a href="../Registration-System/logout.php" class="btn btn-danger">Logout</a>
                  </div>
            </div>
            <div style="margin-top: 10px; margin-bottom: 10px;" class="row">
                <div class="col">
                    <label>Filter by Source:</label>
                    <select id="sourceFilter" onchange="flight_read()">
                        <option value="">All</option>
                        <option value="BKK">Suvarnabhumi Airport</option>
                        <option value="CNX">Chiangmai International Airport</option>
                        <option value="HDY">Hat Yai International Airport</option>
                        <option value="HKT">Phuket International Airport</option>
                        <option value="CEI">Chiang Rai International Airport</option>
                        <option value="BTZ">Betong International Airport</option>
                        <option value="KBV">Krabi International Airport</option>
                        <option value="UTH">Udon Thani International Airport</option>
                        <option value="HHQ">Hua Hin Airport</option>
                    </select>
                    <label style="margin-left: 20px;">Filter by Destination:</label>
                    <select id="destinationFilter" onchange="flight_read()">
                        <option value="">All</option>
                        <option value="BKK">Suvarnabhumi Airport</option>
                        <option value="CNX">Chiangmai International Airport</option>
                        <option value="HDY">Hat Yai International Airport</option>
                        <option value="HKT">Phuket International Airport</option>
                        <option value="CEI">Chiang Rai International Airport</option>
                        <option value="BTZ">Betong International Airport</option>
                        <option value="KBV">Krabi International Airport</option>
                        <option value="UTH">Udon Thani International Airport</option>
                        <option value="HHQ">Hua Hin Airport</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 25px;" class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Flight ID</th>
                        <th scope="col">Source</th>
                        <th scope="col">Destination</th>
                        <th scope="col">travel date</th>
                        <th scope="col">Departure time</th>
                        <th scope="col">Landing date</th>
                        <th scope="col">Arrival time</th>
                        <!-- <th scope="col">Economy Price</th>
                        <th scope="col">Business Price</th>
                        <th scope="col">First Class Price</th> -->
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody id="flight_table">
                    </tbody>
                  </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>

<script>
var flight_read = function(){
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    var flight_table = document.getElementById('flight_table');
    var sourceFilter = document.getElementById('sourceFilter').value;
    var destinationFilter = document.getElementById('destinationFilter').value;

    flight_table.innerHTML = "Loading..."
    fetch("../API/flight/read.php", requestOptions)
        .then(response => response.text())
        .then(result => {
            flight_table.innerHTML = "";
            var jsonObj = JSON.parse(result);
            for(let flight of jsonObj){
                if ((sourceFilter === "" || flight.departure_airport === sourceFilter) &&
                    (destinationFilter === "" || flight.arrival_airport === destinationFilter)) {
                    var row = `
                            <tr>
                                <th scope="row">${flight.flight_id}</th>
                                <td>${flight.departure_airport}</td>
                                <td>${flight.arrival_airport}</td>
                                <td>${flight.travel_date}</td>
                                <td>${flight.departure_time}</td>
                                <td>${flight.arrival_date}</td>
                                <td>${flight.arrival_time}</td>
                                <td>
                                    <a class="btn btn-outline-success" href="seat.html?id=${flight.flight_id}">Seat</a>
                                    <a class="btn btn-outline-warning" href="flightedit.html?id=${flight.flight_id}">Edit</a> 
                                    <a class="btn btn-outline-danger" href="#" disabled onclick="flight_delete('${flight.flight_id}')">Delete</a>
                                </td>
                            </tr>
                    `;
                    flight_table.insertAdjacentHTML('beforeend', row);
                }
            }
        })
        .catch(error => console.log('error', error));
}

var flight_delete = function(flight_id){
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({
        "flight_id": flight_id
    })

    var requestOptions = {
        method: 'DELETE',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
    };

fetch("../API/flight/delete.php", requestOptions)
    .then(response => response.text())
    .then(result => {
        
        var jsonObj = JSON.parse(result);
            if (jsonObj.status == 'complete'){
                alert('Delete completed');
                location.reload();
            }
            else{
                alert('Cannot delete flight as seats are associated.');
            }
        })
        .catch(error => console.log('error', error));
    }
</script>
