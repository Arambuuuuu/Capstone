<?php
// Include the database connection
include ('../DB_Connection/connection.php');

// Start session
session_start();

// Define variables to hold error messages
$nameErr = $usernameErr = $passwordErr = $confirmPasswordErr = $userExistsErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate form data
  if (empty($name)) {
    $nameErr = "Name is required";
  }
  if (empty($username)) {
    $usernameErr = "Username is required";
  }
  if (empty($password)) {
    $passwordErr = "Password is required";
  }
  if ($password !== $confirm_password) {
    $confirmPasswordErr = "Passwords do not match";
  }

  // If no errors, proceed to create user
  if (empty($nameErr) && empty($usernameErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
    // Query the database to check if the username exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
      // Username does not exist, proceed to insert new user
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $username, $hashed_password);
      if ($stmt->execute()) {
        // User created successfully, redirect to login page
        header("Location: authentication-login.php");
        exit;
      } else {
        // Error inserting user
        $userExistsErr = "Error creating user. Please try again.";
      }
    } else {
      // Username exists, display error message
      $userExistsErr = "Username already exists";
    }
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
</head>

<style>
  /* CSS for full background rice field */
  .page-wrapper {
    background-image: url('../assets/images/backgrounds/last.png');
    background-size: cover;
    background-position: center;
  }

  /* CSS for hover effect */
  .form-control:hover {
    border-color: lightblue;
    border-width: 4px;
    /* Adjust the thickness as needed */
  }

  .form-group {
    margin-bottom: 1rem;
  }

  .checkbox-label {
    margin-bottom: 0.5rem;
  }

  .show-password-label {
    color: black;
    cursor: pointer;
  }
</style>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
      <div class="container">
        <div class="row">
          <!-- Left Side - Logo or Picture -->
          <div class="col-md-6 d-flex align-items-center justify-content-center">
            <!-- Add your logo or picture here -->
            <img src="../assets/images/logos/last.png" alt="Logo" class="img-fluid">
          </div>
          <!-- Right Side - Form -->
          <div class="col-md-5 align-items-center justify-content-center">
            <div class="card mb-0">
              <div class="card-body">
                <h3><b>Create your Account</b></h3>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                    <span class="text-danger"><?php echo $nameErr; ?></span>
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Email</label>
                    <input type="email" class="form-control" id="username" name="username"
                      placeholder="Enter your email">
                    <span class="text-danger"><?php echo $usernameErr; ?></span>
                    <span class="text-danger"><?php echo $userExistsErr; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                      placeholder="Enter your password">
                    <span class="text-danger"><?php echo $passwordErr; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                      placeholder="Confirm your password">
                    <span class="text-danger"><?php echo $confirmPasswordErr; ?></span>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" id="showPasswordCheckbox">
                    <label for="showPasswordCheckbox" class="checkbox-label show-password-label">Show Password</label>
                  </div>
                  <button type="submit" class="btn btn-success w-100 py-8 fs-4 mb-4 rounded-2">Create Account</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an account?</p>
                    <a class="text-primary fw-bold ms-2" href="authentication-login.php">Sign in</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const showPasswordCheckbox = document.getElementById('showPasswordCheckbox');
    showPasswordCheckbox.addEventListener('change', function () {
      const type = this.checked ? 'text' : 'password';
      passwordInput.type = type;
      confirmPasswordInput.type = type;
    });
  </script>
</body>

</html>