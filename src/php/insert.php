<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "awis_db";

// Create connection using mysqli object-oriented style
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data is received via GET method
if(isset($_GET['distance']) && isset($_GET['id'])) {
    $sensor_value = intval($_GET['distance']); // Cast to integer for safety
    $id = intval($_GET['id']); // Cast to integer for safety

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE water_levels SET water_level = ? WHERE sensorID = ?");
    
    // Bind parameters to the prepared statement (i = integer type)
    $stmt->bind_param("ii", $sensor_value, $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No sensor value or id received";
}

// Close the connection
$conn->close();
?>
