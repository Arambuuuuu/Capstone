<?php
// Include the database connection
include ('../DB_Connection/connection.php');

// Start session
session_start();

// Define variables to hold error messages
$usernameErr = $passwordErr = $userExistsErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // Validate username and password
  if (empty($username)) {
    $usernameErr = "Username is required";
  }
  if (empty($password)) {
    $passwordErr = "Password is required";
  }

  // If no errors, proceed to authenticate user
  if (empty($usernameErr) && empty($passwordErr)) {
    // Query the database to check if the username exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      // Username exists, fetch the password and user name
      $row = $result->fetch_assoc();
      $stored_password = $row['password'];
      $user_name = $row['name']; // Assuming there's a 'name' column in your 'users' table

      // Verify the password
      if (password_verify($password, $stored_password)) {
        // Password matches, start session and redirect to index.php
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user_name; // Store user's name in session
         header("Location: index.php");
        exit;
      } else {
        // Password doesn't match, display error message
        $passwordErr = "Invalid password";
      }
    } elseif ($result->num_rows > 1) {
      // Multiple users found with the same username
      $userExistsErr = "Multiple users found with the same username. Please contact support.";
    } else {
      // Username doesn't exist, display error message
      $usernameErr = "Username not found";
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
                <h2><b>Sign in</b></h2>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      name="username" placeholder="Enter your email" required>
                    <span class="text-danger"><?php echo $usernameErr; ?></span>
                    <span class="text-danger"><?php echo $userExistsErr; ?></span>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                      placeholder="Enter your password" required>
                    <span class="text-danger"><?php echo $passwordErr; ?></span>
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPasswordCheckbox">
                    <label for="showPasswordCheckbox" class="form-check-label">Show Password</label>
                  </div>
                  <button type="submit" class="btn btn-success w-100 py-2 fs-5 mb-4 rounded-2">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-5 mb-0 fw-bold">Doesn't have account?</p>
                    <a class="text-primary fw-bold ms-2" href="authentication-register.php">Create an account</a>
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
    const passwordInput = document.getElementById('exampleInputPassword1');
    const showPasswordCheckbox = document.getElementById('showPasswordCheckbox');
    showPasswordCheckbox.addEventListener('change', function () {
      if (this.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  </script>
</body>

</html>
