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
if(isset($_POST['sensor_value'])) {
    $sensor_value = intval($_POST['sensor_value']);
    
    // Insert data into database
    $sql = "INSERT INTO water_levels (sensor_value) VALUES ($sensor_value)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No sensor value received";
}

$conn->close();
?>
