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
        //header('location: login.html');
}

$last_id = mysqli_insert_id($con);
$targetDirectory = "../IDimages/";
$name = $_POST["FullName"];
$targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$filename = $_FILES["fileToUpload"]["tmp_name"];

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        // update the database with the file path of the uploaded photo
        mysqli_query($con,"UPDATE student_user SET id_img='$filename' where student_user_id='$last_id'") or die(mysqli_error($con));
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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
      <form action="RegisterStudent.php" method="post" enctype="multipart/form-data">
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
              required
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
              required
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
              required
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
              required
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
              required
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
              required
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
              id="mobile"
              name="Mobile"
              required
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
              name="pass"
              id="pass"
              required
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
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h5>Upload School/College ID card :</h5>
            </div>
            <input 
              type="file"
              class="input"
              id="fileToUpload"
              name="fileToUpload"
              accept="image/*"
              required
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
              <a href="Login.php" style="text-decoration:none"><span id="login">Log In</span></a>
            </p>
          </div>
        </div>
      </div>


      <script src="../js/register.js"></script>
</body>
</html>