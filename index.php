<?php
include 'pages/dbconnect.php';
//session_start();
if (!isset($_SESSION['login'])) 
    header('location: pages/Login.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $content = $_POST["postContent"];
    $image = $_FILES["image"];

    // Check if file was uploaded without errors
    if ($image['error'] == UPLOAD_ERR_NO_FILE) {
        // No file uploaded, insert only content
        $sql = "INSERT INTO post(content) VALUES(?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $content);
        
        if ($stmt->execute()) {
            echo "<script>alert('Post created successfully');</script>";
          }
        else {
            echo "<script>alert('Some error occurred');</script>";
          }
        $stmt->close();
    }
    else{
    
    if ($image['error'] == UPLOAD_ERR_OK) {
      // Check if file was uploaded without errors
      if ($image['error'] == 0) {
        $imageName = basename($image['name']);
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageType = pathinfo($imageName, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($imageType, $allowedTypes)) {
            // Create a unique name for the file
            $newImageName = uniqid() . "." . $imageType;

            // Define the upload path
            $uploadPath = 'uploads/' . $newImageName;

            // Move the uploaded file to the destination
            if (move_uploaded_file($imageTmpName, $uploadPath)) {
                // Insert data into the database
                $sql = "INSERT INTO post(content, post_pic) VALUES (?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ss", $content, $uploadPath);

                if ($stmt->execute()) {
                    echo "<script>alert('Post created successfully!');</script>";
                } else {
                    echo "<script>alert('Error: " . $sql . "<br>');</script>" . $con->error;
                }

                $stmt->close();
            } else {
                echo "<script>alert('Failed to move uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        }
    } else {
        echo "<script>alert('File upload error.');</script>";
    }
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
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
  <style>
    /* Custom styles */
    .navbar-custom {
      background-color: #b3e5fc; /* Light blue color */
      padding: 1rem 2rem; /* Increased padding */
      font-size: 18px; /* Increased font size */
    }
    .navbar-nav .form-control {
      margin-right: 10px; /* Add margin to the right of the search bar */
    }
    body {
      font-family: 'Poppins', sans-serif; /* Apply Poppins font to the entire document */
    }
    .sticky-sidebar {
      position: fixed;
      top: 80px; /* Adjust top position according to navbar height */
      left: 0;
      bottom: 0;
      padding-top: 20px; /* Add padding to the top */
      background-color: #f8f9fa; /* Sidebar background color */
    }
    .sidebar-link {
      border: 1px solid #b3e5fc; /* Button-like border */
      border-radius: 5px; /* Rounded corners */
      padding: 8px 16px; /* Padding */
      margin-bottom: 10px; /* Add space between links */
      display: block; /* Make links block elements */
      text-decoration: none; /* Remove underline */
      color: #333; /* Link color */
    }
    .sidebar-link:hover {
      background-color: #b3e5fc; /* Background color on hover */
    }
    #logout .sidebar-link:hover {
      background-color: #cc3737; /* Background color on hover */
    }
    .main-content {
      margin-left: 350px; 
      padding-right: 40px;
    }
    .right-sidebar {
      position: fixed;
      top: 80px; /* Adjust top position according to navbar height */
      right: 0;
      bottom: 0;
      padding-top: 20px; /* Add padding to the top */
      background-color: #f8f9fa; /* Sidebar background color */
    }
    .card{
      margin-top: 10px;
    }
  </style>
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-light navbar-custom">
  <a class="navbar-brand" href="#"><h3>StudiSol</h3></a>
  

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-lg-3 sticky-sidebar">
      <ul class="nav flex-column">
        <li class="nav-item" >
          <?php
          if($_SESSION['role']=="Student")
          {
            echo '<a class="nav-link sidebar-link" href="#createPostModal" data-toggle="modal" data-target="#createPostModal">Create Post</a>';
          }
          ?>
        </li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#">Explore</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#">Notifications</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#">My Account</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="#">Settings</a></li>
        <li class="nav-item"><a class="nav-link sidebar-link" href="pages/Logout.php" id="logout">Log Out</a></li>
      </ul>
    </nav>
    

      </div>
    </div>
  </div>
       <main role="main" class="container mt-4">
        <div class="row">
            <div class="col-lg-7 main-content">
                <div id="postsContainer">
                    <?php
                    $sql = "SELECT content, post_pic, created_at FROM post ORDER BY created_at DESC";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $content = htmlspecialchars($row['content']);
                            $postPic = htmlspecialchars($row['post_pic']);
                            $timestamp = htmlspecialchars($row['created_at']);
                            $formattedTime = date('F j, Y, g:i a', strtotime($timestamp));
                            
                            echo '<div class="card mb-3">';
                            if (!empty($postPic)) {
                                echo '<img src="' . $postPic . '" class="card-img-top">';
                            }
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Post</h5>';
                            echo '<p class="card-text">' . $content . '</p>';
                            echo '<p class="card-text"><small class="text-body-secondary">' . $formattedTime . '</small></p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No posts found.</p>';
                    }?>
                </div>
            </div>
        </div>
    </main>

      <div class="container-fluid">
        <div class="row">
      <nav class="col-lg-2 right-sidebar">
        
        <ul class="nav flex-column">
          
          <li class="nav-item"><a class="nav-link sidebar-link" href="#">Trending</a></li>
          <li class="nav-item"><a class="nav-link sidebar-link" href="#">Friends</a></li>
          <li class="nav-item"><a class="nav-link sidebar-link" href="#">Groups</a></li>
          <li class="nav-item"><a class="nav-link sidebar-link" href="#">Pages</a></li>
        </ul>
      </nav>
        </div></div>
  </div>
</div>

<!-- Bootstrap JS (optional) -->
 <!-- The Modal -->
  <div class="modal fade" id="createPostModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create a New Post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <form id="createPostForm" action="index.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
              <label for="postContent">Content:</label>
              <textarea class="form-control" id="postContent" name="postContent" rows="5" required></textarea>
            </div>
            <div class="form-group">
              <label for="postTitle">Add Image:</label>
                <input type="file" name="image" id="image">
            </div>
          </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="createPostForm" class="btn btn-primary">Post</button>
        </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!--script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>