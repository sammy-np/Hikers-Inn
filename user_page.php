<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}
$today = date("Y-m-d");
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>user page</title>

 <link rel="stylesheet" href="css/userpage.css">
   <style>
   body{
      background-image: url('images/background.jpg');
      background-attachment: fixed;
      background-size: cover;
   }
   </style>
</head>
<body>
<nav>
         <label class="logo">Hikers Inn</label>
         <ul>
            <li><a href="user_page1.php">Home</a></li>
            <li><a class="active" href="user_page.php">Book a room</a></li>
            <li>
               <div class="dropdown">
                  <a><span><?php echo $_SESSION['user_name'] ?></span> 
                     <i class="fa fa-caret-down"></i>
               </a>
                  <div class="dropdown-content">
                     <a href="logout.php" class="btn">logout</a>
                  </div>
               </div>
            </li>

         </ul>
      </nav>
   
<div class="form-container">
   <form action="reservation.php" method="post">
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <h3>BOOK ROOM</h3>
      <label for="room_type">Room Type</label>
      <select id="room_type" name="room_type" onchange="updateRoomNumbers()">
         <option value="single">Single</option>
         <option value="deluxe">Deluxe</option>
         <option value="luxury">Luxury</option>
      </select>
      <label for="roomNumber">Room Number</label>
      <select id="roomNumber" name="roomNumber">
         <!-- Options will be dynamically added here based on the selected room type -->
      </select>
      <label for="meal_plan">Meal Plan</label>
      <select name="meal_plan" id="meal_plan">
         <option value="room_only">room only</option>
         <option value="breakfast">breakfast</option>
         <option value="full_course">full course</option>
      </select>
      <label for="checkin">Check-in Date</label>
      <input type="date" name="checkin" min="<?php echo $today; ?>" id="checkin" required>
      <label for="checkout">Check-out Date</label>
      <input type="date" name="checkout" id="checkout" required>
      <input type="submit" name="submit" value="book now" class="form-btn">
   </form>

</div>
<script>
   function updateRoomNumbers() {
      const room_type = document.getElementById("room_type").value;
      const roomNumberSelect = document.getElementById("roomNumber");

    // Clear existing options
    roomNumberSelect.innerHTML = "";

    // Fetch available room numbers from the server
    fetch('get_available_rooms.php')
        .then(response => response.json())
        .then(data => {
            // Define room numbers based on the selected room type
            let roomNumbers = [];
            if (room_type === "luxury") {
                roomNumbers = ["301", "302", "303"];
            } else if (room_type === "single") {
                roomNumbers = ["101", "102", "103"];
            } else if (room_type === "deluxe") {
                roomNumbers = ["201", "202", "203"];
            }

            // Filter room numbers based on availability
            roomNumbers = roomNumbers.filter(roomNumber => !data.includes(roomNumber));

            // Add options to the select element
            roomNumbers.forEach(roomNumber => {
                const option = document.createElement("option");
                option.value = roomNumber;
                option.textContent = roomNumber;
                roomNumberSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching available rooms:', error);
        });
   }

      // Initialize the room numbers based on the default room type
      updateRoomNumbers();



    // Get the date input fields
    var checkinInput = document.getElementById('checkin');
    var checkoutInput = document.getElementById('checkout');

    // Add event listener to date1 input field
    checkinInput.addEventListener('change', function() {
      var checkinValue = new Date(checkinInput.value);
      
      // Calculate the minimum selectable date for checkout
      var minCheckout = new Date(checkinValue.getTime() + (24 * 60 * 60 * 1000)); // Add 1 day (24 hours) to checkin
      
      // Format minCheckout as YYYY-MM-DD
      var minCheckoutFormatted = minCheckout.toISOString().split('T')[0];
      
      // Set the min attribute of checkout input field to the calculated minimum date
      checkoutInput.min = minCheckoutFormatted;
    });
  </script>
</body>
</html>