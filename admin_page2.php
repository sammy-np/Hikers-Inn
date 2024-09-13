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
        .room-container {
            padding:50px;
            margin-top:125px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .room-button {
            margin-top:10%;
            width: auto;
            height: 100px;
            text-align: center;
            line-height: 100px;
            font-size: 18px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        .booked {
            background-color: green;
            color: white;
        }

        .available {
            background-color: red;
            color: white;
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
      <div id="details"><h2>room details</h2></div>
      <div class="room-container" id="details">
           <?php
    // Create buttons for each room (101, 102, 103, 201, 202, 203, 301, 302, 303)
    $roomNumbers = [101, 102, 103, 201, 202, 203, 301, 302, 303];
    foreach ($roomNumbers as $roomNumber) {
        // Check if the room number is in the list of available rooms
        $buttonClass = in_array($roomNumber, $availableRooms) ? 'available' : 'booked';
        
        // Create a link to admin_page3.php with the roomNumber parameter
        echo "<a href='admin_page3.php?roomNumber=$roomNumber' class='room-button $buttonClass'>Room $roomNumber</a>";
    }
    ?>
    </div>
   </body>
</html>

