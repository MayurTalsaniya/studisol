<?php 
include 'dbconnect.php';
    $login=false;
    $user=false;

    //var_dump($_POST);
    if(isset($_POST['submit']))
    {
      $dropDownVal = $_POST["role"];
      switch ($dropDownVal) {
        case "Student":
            $user = "student_user"; // Replace with actual student table name
            break;
        case "Viewer":
            $user = "user"; // Replace with actual faculty table name
            break;
        default:
            echo "Invalid role selected";
            exit; // Stop script execution
    }
      
        $result = mysqli_query($con, "select * from $user where email='$_POST[email]'");
        //echo "Error: " . mysqli_error($con);
        if(mysqli_num_rows($result) == 1)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                //var_dump($row);
                if(password_verify($_POST['passwd'],$row['passwd']))
                {
                $_SESSION['log_in'] = true;
                $_SESSION['role'] = $dropDownVal;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user'] = $row['fullname'];
                header('location: ../index.html');
                exit;
                }
                else
                {
                        echo "Invalid Credentials";
                }
            }
        }   
        else
        {
                echo "Email not found";
        }
    }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudiSol</title>
    <link rel="stylesheet" href="../style/login.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

</head>
<body>
    <div class="main">
        <form action="Login.php" method="post"><div class="div-1">
          <div class="div-2">
            <h2>Log In to StudiSol</h2>
          </div>
          <div class="role">
            <h4>Are you a:</h4>
            <select name="role" id="role">
                <option value="Student">Student</option>
                <option value="Viewer">Viewer</option>
            </select>                
          </div>
           <div class="div-3">
            <div class="div-h3">
              <h4>Email :</h4>
            </div>
            <input
              type="email"
              class="input"
              placeholder="Enter your email"
              name="email"
              id="email"
              required
            />
          </div>
          <div class="div-3">
            <div class="div-h3">
              <h4>Password :</h4>
            </div>
            <input
              type="password"
              class="input"
              placeholder="Enter your password"
              name="passwd"
              id="passwd"
              required
            />
          </div>
          
          <p id="message"></p>
          <div class="div-4">
            <button id="login" type="submit" name="submit" >Log In</button>
          </div>
        </form>
          <div class="div-5">
            <h4>Forgot Password?</h4>
          </div>
          <div class="div-6">
            <p>
              Don't have an account with StudiSol?<br><br>
              <a href="RegisterStudent.php" style="text-decoration:none"><span id="signupstud"> Sign up as a Student</span></a>
              <br><br>
              <a href="Register.php" style="text-decoration:none"><span id="signup"> Sign up as a Viewer</span></a>
            </p>
          </div>
        </div>
      </div>

      
</body>
</html>