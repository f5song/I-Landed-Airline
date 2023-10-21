<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_login'];

// ตรวจสอบหากมีการส่งคำร้องขอ POST เมื่อคลิกที่ "ยืนยันการจองที่นั่ง"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passengerName = $_POST["passengerName"];
    $selectedSeats = $_POST["selectedSeats"];

    $flight_id = 1; // เปลี่ยนเลขเที่ยวบินตามที่คุณต้องการ

    // วนลูปผู้โดยสารที่เลือกและที่นั่งที่ถูกเลือก
    foreach ($selectedSeats as $seat) {
        // สร้างคำสั่ง SQL INSERT
        $insertSQL = "INSERT INTO `reservations` (`passenger_id`, `flight_id`, `seat_number`, `user_id`) VALUES (?, ?, ?, ?)";

        $passengerAndSeat = explode("-", $seat);
        $passenger_id = $passengerAndSeat[0]; // รหัสผู้โดยสาร
        $seat_number = $passengerAndSeat[1]; // หมายเลขที่นั่ง

        // ตรวจสอบการเตรียมคำสั่ง SQL
        if ($stmt = mysqli_prepare($conn, $insertSQL)) {
            $user_id = $_SESSION['user_login'];

            mysqli_stmt_bind_param($stmt, "iisi", $passenger_id, $flight_id, $seat_number, $user_id);
            mysqli_stmt_execute($stmt);
        } else {
            die("คำสั่ง SQL ผิดพลาด: " . mysqli_error($conn));
        }
    }
}

// ดึงข้อมูลผู้โดยสาร
$sql = "SELECT `passenger_id`,`user_id`, `first_name`, `last_name` FROM `passengers` WHERE `user_id` = '$user_id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("คำสั่ง SQL ผิดพลาด: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="aircraft1.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto Sans Thai:wght@600&display=swap">
</head>

