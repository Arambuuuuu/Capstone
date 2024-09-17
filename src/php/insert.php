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
$sql = "SELECT * FROM `water_levels` WHERE 1";
$result = $conn->query($sql);

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch each row of the result set
    while ($row = $result->fetch_assoc()) {
        $sensor_value = $row["water_level"]; // Get the 'water_level' from the row
        echo "<br>Water Level: " . $sensor_value . " cm<br>"; // Display the value
    }
} else {
    echo "No results found.";
}



// Close the connection
$conn->close();

header("Location: index.php");
exit(); // Ensure no further code is executed after the redirect

?>
