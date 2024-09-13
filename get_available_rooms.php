<?php
@include 'config.php';

// Get today's date
$today = date("Y-m-d");

// Query to select available room numbers
$sql = "SELECT roomNumber FROM room_book 
        WHERE checkin <= '$today' AND checkout >= '$today'";

$result = $conn->query($sql);

$availableRooms = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $availableRooms[] = $row['roomNumber'];
    }
}

// Close the database connection
$conn->close();

// Return the available room numbers as a JSON response
echo json_encode($availableRooms);
?>