<body>

  <div class="row--customer">
    <div class="header-seat">
      <h1>Seat Selection</h1>
    </div>
    <div class="frame">
      <div class="customer-info">
        <hr>
        <p class="passenger-item" data-passenger="<?php echo $row['passenger_id'] ?>"><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></p>
        <hr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <p class="passenger-item" data-passenger="<?php echo $row['passenger_id'] ?>"><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></p>
          <hr>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="aircraft">
    <div class="plane">
      <div class="cockpit">
        <h1>I LANDED AIRLINE</h1>
      </div>
      <div class="exit exit--front fuselage">

      </div>
      <ol class="cabin fuselage">
        <li class="row row--1">
          <ol class="seats">
            <li class="seat">
              <input type="checkbox" id="1A" onchange="seatChanged(this)" class="seat available" />
              <label for="1A" data-seat="1A" data-passenger="<?php echo $row['passenger_id'] ?>">1A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1B" onchange="seatChanged(this)" class="seat available" />
              <label for="1B" data-seat="1B" data-passenger="<?php echo $row['passenger_id'] ?>">1B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1C" onchange="seatChanged(this)" class="seat available" />
              <label for="1C">1C</label>
            </li>
            <!-- <li class="seat">
              <input type="checkbox" disabled id="1D" onchange="seatChanged(this)" class="seat available" />
              <label for="1D">Occupied</label>
            </li> -->
            <li class="seat">
              <input type="checkbox" id="1D" onchange="seatChanged(this)" class="seat available" />
              <label for="1D">1D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1E" onchange="seatChanged(this)" class="seat available" />
              <label for="1E">1E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1F" onchange="seatChanged(this)" class="seat available" />
              <label for="1F">1F</label>
            </li>
          </ol>
        </li>
        <li class="row row--2">
          <ol class="seats">
            <li class="seat">
              <input type="checkbox" id="2A" onchange="seatChanged(this)" class="seat available" />
              <label for="2A">2A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2B" onchange="seatChanged(this)" class="seat available" />
              <label for="2B">2B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2C" onchange="seatChanged(this)" class="seat available" />
              <label for="2C">2C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2D" onchange="seatChanged(this)" class="seat available" />
              <label for="2D">2D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2E" onchange="seatChanged(this)" class="seat available" />
              <label for="2E">2E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2F" onchange="seatChanged(this)" class="seat available" />
              <label for="2F">2F</label>
            </li>
          </ol>
        </li>
        <li class="row row--3">
          <ol class="seats">
            <li class="seat">
              <input type="checkbox" id="3A" onchange="seatChanged(this)" class="seat available" />
              <label for="3A">3A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3B" onchange="seatChanged(this)" class="seat available" />
              <label for="3B">3B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3C" onchange="seatChanged(this)" class="seat available" />
              <label for="3C">3C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3D" onchange="seatChanged(this)" class="seat available" />
              <label for="3D">3D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3E" onchange="seatChanged(this)" class="seat available" />
              <label for="3E">3E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3F" onchange="seatChanged(this)" class="seat available" />
              <label for="3F">3F</label>
            </li>
          </ol>
        </li>
        <li class="row row--4">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="4A" onchange="seatChanged(this)" class="seat available" />
              <label for="4A">4A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4B" onchange="seatChanged(this)" class="seat available" />
              <label for="4B">4B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4C" onchange="seatChanged(this)" class="seat available" />
              <label for="4C">4C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4D" onchange="seatChanged(this)" class="seat available" />
              <label for="4D">4D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4E" onchange="seatChanged(this)" class="seat available" />
              <label for="4E">4E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4F" onchange="seatChanged(this)" class="seat available" />
              <label for="4F">4F</label>
            </li>
          </ol>
        </li>
        <li class="row row--5">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="5A" onchange="seatChanged(this)" class="seat available" />
              <label for="5A">5A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5B" onchange="seatChanged(this)" class="seat available" />
              <label for="5B">5B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5C" onchange="seatChanged(this)" class="seat available" />
              <label for="5C">5C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5D" onchange="seatChanged(this)" class="seat available" />
              <label for="5D">5D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5E" onchange="seatChanged(this)" class="seat available" />
              <label for="5E">5E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5F" onchange="seatChanged(this)" class="seat available" />
              <label for="5F">5F</label>
            </li>
          </ol>
        </li>
        <li class="row row--6">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="6A" onchange="seatChanged(this)" class="seat available" />
              <label for="6A">6A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6B" onchange="seatChanged(this)" class="seat available" />
              <label for="6B">6B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6C" onchange="seatChanged(this)" class="seat available" />
              <label for="6C">6C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6D" onchange="seatChanged(this)" class="seat available" />
              <label for="6D">6D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6E" onchange="seatChanged(this)" class="seat available" />
              <label for="6E">6E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6F" onchange="seatChanged(this)" class="seat available" />
              <label for="6F">6F</label>
            </li>
          </ol>
        </li>
        <li class="row row--7">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="7A" onchange="seatChanged(this)" class="seat available" />
              <label for="7A">7A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7B" onchange="seatChanged(this)" class="seat available" />
              <label for="7B">7B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7C" onchange="seatChanged(this)" class="seat available" />
              <label for="7C">7C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7D" onchange="seatChanged(this)" class="seat available" />
              <label for="7D">7D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7E" onchange="seatChanged(this)" class="seat available" />
              <label for="7E">7E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7F" onchange="seatChanged(this)" class="seat available"/>
              <label for="7F">7F</label>
            </li>
          </ol>
        </li>
        <li class="row row--8">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="8A" onchange="seatChanged(this)" class="seat available"/>
              <label for="8A">8A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8B" onchange="seatChanged(this)" class="seat available"/>
              <label for="8B">8B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8C" onchange="seatChanged(this)" class="seat available"/>
              <label for="8C">8C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8D" onchange="seatChanged(this)" class="seat available"/>
              <label for="8D">8D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8E" onchange="seatChanged(this)" class="seat available"/>
              <label for="8E">8E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8F" onchange="seatChanged(this)" class="seat available"/>
              <label for="8F">8F</label>
            </li>
          </ol>
        </li>
        <li class="row row--9">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="9A" onchange="seatChanged(this)" class="seat available"/>
              <label for="9A">9A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9B" onchange="seatChanged(this)" class="seat available"/>
              <label for="9B">9B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9C" onchange="seatChanged(this)" class="seat available"/>
              <label for="9C">9C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9D" onchange="seatChanged(this)" class="seat available"/>
              <label for="9D">9D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9E" onchange="seatChanged(this)" class="seat available"/>
              <label for="9E">9E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9F" onchange="seatChanged(this)" class="seat available"/>
              <label for="9F">9F</label>
            </li>
          </ol>
        </li>
        <li class="row row--10">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="10A" onchange="seatChanged(this)" class="seat available"/>
              <label for="10A">10A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10B" onchange="seatChanged(this)" class="seat available"/>
              <label for="10B">10B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10C" onchange="seatChanged(this)" class="seat available"/>
              <label for="10C">10C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10D" onchange="seatChanged(this)" class="seat available"/>
              <label for="10D">10D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10E" onchange="seatChanged(this)" class="seat available"/>
              <label for="10E">10E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10F" onchange="seatChanged(this)" class="seat available"/>
              <label for="10F">10F</label>
            </li>
          </ol>
        </li>
      </ol>
      <div class="exit exit--back fuselage">

      </div>
    </div>
  </div>
  <div class="price">
    <div class="cartlock">
      <div class="header-cart">
        <h1>รายการที่เลือก</h1>
      </div>
      <div class="ticketlock">
        <div id="selected-seats-list">
        </div>
      </div>
      <div class="sum-price">
        <div class="text-price">
          <span>Total:</span>
          <span>฿1000.00</span>
        </div>
      </div>
      <div class="button-checkout">
        <button id="selectSeatsButton">Checkout</button>
      </div>
    </div>
    <div class="detail-color-class">
      <div class="detail-first-class">
        <img src="../public/circle-firstclass.png" alt="">
        <div class="text-first-class">
          <span>First Class</span>
          <span>(฿50)</span>
        </div>
      </div>
      <div class="detail-business-class">
        <img src="../public/circle-businessclass.png" alt="">
        <div class="text-business-class">
          <span>Business Class</span>
          <span>(฿30)</span>
        </div>
      </div>
      <div class="detail-economy-class">
        <img src="../public/circle-economyclass.png" alt="">
        <div class="text-economy-class">
          <span>Economy Class</span>
          <span>(฿10)</span>
        </div>
      </div>
    </div>
  </div>


