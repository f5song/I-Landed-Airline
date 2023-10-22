<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <style>.seat {
    width: 50px;
    height: 50px;
    margin: 5px;
    background-color: #ccc;
    border: 2px solid #000;
    display: inline-block;
    cursor: pointer;
    position: relative;
}

.seat-name {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.selected {
    background-color: #f00; /* สีแสดงที่นั่งที่ถูกเลือก */
}

.reserved {
    background-color: #999; /* สีแสดงที่นั่งที่ถูกจอง */
}

#seatContainer {
    text-align: center;
}</style>



<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: ' . $_SESSION['redirect_url']);
}

?>
<?php echo $_SESSION['user_login']; ?>
<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
$flight_id = $_GET["flight_id"];
$user_id = $_SESSION['user_login'];


?>

<h1>เลือกที่นั่งบนรถไฟ</h1>

 <!-- ส่วน bar -->


<form action="process_reservation.php?flight_id=<?php echo $flight_id; ?>" method="post">

  <div id="passengerList">
      <h2>ผู้โดยสาร</h2>
          <ul>
              <?php
                $conn = new mysqli("localhost", "root", "", "mydb");

                if ($conn->connect_error) {
                  die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM passengers
                WHERE user_id = $user_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<li>
                        <label>
                          <input type="checkbox" name="selectedPassengers[]" value="' . $row["passenger_id"] . '">
                          ' . $row["first_name"] . ' ' . $row["last_name"] . '
                        </label>
                          </li>';
                  }
                }
                $conn->close();
              ?>
          </ul>

          
            
    </div>
          
    <div id="seatContainer">
              <h2>เลือกที่นั่ง</h2>
              <div class="seat" data-seat="1A">
                  <span class="seat-name">1A</span>
                  <input type="checkbox" name="selectedSeats[]" value="1A">
              </div>
              <div class="seat" data-seat="1B">
                  <span class="seat-name">1B</span>
                  <input type="checkbox" name="selectedSeats[]" value="1B">
              </div>
              <div class="seat" data-seat="1C">
                  <span class="seat-name">1C</span>
                  <input type="checkbox" name="selectedSeats[]" value="1C">
              </div>
    </div>
          
    <p>ที่นั่งที่เลือก: <span id="selectedSeat"></span></p>
    <p>ผู้โดยสารที่เลือก: <span id="selectedPassenger"></span></p>

    <button id="reserveButton" type="submit">จองที่นั่ง</button>

</form>  




    <script>
        var selectedSeats = [];
        var selectedPassengers = [];
        var reservedSeats = {}; // เก็บที่นั่งที่ถูกจองโดยผู้โดยสาร

        function toggleSeat(seat) {
            var seatId = seat.getAttribute("data-seat");
            var isChecked = seat.querySelector('input[type="checkbox"]').checked;
            if (isChecked) {
                selectedSeats.push(seatId);
            } else {
                var index = selectedSeats.indexOf(seatId);
                if (index > -1) {
                    selectedSeats.splice(index, 1);
                }
            }

            document.getElementById("selectedSeat").textContent = selectedSeats.join(", ");
        }

        function selectPassenger(passenger) {
            var passengerName = passenger.querySelector('input[type="checkbox"]').value;
            var isChecked = passenger.querySelector('input[type="checkbox"]').checked;
            if (isChecked) {
                selectedPassengers.push(passengerName);
            } else {
                var index = selectedPassengers.indexOf(passengerName);
                if (index > -1) {
                    selectedPassengers.splice(index, 1);
                }
            }

            document.getElementById("selectedPassenger").textContent = selectedPassengers.join(", ");
        }

        var seats = document.querySelectorAll(".seat");
        seats.forEach(function(seat) {
            seat.querySelector('input[type="checkbox"]').addEventListener("change", function() {
                toggleSeat(seat);
            });
        });

        var passengers = document.querySelectorAll("#passengerList li");
        passengers.forEach(function(passenger) {
            passenger.querySelector('input[type="checkbox"]').addEventListener("change", function() {
                selectPassenger(passenger);
            });
        });
    </script>

    <script>
      document.getElementById("reserveButton").addEventListener("click", function(event) {
    // ตรวจสอบการเลือกที่นั่งและผู้โดยสาร
      if (selectedSeats.length === 0 || selectedPassengers.length === 0) {
          // แจ้งเตือนผู้ใช้ให้เลือกที่นั่งและผู้โดยสาร
          alert("โปรดเลือกที่นั่งและผู้โดยสาร");
          event.preventDefault(); // ยกเลิกการส่งแบบฟอร์ม
      }
});

    </script>


      
</body>
</html>