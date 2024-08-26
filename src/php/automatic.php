<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RiceDrops</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<style>
  body .log {
    background: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    height: 200px;
    overflow-y: scroll;
    margin-top: 20px;
  }

  .log-entry {
    border-bottom: 1px solid #eee;
    padding: 5px 0;
  }

  .status {
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
  }

  .status-low {
    background-color: #ffdddd;
    color: #d9534f;
  }

  .status-mid {
    background-color: #fff3cd;
    color: #856404;
  }

  .status-high {
    background-color: #d4edda;
    color: #155724;
  }

  .progress-container {
    margin-top: 20px;
    background: #e9ecef;
    border-radius: 5px;
    overflow: hidden;
  }

  .progress-bar {
    height: 20px;
    background: #28a745;
    width: 0;
  }

  .controls {
    margin: 20px 0;
  }

  .controls button {
    padding: 10px 20px;
    margin-right: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .controls button.start {
    background-color: #007bff;
    color: white;
  }

  .controls button.stop {
    background-color: #dc3545;
    color: white;
  }
</style>

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
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Mode</span>
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
                <i class="ti ti-alert-circle alert-icon"></i>
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
              <span class="hide-menu">Moisture</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./moisture.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Soil Moisture</span>
              </a>
            </li>

        </nav>
        <!-- End Sidebar navigation -->
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
              <a class="nav-link sidebartoggler " id="headerCollapse" href="index.php">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link " href="index.php" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/prof.png" alt="" width="35" height="35" class="rounded-circle">
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header bg-primary ">
              <h5 class="card-title fw-semibold text-white mb-0">Rice Field Irrigation System</h5>
            </div>
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Automatic Mode</h5>
              <button id="startAutoIrrigation" class="btn btn-primary">Start Auto Irrigation</button>
              <button id="stopAutoIrrigation" class="btn btn-danger">Stop Auto Irrigation</button>
              <div id="moistureStatus" class="mt-3"></div>
              <div id="cycleStatus" class="mt-3"></div>
              <div class="progress mt-3">
                <div id="progressBar" class="progress-bar bg-success" role="progressbar" style="width: 0%;"
                  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="d-flex justify-content-between mt-2">
                <div id="percentageDisplay">0%</div>
              </div>
              <div class="log" id="log"></div>
            </div>
          </div>


          <script>
            function detectMoisture() {
              return Math.floor(Math.random() * 3);
            }

            var cycleInterval;
            var progressInterval;
            var logElement = document.getElementById('log');
            var irrigationActive = false;

            function addLog(message) {
              var logEntry = document.createElement('div');
              logEntry.className = 'log-entry';
              logEntry.textContent = new Date().toLocaleTimeString() + ' - ' + message;
              logElement.appendChild(logEntry);
              logElement.scrollTop = logElement.scrollHeight;
            }

            function startAutoIrrigation() {
              document.getElementById("moistureStatus").innerHTML = "Auto irrigation started.";
              document.getElementById("moistureStatus").className = "status status-mid";
              addLog("Auto irrigation started.");
              irrigationActive = true;
              cycleInterval = setInterval(checkMoistureAndIrrigate, 5000);
            }

            function checkMoistureAndIrrigate() {
              var moistureLevel = detectMoisture();
              var moistureStatus;
              var statusClass;
              switch (moistureLevel) {
                case 0:
                  moistureStatus = "Low";
                  statusClass = "status status-low";
                  break;
                case 1:
                  moistureStatus = "Mid";
                  statusClass = "status status-mid";
                  break;
                case 2:
                  moistureStatus = "High";
                  statusClass = "status status-high";
                  break;
              }
              document.getElementById("moistureStatus").innerHTML = "Soil moisture: " + moistureStatus;
              document.getElementById("moistureStatus").className = statusClass;
              addLog("Soil moisture detected: " + moistureStatus);

              if (moistureLevel === 2) {
                addLog("Moisture level is high. Stopping irrigation cycle.");
                document.getElementById("cycleStatus").innerHTML = "Irrigation paused due to high moisture.";
                document.getElementById("cycleStatus").className = "status status-high";
                clearInterval(progressInterval);
                document.getElementById("progressBar").style.width = "0%";
                document.getElementById("percentageDisplay").textContent = "0%";
              } else {
                document.getElementById("cycleStatus").innerHTML = "Cycle in progress...";
                document.getElementById("cycleStatus").className = "status status-mid";
                var progress = 0;
                clearInterval(progressInterval);
                progressInterval = setInterval(function () {
                  progress += 5;
                  document.getElementById("progressBar").style.width = progress + "%";
                  document.getElementById("percentageDisplay").textContent = progress + "%";
                  if (progress >= 100) {
                    clearInterval(progressInterval);
                    document.getElementById("cycleStatus").innerHTML = "Cycle completed.";
                    document.getElementById("cycleStatus").className = "status status-high";
                    addLog("Cycle completed.");
                  }
                }, 300);
              }
            }

            function stopAutoIrrigation() {
              irrigationActive = false;
              clearInterval(cycleInterval);
              clearInterval(progressInterval);
              document.getElementById("moistureStatus").innerHTML = "Auto irrigation stopped.";
              document.getElementById("moistureStatus").className = "status status-low";
              document.getElementById("cycleStatus").innerHTML = "";
              document.getElementById("progressBar").style.width = "0%";
              document.getElementById("percentageDisplay").textContent = "0%";
              addLog("Auto irrigation stopped by user.");
            }

            document.getElementById("startAutoIrrigation").addEventListener("click", startAutoIrrigation);
            document.getElementById("stopAutoIrrigation").addEventListener("click", stopAutoIrrigation);
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
</body>

</html>