<script>
        const seats = document.querySelectorAll('.seat');
        const passengerItems = document.querySelectorAll('.passenger-item');
        

        let selectedPassenger = null;
        let selectedSeats = {};

        passengerItems.forEach((passengerItem) => {
          passengerItem.addEventListener('click', () => {
              if (selectedPassenger) {
                  selectedPassenger.classList.remove('selected');
              }
              selectedPassenger = passengerItem;
              selectedPassenger.classList.add('selected');

              // เพิ่มเครื่องหมาย cursor และเปลี่ยนสีพื้นหลัง
              passengerItems.forEach((item) => {
                  if (item !== selectedPassenger) {
                      item.style.cursor = 'pointer';
                      item.style.backgroundColor = 'white'; // เปลี่ยนสีพื้นหลังกลับเป็นขาว
                  } else {
                      item.style.cursor = 'default';
                      item.style.backgroundColor = 'green'; // เพิ่มเครื่องหมาย cursor แบบปกติ
                  }
              });
          });
      });

        seats.forEach((seat) => {
        seat.addEventListener('click', () => {
          if (seat.classList.contains('available') && selectedPassenger) {
            if (selectedSeats[selectedPassenger.getAttribute('data-passenger')]) {
              selectedSeats[selectedPassenger.getAttribute('data-passenger')].classList.remove('booked');
              selectedSeats[selectedPassenger.getAttribute('data-passenger')].classList.add('available');
            }
            seat.classList.remove('available');
            seat.classList.add('booked');
            const seatNumber = seat.getAttribute('data-seat'); // เอาไว้เก็บหมายเลขที่นั่งที่ผู้ใช้เลือก
            // เพิ่มรายการที่นั่งที่เลือกลงใน #selected-seats-list
            const selectedSeatsList = document.getElementById('selected-seats-list');
            selectedSeatsList.innerHTML += `<p>${selectedPassenger.getAttribute('data-passenger')} เลือกที่นั่ง ${seatNumber}</p>`;
            selectedSeats[selectedPassenger.getAttribute('data-passenger')] = seat;
        }
      });
    });
    </script>

</body>

</html>
