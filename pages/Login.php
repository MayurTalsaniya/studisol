<?php 
include 'dbconnect.php';
    $login=false;
    $user=false;
    if(isset($_POST['submit']))
    {
      if($_POST["user_type"]=="student"){
        $user = "student_user";
      }
      else{
        $user = "user";
      }
      
        $result=mysqli_query($con,"select * from $user where email='$_POST[email]'");
        
        if(mysqli_num_rows($result) == 1)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                // var_dump($row);
                if(password_verify($_POST['passwd'],$row['passwd']))
                {
                $_SESSION['login'] = true;
                $_SESSION['userid'] = $row['id'];
                $_SESSION['user'] = $row['fullname'];
                header('location: ../index.html');
                }
                else
                {
                        echo "Invalid Credentials";
                }
            }
        }   
        else
        {
                echo "Invalid Credentials";
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
          <div class="rdbtn">
             <h4>Are you a:</h4>
                  <input type="radio" name="user_type" value="student" onclick="getValue()" required>Student
                  <input type="radio" name="user_type" value="viewer" onclick="getValue()">Viewer
                
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
          <input type="hidden" name="user_type" id="user_type_hidden" value="">
          <p id="message"></p>
          <div class="div-4">
            <button id="login" type="submit" >Log In</button>
          </div>
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
      <script>
        function getValue(){
          var radios = document.querySelector('input[name="user_type"]:checked').value;
          document.getElementById('user_type_hidden').value = userType;
      }
</script>
      
</body>
</html>