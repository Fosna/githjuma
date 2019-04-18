<?php
  if (!isset($_POST['creategroup-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $file = $_FILES['avatar']['tmp_name'];
    $image = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
    $image_name =addslashes($_FILES['avatar']['tmp_name']);
    $image_size = getimagesize($_FILES['avatar']['tmp_name']);
    $grouppost = $_SESSION['groupname'];
    $postowner = $_SESSION['username'];
    if (empty($title) || empty($description)){
      header("Location: ../createpost?error=empty");
      exit();
    }
    else {
      $sql = "INSERT INTO hjuma_posts (title, description, imagename, image, grouppost, comments, owner) VALUES ('$title','$description', '$image_name', '$image', '$grouppost', '$comments' , '$postowner')";
          if ($conn->query($sql)){
            header("Location: ../group");
            $conn->close();
          }
      }
  }
