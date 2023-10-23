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

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="aircraft1.css">
</head>

<body>
    <form class="one-for-all" action="process_reservation.php?flight_id=<?php echo $flight_id; ?>" method="post">
        <div class="passengerList" id="passengerList">
            <div class="box_list">
                <div class="header-passenger">
                    <h2>ผู้โดยสารทั้งหมด</h2>
                </div>
                <div class="content-passenger">
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
            </div>
        </div>

        <div class="seat_plane">
            <div id="seatContainer">
                <h2>เลือกที่นั่ง</h2>
                <div class="seat" data-seat="1A" id="economy">
                    <span class="seat-name">1A</span>
                    <input type="checkbox" name="selectedSeats[]" value="1A">
                </div>
                <!-- <div class="checkbox-wrapper-16" data-seat="1A" id="economy">
                    <label class="checkbox-wrapper">
                        <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1A">
                        <span class="checkbox-tile">
                            <span class="checkbox-label">1A</span>
                        </span>
                    </label>
                </div> -->

                <div class="seat" data-seat="1B" id="economy">
                    <span class="seat-name">1B</span>
                    <input type="checkbox" name="selectedSeats[]" value="1B">
                </div>
                <div class="seat" data-seat="1C" id="economy">
                    <span class="seat-name">1C</span>
                    <input type="checkbox" name="selectedSeats[]" value="1C">
                </div>
                <div class="seat" data-seat="1D" id="economy">
                    <span class="seat-name">1D</span>
                    <input type="checkbox" name="selectedSeats[]" value="1D">
                </div>
                <div class="seat" data-seat="1E" id="economy">
                    <span class="seat-name">1E</span>
                    <input type="checkbox" name="selectedSeats[]" value="1E">
                </div>
                <div class="seat" data-seat="1F" id="economy">
                    <span class="seat-name">1F</span>
                    <input type="checkbox" name="selectedSeats[]" value="1F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="2A" id="economy">
                    <span class="seat-name">2A</span>
                    <input type="checkbox" name="selectedSeats[]" value="2A">
                </div>
                <div class="seat" data-seat="2B" id="economy">
                    <span class="seat-name">2B</span>
                    <input type="checkbox" name="selectedSeats[]" value="2B">
                </div>
                <div class="seat" data-seat="2C" id="economy">
                    <span class="seat-name">2C</span>
                    <input type="checkbox" name="selectedSeats[]" value="2C">
                </div>
                <div class="seat" data-seat="2D" id="economy">
                    <span class="seat-name">2D</span>
                    <input type="checkbox" name="selectedSeats[]" value="2D">
                </div>
                <div class="seat" data-seat="2E" id="economy">
                    <span class="seat-name">2E</span>
                    <input type="checkbox" name="selectedSeats[]" value="2E">
                </div>
                <div class="seat" data-seat="2F" id="economy">
                    <span class="seat-name">2F</span>
                    <input type="checkbox" name="selectedSeats[]" value="F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="3A" id="economy">
                    <span class="seat-name">3A</span>
                    <input type="checkbox" name="selectedSeats[]" value="3A">
                </div>
                <div class="seat" data-seat="3B" id="economy">
                    <span class="seat-name">3B</span>
                    <input type="checkbox" name="selectedSeats[]" value="3B">
                </div>
                <div class="seat" data-seat="3C" id="economy">
                    <span class="seat-name">3C</span>
                    <input type="checkbox" name="selectedSeats[]" value="3C">
                </div>
                <div class="seat" data-seat="3D" id="economy">
                    <span class="seat-name">3D</span>
                    <input type="checkbox" name="selectedSeats[]" value="3D">
                </div>
                <div class="seat" data-seat="3E" id="economy">
                    <span class="seat-name">3E</span>
                    <input type="checkbox" name="selectedSeats[]" value="3E">
                </div>
                <div class="seat" data-seat="3F" id="economy">
                    <span class="seat-name">3F</span>
                    <input type="checkbox" name="selectedSeats[]" value="3F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="4A" id="economy">
                    <span class="seat-name">4A</span>
                    <input type="checkbox" name="selectedSeats[]" value="4A">
                </div>
                <div class="seat" data-seat="4B" id="economy">
                    <span class="seat-name">4B</span>
                    <input type="checkbox" name="selectedSeats[]" value="4B">
                </div>
                <div class="seat" data-seat="4C" id="economy">
                    <span class="seat-name">4C</span>
                    <input type="checkbox" name="selectedSeats[]" value="4C">
                </div>
                <div class="seat" data-seat="4D" id="economy">
                    <span class="seat-name">4D</span>
                    <input type="checkbox" name="selectedSeats[]" value="4D">
                </div>
                <div class="seat" data-seat="4E" id="economy">
                    <span class="seat-name">4E</span>
                    <input type="checkbox" name="selectedSeats[]" value="4E">
                </div>
                <div class="seat" data-seat="4F" id="economy">
                    <span class="seat-name">4F</span>
                    <input type="checkbox" name="selectedSeats[]" value="4F">
                </div>
            </div>

            <!-- business -->

            <div id="seatContainer">
                <div class="seat" data-seat="5A" id="business">
                    <span class="seat-name">5A</span>
                    <input type="checkbox" name="selectedSeats[]" value="5A">
                </div>
                <div class="seat" data-seat="5B" id="business">
                    <span class="seat-name">5B</span>
                    <input type="checkbox" name="selectedSeats[]" value="5B">
                </div>
                <div class="seat" data-seat="5C" id="business">
                    <span class="seat-name">5C</span>
                    <input type="checkbox" name="selectedSeats[]" value="5C">
                </div>
                <div class="seat" data-seat="5D" id="business">
                    <span class="seat-name">5D</span>
                    <input type="checkbox" name="selectedSeats[]" value="5D">
                </div>
                <div class="seat" data-seat="5E" id="business">
                    <span class="seat-name">5E</span>
                    <input type="checkbox" name="selectedSeats[]" value="5E">
                </div>
                <div class="seat" data-seat="5F" id="business">
                    <span class="seat-name">5F</span>
                    <input type="checkbox" name="selectedSeats[]" value="5F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="6A" id="business">
                    <span class="seat-name">6A</span>
                    <input type="checkbox" name="selectedSeats[]" value="6A">
                </div>
                <div class="seat" data-seat="6B" id="business">
                    <span class="seat-name">6B</span>
                    <input type="checkbox" name="selectedSeats[]" value="6B">
                </div>
                <div class="seat" data-seat="6C" id="business">
                    <span class="seat-name">6C</span>
                    <input type="checkbox" name="selectedSeats[]" value="6C">
                </div>
                <div class="seat" data-seat="6D" id="business">
                    <span class="seat-name">6D</span>
                    <input type="checkbox" name="selectedSeats[]" value="6D">
                </div>
                <div class="seat" data-seat="6E" id="business">
                    <span class="seat-name">6E</span>
                    <input type="checkbox" name="selectedSeats[]" value="6E">
                </div>
                <div class="seat" data-seat="6F" id="business">
                    <span class="seat-name">6F</span>
                    <input type="checkbox" name="selectedSeats[]" value="6F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="7A" id="business">
                    <span class="seat-name">7A</span>
                    <input type="checkbox" name="selectedSeats[]" value="7A">
                </div>
                <div class="seat" data-seat="7B" id="business">
                    <span class="seat-name">7B</span>
                    <input type="checkbox" name="selectedSeats[]" value="7B">
                </div>
                <div class="seat" data-seat="7C" id="business">
                    <span class="seat-name">7C</span>
                    <input type="checkbox" name="selectedSeats[]" value="7C">
                </div>
                <div class="seat" data-seat="7D" id="business">
                    <span class="seat-name">7D</span>
                    <input type="checkbox" name="selectedSeats[]" value="7D">
                </div>
                <div class="seat" data-seat="7E" id="business">
                    <span class="seat-name">7E</span>
                    <input type="checkbox" name="selectedSeats[]" value="7E">
                </div>
                <div class="seat" data-seat="7F" id="business">
                    <span class="seat-name">7F</span>
                    <input type="checkbox" name="selectedSeats[]" value="7F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="8A" id="business">
                    <span class="seat-name">8A</span>
                    <input type="checkbox" name="selectedSeats[]" value="8A">
                </div>
                <div class="seat" data-seat="8B" id="business">
                    <span class="seat-name">8B</span>
                    <input type="checkbox" name="selectedSeats[]" value="8B">
                </div>
                <div class="seat" data-seat="8C" id="business">
                    <span class="seat-name">8C</span>
                    <input type="checkbox" name="selectedSeats[]" value="8C">
                </div>
                <div class="seat" data-seat="8D" id="business">
                    <span class="seat-name">8D</span>
                    <input type="checkbox" name="selectedSeats[]" value="8D">
                </div>
                <div class="seat" data-seat="8E" id="business">
                    <span class="seat-name">8E</span>
                    <input type="checkbox" name="selectedSeats[]" value="8E">
                </div>
                <div class="seat" data-seat="8F" id="business">
                    <span class="seat-name">8F</span>
                    <input type="checkbox" name="selectedSeats[]" value="8F">
                </div>
            </div>


            <!-- first -->

            <div id="seatContainer">
                <div class="seat" data-seat="9A" id="first">
                    <span class="seat-name">9A</span>
                    <input type="checkbox" name="selectedSeats[]" value="9A">
                </div>
                <div class="seat" data-seat="9B" id="first">
                    <span class="seat-name">9B</span>
                    <input type="checkbox" name="selectedSeats[]" value="9B">
                </div>
                <div class="seat" data-seat="9C" id="first">
                    <span class="seat-name">9C</span>
                    <input type="checkbox" name="selectedSeats[]" value="9C">
                </div>
                <div class="seat" data-seat="9D" id="first">
                    <span class="seat-name">9D</span>
                    <input type="checkbox" name="selectedSeats[]" value="9D">
                </div>
                <div class="seat" data-seat="9E" id="first">
                    <span class="seat-name">9E</span>
                    <input type="checkbox" name="selectedSeats[]" value="9E">
                </div>
                <div class="seat" data-seat="9F" id="first">
                    <span class="seat-name">9F</span>
                    <input type="checkbox" name="selectedSeats[]" value="9F">
                </div>
            </div>

            <div id="seatContainer">
                <div class="seat" data-seat="10A" id="first">
                    <span class="seat-name">10A</span>
                    <input type="checkbox" name="selectedSeats[]" value="10A">
                </div>
                <div class="seat" data-seat="10B" id="first">
                    <span class="seat-name">10B</span>
                    <input type="checkbox" name="selectedSeats[]" value="10B">
                </div>
                <div class="seat" data-seat="10C" id="first">
                    <span class="seat-name">10C</span>
                    <input type="checkbox" name="selectedSeats[]" value="10C">
                </div>
                <div class="seat" data-seat="10D" id="first">
                    <span class="seat-name">10D</span>
                    <input type="checkbox" name="selectedSeats[]" value="10D">
                </div>
                <div class="seat" data-seat="10E" id="first">
                    <span class="seat-name">10E</span>
                    <input type="checkbox" name="selectedSeats[]" value="10E">
                </div>
                <div class="seat" data-seat="10F" id="first">
                    <span class="seat-name">10F</span>
                    <input type="checkbox" name="selectedSeats[]" value="10F">
                </div>
            </div>
        </div>

        <div class="seat_contentright">
            <div class="box_duo">
                <div class="header-seatpair">
                    <p>จับคู่ที่นั่ง & ผู้โดยสาร</p>
                </div>
                <div class="header2-seatpair">
                    <p>ที่นั่งที่เลือก:<span id="selectedSeat"></span></p>
                    <p>ผู้โดยสารที่เลือก: <span id="selectedPassenger"></span></p>
                </div>
            </div>
            <div class="button_gogo">
                <button id="reserveButton" type="submit">ยืนยันการจองที่นั่ง</button>
            </div>
        </div>

    </form>




    <script>
        var selectedSeats = [];
        var selectedPassengers = [];
        var reservedSeats = []; // เก็บที่นั่งที่ถูกจองโดยผู้โดยสาร
        var seatpluspass = [];

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
        seats.forEach(function (seat) {
            seat.querySelector('input[type="checkbox"]').addEventListener("change", function () {
                toggleSeat(seat);
            });
        });

        var passengers = document.querySelectorAll("#passengerList li");
        passengers.forEach(function (passenger) {
            passenger.querySelector('input[type="checkbox"]').addEventListener("change", function () {
                selectPassenger(passenger);
            });
        });

        // let allSeatSelected = document.querySelectorAll(".seat");
        // allSeatSelected.forEach(each => each.addEventListener("click", e =>{
        // if(e.target.className === "seat" || e.target.className === "seat-name"){
        //     e.target.children[1].checked ^= 1}
        // toggleSeat(e.target.children[1]);
        // }));

    </script>

    <script>
<<<<<<< Updated upstream
        document.getElementById("reserveButton").addEventListener("click", function (event) {
            // ตรวจสอบการเลือกที่นั่งและผู้โดยสาร
            if (selectedSeats.length === 0 || selectedPassengers.length === 0) {
                // แจ้งเตือนผู้ใช้ให้เลือกที่นั่งและผู้โดยสาร
                alert("โปรดเลือกที่นั่งและผู้โดยสาร");
                event.preventDefault(); // ยกเลิกการส่งแบบฟอร์ม
            }
        });



=======
      document.getElementById("reserveButton").addEventListener("click", function(event) {

      if (selectedSeats.length === 0 || selectedPassengers.length === 0) {
          alert("โปรดเลือกที่นั่งและผู้โดยสาร");
          event.preventDefault(); 
      }
});
>>>>>>> Stashed changes
    </script>



</body>

</html>