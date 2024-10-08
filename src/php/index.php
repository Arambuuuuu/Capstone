<?php
// Start the session
session_start();

// Include the database connection file
require('../DB_Connection/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['name']) || !isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: authentication-login.php");
    exit();
}

// Retrieve the latest data from the database
$sql = "SELECT * FROM water_levels ORDER BY current_time DESC LIMIT 1";
$result = $conn->query($sql);

$sensor_value = $status = $timestamp = "";
$sensor_value = $status = $timestamp = "";
if ($result->num_rows > 0) {
    // Output data of the latest record
    $row = $result->fetch_assoc();
    $sensor_value = $row["water_level"];

    // Interpret sensor value based on conditions
    if ($sensor_value >= 4095) {
        $status = "No Water";
    } elseif ($sensor_value <= 1300) {
        $status = "Full";
    } else {
        $status = "Irrigating";
    }

    // Format timestamp if needed
    $timestamp = date("Y-m-d H:i:s", strtotime($row["current_time"]));

    $percentage = 0;
    $p = $percentage = "";
    if ($sensor_value >= 4095) {
        $p = "0";
    } else if ($sensor_value <= 1300) {
        $p = "100";
    } else if ($sensor_value <= 1600) {
        $p = "85.7";
    } else if ($sensor_value <= 1700) {
        $p = "71.4";
    } else if ($sensor_value <= 1950) {
        $p = "50";
    } else if ($sensor_value <= 1680) {
        $p = "42.9";
    } else if ($sensor_value <= 2080) {
        $p = "28.6";
    } else if ($sensor_value >= 2255) {
        $p = "14";
    } else if ($sensor_value >= 2170) {
        $p = "14";
    } else {
        echo "0";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RiceDrops</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo1.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/design.css" />
</head>


<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="index.php" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/final2.png" width="210" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>

                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link " style="background-color: #15B097" href="index.php"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Irrigation Mode</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./automatic.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Automatic</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./manual.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Manual</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Stages</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./stage.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Rice Growth Stage</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Water Level</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./moisture.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Water Level</span>
                            </a>
                        </li>
                        <li> <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-success sidebar-item" data-bs-toggle="modal"
                                data-bs-target="#addMoistSensingDeviceModal">
                                <img src="../assets/images/microcontroller.png" height="20px">&nbsp; Add Water Level
                                Indicator
                                Device
                            </button>
                        </li>

                        <!-- Container for displaying added devices -->
                        <div id="deviceList" class="mt-3"></div>
                    </ul>
                </nav>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <br>
                            <h3 class="green-text"><b>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</b>
                            </h3>
                        </li>
                    </ul>

                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="wifiDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-wifi" id="wifiIcon" style="font-size: 25px; color: black;"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up user-dropdown"
                                    aria-labelledby="wifiDropdown">
                                    <div class="message-body">
                                        <p class="user-info">Connect to Wi-Fi</p>
                                        <!-- Line Divider -->
                                        <hr style="margin: 0.5rem 0;">
                                        <form id="wifiForm">
                                            <div class="mb-2">
                                                <label for="ssid" class="form-label">Wi-Fi SSID</label>
                                                <input type="text" class="form-control" id="ssid"
                                                    placeholder="Enter SSID" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="Enter Password" required>
                                            </div>
                                            <button type="submit" class="btn btn-success">Connect</button>
                                        </form>
                                    </div>
                                </div>
                            </li>

                            <script>
                                document.getElementById('wifiForm').addEventListener('submit', function (event) {
                                    event.preventDefault(); // Prevent form submission

                                    // Get values from the input fields
                                    const ssid = document.getElementById('ssid').value;
                                    const password = document.getElementById('password').value;

                                    // Assuming the connection is successful if both fields are filled
                                    if (ssid && password) {
                                        // Update icon color to green when connected
                                        document.getElementById('wifiIcon').classList.remove('wifi-disconnected');
                                        document.getElementById('wifiIcon').classList.add('wifi-connected');
                                    } else {
                                        // Optionally, handle cases where SSID or password is not provided
                                        alert('Please enter both SSID and Password');
                                    }
                                });
                            </script>

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="notificationDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell" id="notificationIcon"
                                        style="font-size: 25px; color: black;"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up user-dropdown"
                                    aria-labelledby="notificationDropdown">
                                    <div class="message-body">
                                        <p class="user-info">Notifications</p>
                                        <!-- Line Divider -->
                                        <hr style="margin: 0.5rem 0;">
                                        <!-- Example notification list -->
                                        <div class="notification-list">
                                            <a href="#" class="dropdown-item">Notification 1</a>
                                            <a href="#" class="dropdown-item">Notification 2</a>
                                            <a href="#" class="dropdown-item">Notification 3</a>
                                            <a href="#" class="dropdown-item">View All Notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </li>




                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/prof.png" alt="" width="35" height="35"
                                        class="rounded-circle">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up user-dropdown"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <?php
                                        // Assuming you have stored user information in session variables
                                        // You can replace these with your actual session variable names
                                        $name = $_SESSION['name'];
                                        $username = $_SESSION['username'];
                                        ?>

                                        <p class="user-info"><span class="label">Name:</span> <?php echo $name; ?></p>
                                        <p class="user-info"><span class="label">Email:</span>
                                            <?php echo $username; ?></p>
                                        <a href="authentication-login.php"
                                            class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid" style="background-color: #dfebe3">
                <div class="card">
                    <div class="card-header bg-green1">
                        <h1 class="card-title fw-semibold text-white mb-0"><b>Water Irrigation Status</b></h1>
                    </div>
                    <!-- Content for the second additional card -->
                    <div class="card-body">
                        <!-- Water Irrigation Status -->
                        <div class="mt-3">
                            <h3 class="fw-bold mb-3" style="color: #2E4738; font-weight: bold;"><b>
                                    <?php
                                    $sql = "SELECT * FROM `relay` WHERE 1";
                                    $result = $conn->query($sql);

                                    // Check if any rows are returned
                                    if ($result->num_rows > 0) {
                                        // Fetch the row(s)
                                        $row = $result->fetch_assoc();

                                        // Assuming you have a column like 'relay_status' to indicate if the irrigation is on (1) or off (0)
                                        if ($row['relay_status'] == 1) {
                                            echo "Irrigation Progress is On...";
                                        } else {
                                            echo "Irrigation Progress is Off...";
                                        }
                                    } else {
                                        echo "No data found in the relay table.";
                                    }

                                    $conn->close();
                                    ?>
                                </b></h3>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%;"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar">0%
                                </div>
                            </div>
                            <p class="mt-2" id="irrigationStatus">
                            <h5>Water is off</h5>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-green1 ">
                                <h5 class="card-title fw-semibold text-white mb-0">Water Level</h5>
                            </div>
                            <!-- Content for the first additional card -->
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="progress-circle" data-percentage="<?php echo $p ?>">
                                        <svg class="progress-svg" viewBox="0 0 200 200">
                                            <circle class="progress-circle-bg" cx="100" cy="100" r="80"></circle>
                                            <circle class="progress-circle-bar" cx="100" cy="100" r="80"></circle>
                                        </svg>
                                        <span class="progress-text"><?php echo $p ?></span>
                                    </div>
                                    <!-- <p id="moistureMessage"></p> -->
                                    <!-- <h2><strong>Percentage:</strong> <?php echo $p; ?></h2> -->
                                    <p><strong>Latest sensor value:</strong> <?php echo $sensor_value; ?>&nbsp;cm</p>
                                    <p><strong>Status:</strong> <?php echo $status; ?></p>
                                    <p><strong>Timestamp:</strong> <?php echo $timestamp; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-green1">
                                <h5 class="card-title fw-semibold text-white mb-0">Rice Growth Stage</h5>
                            </div>
                            <!-- Content for the second additional card -->
                            <div class="card-body">
                                <p><strong>Rice Field Name:</strong> Basmati rice</p>
                                <p><strong>Square Meter:</strong> 1000</p>
                                <p><strong>Rice Variance:</strong> Long Grain</p>
                                <p><strong>Date Starter Planted:</strong> 2024-05-03</p>
                                <p><strong>Growth Stage:</strong> ripening</p>
                                <p><strong>Sub Stage Stage:</strong> grainfilling</p>
                                <p><strong>Date Harvested:</strong> Sat Aug 03 2024</p>
                                <p><strong>Soil Moisture Percentage:</strong> 70%</p>
                                <p><strong>Water Irrigation:</strong> Off</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addMoistSensingDeviceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Moist Sensing Device</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding device -->
                            <form id="addDeviceForm">
                                <div class="mb-3">
                                    <label for="deviceName" class="form-label">Device Name</label>
                                    <input type="text" class="form-control" id="deviceName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deviceId" class="form-label">Device ID</label>
                                    <input type="text" class="form-control" id="deviceId" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deviceType" class="form-label">Device Type</label>
                                    <select class="form-select" id="deviceType" required>
                                        <option value="MoistSensor">Moist Sensor ESP32</option>
                                        <option value="ControlDevice">Control Device ESP32</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="addDevice()">Add Device</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Function to add device
                function addDevice() {
                    var deviceName = document.getElementById('deviceName').value;
                    var deviceId = document.getElementById('deviceId').value;
                    var deviceType = document.getElementById('deviceType').value;

                    // Create device element
                    var deviceElement = document.createElement('div');
                    deviceElement.classList.add('device-card');
                    deviceElement.innerHTML = `
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="${deviceId}">
                <label class="form-check-label" for="${deviceId}">
                    ${deviceName} (${deviceId}) - ${deviceType}
                </label>
            </div>
            <span class="delete-device-btn" onclick="deleteDevice(this)">
                <i class="fas fa-trash-alt"></i>
            </span>
        `;

                    // Append device element to the device list
                    document.getElementById('deviceList').appendChild(deviceElement);

                    // Clear form fields
                    document.getElementById('addDeviceForm').reset();

                    // Display saved device
                    document.getElementById('savedDevice').innerHTML = `Saved Device: ${deviceName} (${deviceId}) - ${deviceType}`;
                }

                // Function to delete device
                function deleteDevice(element) {
                    element.parentElement.remove();
                }
            </script>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>




    <script>
        // Function to update the progress circle and moisture message
        function updateMoisture(percentage) {
            const circleBar = document.querySelector('.progress-circle-bar');
            const progressText = document.querySelector('.progress-text');
            const moistureMessage = document.getElementById('moistureMessage');

            // Calculate the circumference of the circle
            const circumference = 2 * Math.PI * parseFloat(circleBar.getAttribute('r'));

            // Calculate the dash offset based on the percentage
            const dashOffset = circumference * (1 - (percentage / 100));

            // Set the stroke-dasharray and stroke-dashoffset properties
            circleBar.style.strokeDasharray = `${circumference}, ${circumference}`;
            circleBar.style.strokeDashoffset = dashOffset;

            progressText.textContent = percentage + '%';

            // Update moisture message based on percentage
            if (percentage < 30) {
                moistureMessage.textContent = 'Soil moisture is low.';
            } else if (percentage >= 30 && percentage <= 70) {
                moistureMessage.textContent = 'Soil moisture is moderate.';
            } else {
                moistureMessage.textContent = 'Soil moisture is high.';
            }
        }

        // Get the initial percentage from the data attribute and update
        const initialPercentage = parseInt(document.querySelector('.progress-circle').getAttribute('data-percentage'));
        updateMoisture(initialPercentage);
    </script>
</body>

</html>