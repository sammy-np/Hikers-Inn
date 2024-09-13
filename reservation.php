<?php
@include 'config.php';
@include 'user_page.php';
$user_name =$_SESSION['user_name'];
if(isset($_POST['submit'])){
   $room_type = $_POST['room_type'];
   $roomNumber = $_POST['roomNumber'];
   $meal_plan = $_POST['meal_plan'];
   $checkin = $_POST['checkin'];
   $checkout= $_POST['checkout'];

   $insert = "INSERT INTO room_book(user_name, room_type, roomNumber, meal_plan, checkin, checkout) VALUES('$user_name','$room_type', '$roomNumber', '$meal_plan', '$checkin', '$checkout')";
   mysqli_query($conn, $insert);
   };
   echo '<script>alert("room booked")</script>';
?>