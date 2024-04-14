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
        <form action="#" method="post"><div class="div-1">
          <div class="div-2">
            <h2>Log In to StudiSol</h2>
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
              name="email"
              id="password"
            />
          </div>
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
   
      <script src="../js/login.js"></script>
</body>
</html>