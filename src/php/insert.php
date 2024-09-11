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
if(isset($_GET['distance']) && isset($_GET['id'])) {
    $sensor_value = intval($_GET['distance']); // Ensure this is an integer
    $id = intval($_GET['id']); // Ensure this is an integer

    // Get the current time
    $current_time = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS

    // Prepare the SQL statement to update the water level and the current time
    $stmt = $conn->prepare("UPDATE water_levels SET water_level = $_POST, current_time = ? WHERE sensorId = ?");

    // Bind the parameters (water_level, current_time, sensorId)
    $stmt->bind_param("isi", $sensor_value, $current_time, $id);

    // Debugging: Output the SQL statement and data
    echo "Updating sensor ID: $id with distance: $sensor_value at time: $current_time <br>";

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Record updated successfully<br>";
    } else {
        echo "Error updating record: " . $stmt->error . "<br>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No sensor value or id received<br>";
}

// Close the connection
$conn->close();
?>
