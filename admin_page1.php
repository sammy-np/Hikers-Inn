<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
$sql = "SELECT DISTINCT name, email FROM user_form Where user_type='user' ORDER BY name ASC ";

// Execute the query
$result = $conn->query($sql);

// Close the database connection
$conn->close();
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
            <li><a class="active" href="admin_page1.php">Search</a></li>
            <li><a href="admin_page2.php">Room Details</Details></a></li>
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
         <h2>Total Guests</h2>
         <input type="text" id="searchInput" placeholder="Search...">
         <table id="totalGuest">
            <tr>
               <th>Name</th>
               <th>Email</th>
            </tr>
            <?php
               // Iterate through the fetched rows and display the data in the table
               while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['email'] . "</td>";
                  echo "</tr>";
               }
            ?>
         </table>
      </div>
   </body>
</html>
