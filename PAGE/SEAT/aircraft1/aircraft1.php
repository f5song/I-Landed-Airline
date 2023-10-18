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
        <p>ID: 12345</p>
        <p>Name: John Doe</p>
        <p>Last Name: Smith</p>
        <p>Tickets: 3</p>
        <input type="number" id="ticketQuantity" min="1" max="6">
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
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="1A" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1A">1A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1B" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1B">1B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1C" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1C">1C</label>
            </li>
            <!-- <li class="seat">
              <input type="checkbox" disabled id="1D" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1D">Occupied</label>
            </li> -->
            <li class="seat">
              <input type="checkbox" id="1D" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1D">1D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1E" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1E">1E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="1F" onchange="seatChanged(this)" class="seat-group1" />
              <label for="1F">1F</label>
            </li>
          </ol>
        </li>
        <li class="row row--2">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="2A" onchange="seatChanged(this)" class="seat-group2" />
              <label for="2A">2A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2B" onchange="seatChanged(this)" class="seat-group2" />
              <label for="2B">2B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2C" onchange="seatChanged(this)" class="seat-group2" />
              <label for="2C">2C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2D" onchange="seatChanged(this)" class="seat-group2" />
              <label for="2D">2D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2E" onchange="seatChanged(this)" class="seat-group2" />
              <label for="2E">2E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="2F" onchange="seatChanged(this)" class="seat-group2" />
              <label for="2F">2F</label>
            </li>
          </ol>
        </li>
        <li class="row row--3">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="3A" onchange="seatChanged(this)" class="seat-group3" />
              <label for="3A">3A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3B" onchange="seatChanged(this)" class="seat-group3" />
              <label for="3B">3B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3C" onchange="seatChanged(this)" class="seat-group3" />
              <label for="3C">3C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3D" onchange="seatChanged(this)" class="seat-group3" />
              <label for="3D">3D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3E" onchange="seatChanged(this)" class="seat-group3" />
              <label for="3E">3E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="3F" onchange="seatChanged(this)" class="seat-group3" />
              <label for="3F">3F</label>
            </li>
          </ol>
        </li>
        <li class="row row--4">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="4A" onchange="seatChanged(this)" class="seat-group4" />
              <label for="4A">4A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4B" onchange="seatChanged(this)" class="seat-group4" />
              <label for="4B">4B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4C" onchange="seatChanged(this)" class="seat-group4" />
              <label for="4C">4C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4D" onchange="seatChanged(this)" class="seat-group4" />
              <label for="4D">4D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4E" onchange="seatChanged(this)" class="seat-group4" />
              <label for="4E">4E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="4F" onchange="seatChanged(this)" class="seat-group4" />
              <label for="4F">4F</label>
            </li>
          </ol>
        </li>
        <li class="row row--5">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="5A" onchange="seatChanged(this)" class="seat-group5" />
              <label for="5A">5A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5B" onchange="seatChanged(this)" class="seat-group5" />
              <label for="5B">5B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5C" onchange="seatChanged(this)" class="seat-group5" />
              <label for="5C">5C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5D" onchange="seatChanged(this)" class="seat-group5" />
              <label for="5D">5D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5E" onchange="seatChanged(this)" class="seat-group5" />
              <label for="5E">5E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="5F" onchange="seatChanged(this)" class="seat-group5" />
              <label for="5F">5F</label>
            </li>
          </ol>
        </li>
        <li class="row row--6">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="6A" onchange="seatChanged(this)" class="seat-group6" />
              <label for="6A">6A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6B" onchange="seatChanged(this)" class="seat-group6" />
              <label for="6B">6B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6C" onchange="seatChanged(this)" class="seat-group6" />
              <label for="6C">6C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6D" onchange="seatChanged(this)" class="seat-group6" />
              <label for="6D">6D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6E" onchange="seatChanged(this)" class="seat-group6" />
              <label for="6E">6E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="6F" onchange="seatChanged(this)" class="seat-group6" />
              <label for="6F">6F</label>
            </li>
          </ol>
        </li>
        <li class="row row--7">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="7A" onchange="seatChanged(this)" class="seat-group7" />
              <label for="7A">7A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7B" onchange="seatChanged(this)" class="seat-group7" />
              <label for="7B">7B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7C" onchange="seatChanged(this)" class="seat-group7" />
              <label for="7C">7C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7D" onchange="seatChanged(this)" class="seat-group7" />
              <label for="7D">7D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7E" onchange="seatChanged(this)" class="seat-group7" />
              <label for="7E">7E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="7F" onchange="seatChanged(this)" class="seat-group7"/>
              <label for="7F">7F</label>
            </li>
          </ol>
        </li>
        <li class="row row--8">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="8A" onchange="seatChanged(this)" />
              <label for="8A">8A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8B" onchange="seatChanged(this)" />
              <label for="8B">8B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8C" onchange="seatChanged(this)" />
              <label for="8C">8C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8D" onchange="seatChanged(this)" />
              <label for="8D">8D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8E" onchange="seatChanged(this)" />
              <label for="8E">8E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="8F" onchange="seatChanged(this)" />
              <label for="8F">8F</label>
            </li>
          </ol>
        </li>
        <li class="row row--9">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="9A" onchange="seatChanged(this)" />
              <label for="9A">9A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9B" onchange="seatChanged(this)" />
              <label for="9B">9B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9C" onchange="seatChanged(this)" />
              <label for="9C">9C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9D" onchange="seatChanged(this)" />
              <label for="9D">9D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9E" onchange="seatChanged(this)" />
              <label for="9E">9E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="9F" onchange="seatChanged(this)" />
              <label for="9F">9F</label>
            </li>
          </ol>
        </li>
        <li class="row row--10">
          <ol class="seats" type="A">
            <li class="seat">
              <input type="checkbox" id="10A" onchange="seatChanged(this)" />
              <label for="10A">10A</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10B" onchange="seatChanged(this)" />
              <label for="10B">10B</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10C" onchange="seatChanged(this)" />
              <label for="10C">10C</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10D" onchange="seatChanged(this)" />
              <label for="10D">10D</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10E" onchange="seatChanged(this)" />
              <label for="10E">10E</label>
            </li>
            <li class="seat">
              <input type="checkbox" id="10F" onchange="seatChanged(this)" />
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
    let selectedSeatsCount = 0; // สร้างตัวแปรเพื่อเก็บจำนวนที่ถูกเลือก

    function seatChanged(checkbox) {
      const seatId = checkbox.id;
      const label = checkbox.nextElementSibling.textContent;
      const selectedSeatsList = document.getElementById("selected-seats-list");

      if (checkbox.checked) {
        const listItem = document.createElement("li");
        listItem.textContent = label;
        listItem.setAttribute("data-seat-id", seatId);
        selectedSeatsList.appendChild(listItem);

        selectedSeatsCount++; // เพิ่มจำนวนที่ถูกเลือกเมื่อ checkbox ถูกตรวจสอบ

        // ตรวจสอบจำนวนที่ถูกเลือกและกำหนดสีตามจำนวน
        if (seatId >= "1A" && seatId <= "3F") {
          listItem.classList.add("blue-bg"); // เพิ่ม CSS class "blue-bg" เพื่อกำหนดสีพื้นหลังเป็นสีฟ้า
        } else if (seatId >= "4A" && seatId <= "7F") {
          listItem.classList.add("orange-bg"); // เพิ่ม CSS class "orange-bg" เพื่อกำหนดสีพื้นหลังเป็นสีส้ม
        } else{
          listItem.classList.add("blue1-bg"); // เพิ่ม CSS class "blue-bg" เพื่อกำหนดสีพื้นหลังเป็นสีฟ้า
        }
      } else {
        const listItemToRemove = selectedSeatsList.querySelector(`[data-seat-id="${seatId}"]`);
        if (listItemToRemove) {
          selectedSeatsList.removeChild(listItemToRemove);
          selectedSeatsCount--; // ลดจำนวนที่ถูกเลือกเมื่อ checkbox ถูกยกเลิก
        }
      }
    }

      document.getElementById("selectSeatsButton").addEventListener("click", function () {
        const ticketQuantity = parseInt(document.getElementById("ticketQuantity").value);
        if (selectedSeatsCount > ticketQuantity) {
          alert("คุณเลือกเกินจำนวนตั๋วที่ระบุ");
          // ครั้งที่คลิกปุ่ม "เลือกที่นั่ง" เราไม่จำเป็นต้องเปลี่ยนค่า checkbox
          // แต่สามารถให้ผู้ใช้เลือกใหม่หรือลดจำนวนตั๋วเพิ่มเอง
        }
      });
  </script>


  <script>

    function toBaggage() {
        window.location.href = '../../BAGGAGE/baggage.php';
    }

    buttonselectSeats = document.getElementById("selectSeatsButton");
    buttonselectSeats.addEventListener("click", toBaggage);

  </script>

</body>

</html>
