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
        .bg-green1{
        background-color: #15B097;
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

                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="../assets/images/profile/prof.png" alt="" width="35" height="35"
                                        class="rounded-circle">
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Container for the Cards -->
            <div class="container-fluid">
                <!-- Row for the first two cards -->
                <div class="row">
                    <!-- Ricefield Card -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-green1">
                                <h5 class="card-title fw-semibold text-white mb-0">Ricefield</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="ricefieldName" class="form-label">Rice Field Name</label>
                                        <input type="text" class="form-control" id="ricefieldName"
                                            placeholder="Enter name of rice field">
                                    </div>
                                    <div class="mb-3">
                                        <label for="squareMeter" class="form-label">Square Meter</label>
                                        <input type="number" class="form-control" id="squareMeter"
                                            placeholder="Enter square meter of rice field">
                                    </div>
                                    <div class="mb-3">
                                        <label for="riceVariance" class="form-label">Rice Variance</label>
                                        <select class="form-select" id="riceVariance">
                                            <option selected>Select rice variance</option>
                                            <option value="Long Grain">Long Grain</option>
                                            <option value="Short Grain">Short Grain</option>
                                            <option value="Basmati">Basmati</option>
                                            <option value="Jasmine">Jasmine</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Rice Growth Stage Card -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-green1">
                                <h5 class="card-title fw-semibold text-white mb-0">Rice Growth Stage</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="dateInput" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="dateInput">
                                    </div>
                                    <div class="mb-3">
                                        <label for="growthStageSelect" class="form-label">Growth Stage</label>
                                        <select class="form-select" id="growthStageSelect" onchange="updateSubStages()">
                                            <option value="" selected disabled>Select Growth Stage</option>
                                            <option value="vegetative">Vegetative</option>
                                            <option value="reproductive">Reproductive</option>
                                            <option value="ripening">Ripening</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subStageSelect" class="form-label">Sub Stage</label>
                                        <select class="form-select" id="subStageSelect">
                                            <option value="" selected disabled>Select Sub Stage</option>
                                        </select>
                                    </div>
                                </form>

                                <script>
                                    function updateSubStages() {
                                        var growthStageSelect = document.getElementById("growthStageSelect");
                                        var subStageSelect = document.getElementById("subStageSelect");

                                        // Clear existing options
                                        subStageSelect.innerHTML = '<option value="" selected disabled>Select Sub Stage</option>';

                                        // Define sub stages based on selected growth stage
                                        var subStages = {};
                                        subStages["vegetative"] = ["Seedling", "Tillering"];
                                        subStages["reproductive"] = ["Panicle Initiation", "Heading", "Flowering"];
                                        subStages["ripening"] = ["Grain Filling", "Dough", "Mature Grain"];

                                        // Populate sub stage options
                                        var selectedGrowthStage = growthStageSelect.value;
                                        if (selectedGrowthStage in subStages) {
                                            subStages[selectedGrowthStage].forEach(function (subStage) {
                                                var option = document.createElement("option");
                                                option.text = subStage;
                                                option.value = subStage.toLowerCase().replace(/\s/g, ''); // Convert to lowercase and remove spaces
                                                subStageSelect.add(option);
                                            });
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>


                    <!-- Row for buttons -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary" onclick="clearInput()">Saved
                                Stages</button>
                            <button type="button" class="btn btn-danger" onclick="clearAllFields()">Clear All
                                Fields</button>
                        </div>
                    </div>
                </div>

                <!-- Row for the output card -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-green1">
                                <h5 class="card-title fw-semibold text-white mb-0">Output</h5>
                            </div>
                            <div class="card-body" id="output">
                                <!-- Output will be displayed here -->
                            </div>
                        </div>
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

    <script>
        function clearInput() {
            document.getElementById("ricefieldName").value = "";
            document.getElementById("squareMeter").value = "";
            document.getElementById("riceVariance").selectedIndex = 0;
            document.getElementById("dateInput").value = "";
            document.getElementById("growthStageSelect").selectedIndex = 0;
            document.getElementById("subStageSelect").innerHTML = '<option value="" selected disabled>Select Sub Stage</option>';
            document.getElementById("output").innerHTML = ""; // Clear previous output
        }

        function clearAllFields() {
            document.getElementById("ricefieldName").value = "";
            document.getElementById("squareMeter").value = "";
            document.getElementById("riceVariance").selectedIndex = 0;
            document.getElementById("dateInput").value = "";
            document.getElementById("growthStageSelect").selectedIndex = 0;
            document.getElementById("subStageSelect").innerHTML = '<option value="" selected disabled>Select Sub Stage</option>';
            document.getElementById("output").innerHTML = ""; // Clear previous output
        }

        function displayOutput() {
            var ricefieldName = document.getElementById("ricefieldName").value;
            var squareMeter = document.getElementById("squareMeter").value;
            var riceVariance = document.getElementById("riceVariance").value;
            var dateInput = document.getElementById("dateInput").value;
            var growthStage = document.getElementById("growthStageSelect").value;
            var subStage = document.getElementById("subStageSelect").value;

            // Generate output HTML
            var outputHTML = "<p>Rice Field Name: " + ricefieldName + "</p>";
            outputHTML += "<p>Square Meter: " + squareMeter + "</p>";
            outputHTML += "<p>Rice Variance: " + riceVariance + "</p>";
            outputHTML += "<p>Date Started Planted: " + dateInput + "</p>";
            outputHTML += "<p>Growth Stage: " + growthStage + "</p>"; // Display selected growth stage
            outputHTML += "<p>Sub Stage: " + subStage + "</p>"; // Display selected sub stage

            // Logic for Date Harvested
            var dateHarvested = "";
            var currentDate = new Date(dateInput);
            var threeMonthsLater = new Date(currentDate.getFullYear(), currentDate.getMonth() + 3, currentDate.getDate());
            if (currentDate.getMonth() + 3 < 12) {
                dateHarvested = threeMonthsLater;
            } else {
                dateHarvested = new Date(currentDate.getFullYear() + 1, currentDate.getMonth() + 3 - 12, currentDate.getDate());
            }
            outputHTML += "<p>Date Harvested: " + dateHarvested.toDateString() + "</p>";

            // Display water irrigation status
            var moistureLevel = calculateMoistureLevel(subStage); // Assuming you have a function to calculate moisture level
            if (moistureLevel <= 10) {
                outputHTML += "<p>Water irrigation is on</p>";
            } else {    
                outputHTML += "<p>Water irrigation is off</p>";
            }

            // Append output to the output card
            document.getElementById("output").innerHTML = outputHTML;
        }
        function calculateMoistureLevel(subStage) {
            // Logic to calculate moisture level based on sub stage
            var moistureLevels = {
                "seedling": 95,
                "tillering": 90,
                "panicleinitiation": 85,
                "heading": 85,
                "flowering": 85,
                "grainfilling": 85,
                "dough": 70,
                "maturegrain": 55
            };

            return moistureLevels[subStage.toLowerCase()];
        }

        // Call displayOutput function when user clicks Create New Stages button
        function clearInput() {
            displayOutput();
        }

    </script>

</body>

</html>