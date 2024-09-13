<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
@include "get_available_rooms.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>admin page</title>
   <script src="admin_page1.js"></script>
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
            <li><a href="admin_page.php">Active Guests</a></li>
            <li><a href="admin_page1.php">Search</a></li>
            <li><a class="active" href="admin_page2.php">Room Details</Details></a></li>
            <li>
               <div class="dropdown">
                  <a><span><?php echo $_SESSION['admin_name'] ?></span> 
                     <i class="fa fa-caret-down"></i>
               </a>
                  <div class="dropdown-content">
                     <a href="logout.php" class="btn">logout</a>
                  </div>
               </div>
            </li>

         </ul>
      </nav>
    <div id="details">
    <?php
@include 'config.php';

// Check if the 'roomNumber' parameter is set in the URL
if (isset($_GET['roomNumber'])) {
    // Get the roomNumber parameter from the URL
    $roomNumber = $_GET['roomNumber'];

    // Query to retrieve room-related information based on roomNumber and availability
    $sql = "SELECT roomNumber, user_name, room_type, meal_plan, checkin, checkout FROM room_book WHERE roomNumber = '$roomNumber' 
            AND (checkin >= CURDATE() OR checkout <= CURDATE())";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Start displaying the table
        echo "<table border='1'>
                <tr>
                    <th>Room Number</th>
                    <th>User Name</th>
                    <th>Room Type</th>
                    <th>Meal Plan</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total Price</th>
                </tr>";

        // Fetch and display room-related information
        while ($row = $result->fetch_assoc()) {
            $roomType = $row['room_type'];
            $mealPlan = $row['meal_plan'];
            $checkin = strtotime($row['checkin']);
            $checkout = strtotime($row['checkout']);
            $duration = floor(($checkout - $checkin) / (60 * 60 * 24)); // Calculate duration in days

            // Calculate the price based on room type and meal plan
            $roomPrice = 0;
            if ($roomType === "single") {
                $roomPrice = 1000;
            } elseif ($roomType === "deluxe") {
                $roomPrice = 2000;
            } elseif ($roomType === "luxury") {
                $roomPrice = 3000;
            }

            $mealPrice = 0;
            if ($mealPlan === "breakfast") {
                $mealPrice = 1000;
            } elseif ($mealPlan === "full_course") {
                $mealPrice = 3000;
            }

            $totalPrice = ($roomPrice + $mealPrice) * $duration;

            echo "<tr>";
            echo "<td>" . $row['roomNumber'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['room_type'] . "</td>";
            echo "<td>" . $row['meal_plan'] . "</td>";
            echo "<td>" . date("Y-m-d", $checkin) . "</td>";
            echo "<td>" . date("Y-m-d", $checkout) . "</td>";
            echo "<td>" . $totalPrice . "</td>";
            echo "</tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        
        <form action="reservation.php" method="post">
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
        }

    // Close the database connection
    $conn->close();
    } else {
    echo "Room number not provided.";
}
?>
    </div>
   </body>
</html>

