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
    .progress-circle {
        position: relative;
        width: 120px;
        height: 120px;
    }

    .progress-circle svg {
        transform: rotate(-90deg);
    }

    .progress-circle circle {
        fill: none;
        stroke: #ddd;
        stroke-width: 10;
        stroke-linecap: round;
    }

    .progress-circle .progress {
        fill: none;
        stroke: #007bff;
        /* Primary color */
        stroke-width: 10;
        stroke-linecap: round;
        animation: progress-animation 2s ease forwards;
    }

    .progress-circle .percentage {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 18px;
        color: #007bff;
        /* Primary color */
    }

    @keyframes progress-animation {
        to {
            stroke-dashoffset: calc(350 - (350 * var(--percent)) / 100);
        }
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
            <!--  Header End -->
            <div class="container-fluid">
                <div class="row">
                    <!-- First pair of cards -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title fw-semibold text-white mb-0">Soil Moisture 1</h5>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <!-- Circular Progress Loading -->
                                <div class="progress-circle" data-percent="70">
                                    <svg viewBox="0 0 120 120">
                                        <circle cx="60" cy="60" r="55"></circle>
                                        <circle cx="60" cy="60" r="55" class="progress"></circle>
                                    </svg>
                                    <div class="percentage">70%</div>
                                </div>

                                <!-- Content for the first card -->
                            </div>
                            <h5 class="text-center mt-3 mb-3">Soil Moisture is Moderate</h5>
                        </div>

                    </div>

                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title fw-semibold text-white mb-0">Soil Moisture 2</h5>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <!-- Circular Progress Loading -->
                                <div class="progress-circle" data-percent="45">
                                    <svg viewBox="0 0 120 120">
                                        <circle cx="60" cy="60" r="55"></circle>
                                        <circle cx="60" cy="60" r="55" class="progress"></circle>
                                    </svg>
                                    <div class="percentage">45%</div>
                                </div>
                                <!-- Content for the second card -->
                            </div>
                            <h5 class="text-center mt-3 mb-3">Soil Moisture is Moderate</h5>
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

</body>



</html>