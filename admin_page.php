<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>admin page</title>

 <link rel="stylesheet" href="css/userpage.css">
   <style>
      body{
         background-image: url('images/background.jpg');
         background-attachment: fixed;
         background-size: cover;
      }
      #details{
         height:auto;
         margin-left:auto;
         margin-right:auto;
         width: 90%;
         background-color:#127369;
         margin-top: 125px;
         border-radius: 25px;
      }
      #details h2{
         text-align: center;
         color:white;
         font-size:100px;
      }
      table {
      border-collapse: collapse;
      width: 100%;
      color:white;
    }
    th, td {
      padding: 8px;
      text-align: left;
      font-size:20px;
      border-bottom: 1px solid #ddd;
    }
    
   </style>
</head>
<body>
      <nav>
         <label class="logo">Hikers Inn</label>
         <ul>
            <li><a class="active" href="admin_page.php">ACtive Guests</a></li>
            <li><a href="admin_page1.php">search</a></li>
            <li><a href="admin_page2.php">Room Details</a></li>
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
         <h2>Active Guest Details</h2>
         <?php
            @include 'config.php';
            $today=date("y-m-d");
            $query = "SELECT * FROM room_book WHERE checkout>='$today'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
               $html = '<table>';
               $html .= '<tr>';
               $html .= '<td>' . 'User Name' . '</td>';
               $html .= '<td>' . 'Room Type' . '</td>';
               $html .= '<td>' . 'Room Number' . '</td>';
               $html .= '<td>' . 'Meal plans' . '</td>';
               $html .= '<td>' . 'Checkin' . '</td>';
               $html .= '<td>' . 'Checkout' . '</td>';
               $html .= '</tr>';
               while ($row = $result->fetch_assoc()) {
                  $html .= '<tr>';
                  $html .= '<td>' . $row['user_name'] . '</td>';
                  $html .= '<td>' . $row['room_type'] . '</td>'; 
                  $html .= '<td>' . $row['roomNumber'] . '</td>'; 
                  $html .= '<td>' . $row['meal_plan'] . '</td>'; 
                  $html .= '<td>' . $row['checkin'] . '</td>'; 
                  $html .= '<td>' . $row['checkout'] . '</td>'; 
                  $html .= '</tr>'; 
               }
               $html .= '</table>';
             } else {
               $html = 'No records found for today.';
             }
             
             // Output the generated HTML
             echo $html;
             
             // Close the database connection
             $conn->close();
         ?>
      </div>
   </body>
</html>
