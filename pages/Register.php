<?php
$err = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobileno = $_POST["mobileno"];
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    $repass = $_POST["repass"];


// Function to check if email is already registered
function isEmailRegistered($email, $con) {
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $con->query($sql);
    return $result->num_rows > 0;
  }
  // Function to check if mobile number is already registered
function isMobileNumberRegistered($mobileno, $con) {
    $sql = "SELECT * FROM user WHERE mobileno = '$mobileno'";
    $result = $con->query($sql);
    return $result->num_rows > 0;
  }

  if (isEmailRegistered($email, $con)) {
    echo "This email is already registered.";
  }
  elseif (isMobileNumberRegistered($mobileno, $con)) {
    echo "This mobile number is already registered.";
  }
  else{

    $hash = password_hash($passwd, PASSWORD_BCRYPT);
          $sql = "INSERT INTO user (fname,lname,mobileno,email,passwd)
           VALUES ('$fname', '$lname','$mobileno','$email','$hash')";
          $result = mysqli_query($con, $sql);
          header('location: login.php');
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudiSol</title>
    <link rel="stylesheet" href="../style/register.css">
    </head>
<body>
    <div class="main">
      <form action="Register.php" method="post">
        <div class="div-1">
          <div class="div-2">
            <h2>Sign Up as a Viewer</h2>
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>First Name :</h5>
            </div>
            <input
              type="type"
              class="input"
              placeholder="First Name"
              id="fname"
              name="fname"
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Last Name :</h5>
            </div>
            <input
              type="type"
              class="input"
              placeholder="Last Name"
              id="lname"
              name="lname"
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Mobile Number :</h5>
            </div>
            <input
              type="text"
              class="input"
              placeholder="Mobile number"
              id="mobileno"
              name="mobileno"
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Email Address :</h5>
            </div>
            <input
              type="email"
              class="input"
              placeholder="Email Address"
              name="email"
              id="email"
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Password :</h5>
            </div>
            <input
              type="password"
              class="input"
              placeholder="Password"
              name="passwd"
              id="passwd"
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Re-Enter Password :</h5>
            </div>
            <input
              type="password"
              class="input"
              placeholder="Re-Enter Password"
              id="repass"
              name="repass"
              required
            />
          </div>
          <p id="message"></p>
          <div class="div-4">
            <button id="signup" type="submit">Sign Up</button>
          </div>
      </form>
          <div class="div-6">
            <p>
                Already have an account with us?
              <a href="Login.php" style="text-decoration:none"><span id="login">Log In</span></a>
            </p>
          </div>
        </div>
      </div>


      <script src="../js/register.js"></script>
  
</body>
</html>