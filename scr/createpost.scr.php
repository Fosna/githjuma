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
    $date = date("Y-m-d g:i:sa");
    if (empty($title) || empty($description)){
      header("Location: ../createpost?error=empty");
      exit();
    }
    else {
      $sql = "INSERT INTO hjuma_posts (title, description, imagename, image, grouppost, comments, owner, date_time) VALUES (?,?, ?, '$image', ?, ? , ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"sssssss", $title,$description, $image_name,  $grouppost, $comments , $postowner, $date);
        mysqli_stmt_execute($stmt);
      }
            header("Location: ../group");

      }
  }
