<?php
$err = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $fullname = $_POST["FullName"];
    $city = $_POST["City"];
    $enroll = $_POST["EnRoll"];
    $college = $_POST["College"];
    $course = $_POST["Course"];
    $branch = $_POST["Branch"];
    $sem = $_POST["Sem"];
    $mobile = $_POST["Mobile"];
    $email_1 = $_POST["email_1"];
    $pass = $_POST["pass"];
    $cpass = $_POST["Cpass"];



   // Function to check if email is already registered
function isEmailRegistered($email_1, $con) {
  $sql = "SELECT * FROM student_user WHERE email = '$email_1'";
  $result = $con->query($sql);
  return $result->num_rows > 0;
}

// Function to check if mobile number is already registered
function isMobileNumberRegistered($mobile, $con) {
  $sql = "SELECT * FROM student_user WHERE mobile_no = '$mobile'";
  $result = $con->query($sql);
  return $result->num_rows > 0;
}
// Function to check if enrollment number is already registered
function isEnrollmentNumberRegistered($enroll, $con) {
  $sql = "SELECT * FROM student_user WHERE enrollment = '$enroll'";
  $result = $con->query($sql);
  return $result->num_rows > 0;
}

if (isEmailRegistered($email_1, $con)) {
  echo "This email is already registered.";
}
elseif (isMobileNumberRegistered($mobile, $con)) {
  echo "This mobile number is already registered.";
}
elseif (isEnrollmentNumberRegistered($enroll, $con)) {
  echo "This enrollment number is already registered.";
}
elseif($pass != $cpass) {
  echo "Passwords doesn't match, please check your password..........";
}
else{
  $hash = password_hash($pass, PASSWORD_BCRYPT);
        $sql = "INSERT INTO student_user (fullname,city,enrollment,college,course,branch,sem,mobile_no,email,pass)
         VALUES ('$fullname', '$city','$enroll','$college','$course','$branch','$sem','$mobile','$email_1','$hash')";
        $result = mysqli_query($con, $sql);
        header('location: login.html');
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
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   </head>
<body>
    <div class="main">
      <form action="RegisterStudent.php" method="post">
        <div class="div-1">
          <div class="div-2">
            <h2>Sign Up as a Student</h2>
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Full Name :</h5>
            </div>
            <input
              type="type"
              class="input"
              placeholder="Full Name"
              id="fullname"
              name="FullName"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>City :</h5>
            </div>
            <input
              type="text"
              class="input"
              placeholder="Current city"
              id="city"
              name="City"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Enrollment No. / Roll No. :</h5>
            </div>
            <input
              type="text"
              class="input"
              placeholder="Enrollment/Roll"
              id="enr"
              name="EnRoll"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>College/School Name:</h5>
            </div>
            <input
              type="text"
              class="input"
              placeholder="College/School name"
              id="college"
              name="College"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Course Name:</h5>
            </div>
            <input
              type="text"
              class="input"
              placeholder="Ex. B.E , B.Com , MBA"
              id="course"
              name="Course"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Branch/Specialization Name:</h5>
            </div>
            <input
              type="text"
              class="input"
              placeholder="Ex. Computer Engineering, HR, Finance"
              id="branch"
              name="Branch"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Current Sem/Standard:</h5>
            </div>
            <input
              type="number"
              class="input"
              placeholder="sem/std"
              id="sem"
              name="Sem"
              min="1" 
              max="12"
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
              id="mobile"
              name="Mobile"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Email :</h5>
            </div>
            <input
              type="email"
              class="input"
              placeholder="Email address"
              name="email_1"
              id="email_1"
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
              name="pass"
              id="pass"
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Confirm Password :</h5>
            </div>
            <input
              type="password"
              class="input"
              placeholder="Confirm password"
              id="cpass"
              name="Cpass"
            />
          </div>
          <p id="message"></p>
          <div class="div-4">
            <button id="signupstud" type="submit">Sign Up</button>
          </div>
        </form>
          <div class="div-6">
            <p>
              Already have an account with us?
              <a href="Login.html" style="text-decoration:none"><span id="login">Log In</span></a>
            </p>
          </div>
        </div>
      </div>


      <script src="../js/register.js"></script>
</body>
</html>