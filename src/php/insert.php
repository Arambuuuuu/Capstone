<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "awis_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data is received via GET method
if(isset($_GET['sensor_value']) && isset($_GET['id'])) {
    $sensor_value = intval($_GET['sensor_value']);
    $id = intval($_GET['id']);
    
    // Update data in the database
    $sql = "UPDATE water_levels SET water_level = $sensor_value WHERE sensorId = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No sensor value or id received";
}

$conn->close();
?>
