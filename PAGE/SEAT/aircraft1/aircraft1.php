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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap">
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

        <div class="aircraft">
            <div class="plane">
                <div class="cockpit">
                    <h1>I LANDED AIRLINE</h1>
                </div>
                <div class="exit exit--front fuselage"></div>
                <div class="cabin fuselage">
                    <div class="row row-1 seat">
                        <div class="checkbox-wrapper-1 seat" data-seat="1A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">1A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="1B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">1B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="1C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">1C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="1D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">1D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="1E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">1E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="1F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="1F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">1F</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row row-2 seat">
                        <div class="checkbox-wrapper-1 seat" data-seat="2A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="2A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">2A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="2B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="2B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">2B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="2C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="2C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">2C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="2D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="2D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">2D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="2E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="2E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">2E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="2F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="2F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">2F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-3 seat">
                        <div class="checkbox-wrapper-1 seat" data-seat="3A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="3A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">3A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="3B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="3B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">3B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="3C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="3C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">3C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="3D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="3D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">3D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="3E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="3E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">3E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="3F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="3F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">3F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-4 seat">
                        <div class="checkbox-wrapper-1 seat" data-seat="4A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="4A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">4A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="4B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="4B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">4B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="4C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="4C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">4C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="4D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="4D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">4D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="4E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="4E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">4E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-1 seat" data-seat="4F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="4F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">4F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-5 seat">
                        <div class="checkbox-wrapper-2 seat" data-seat="5A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="5A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">5A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="5B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="5B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">5B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="5C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="5C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">5C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="5D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="5D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">5D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="5E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="5E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">5E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="5F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="5F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">5F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-6 seat">
                        <div class="checkbox-wrapper-2 seat" data-seat="6A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="6A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">6A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="6B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="6B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">6B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="6C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="6C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">6C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="6D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="6D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">6D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="6E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="6E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">6E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="6F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="6F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">6F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-7 seat">
                        <div class="checkbox-wrapper-2 seat" data-seat="7A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="7A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">7A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="7B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="7B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">7B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="7C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="7C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">7C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="7D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="7D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">7D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="7E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="7E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">7E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="7F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="7F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">7F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-8 seat">
                        <div class="checkbox-wrapper-2 seat" data-seat="8A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="8B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="8C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="8D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="8E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-2 seat" data-seat="8F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-9 seat">
                        <div class="checkbox-wrapper-3 seat" data-seat="8A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="8B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="8C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="8D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="8E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="8F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="8F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">8F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-10 seat">
                        <div class="checkbox-wrapper-3 seat" data-seat="9A" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="9A">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">9A</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="9B" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="9B">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">9B</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="9C" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="9C">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">9C</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="9D" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="9D">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">9D</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="9E" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="9E">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">9E</span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-3 seat" data-seat="9F" id="economy">
                            <label class="checkbox-wrapper">
                                <input class="checkbox-input" type="checkbox" name="selectedSeats[]" value="9F">
                                <span class="checkbox-tile">
                                    <span class="checkbox-label seat-name">9F</span>
                                </span>
                            </label>
                        </div>
                    </div>

                </div>
                <div class="exit exit--back fuselage"></div>
            </div>
        </div>
        <div class="seat_contentright">
            <div class="box_duo">
                <div class="header-seatpair">
                    <h2>จับคู่ที่นั่ง & ผู้โดยสาร</h2>
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
        document.getElementById("reserveButton").addEventListener("click", function (event) {

            if (selectedSeats.length === 0 || selectedPassengers.length === 0) {
                alert("โปรดเลือกที่นั่งและผู้โดยสาร");
                event.preventDefault();
            }
        });

    </script>



</body>

</html>