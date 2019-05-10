<?php
  if (!isset($_POST['createevent-submit'])) {
    exit();
  }
  else{ 
    require 'dbh.scr.php';
    session_start();
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $place = mysqli_real_escape_string($conn, $_POST['place']);
    $file = $_FILES['avatar']['tmp_name'];
    $image = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
    $image_name =addslashes($_FILES['avatar']['tmp_name']);
    $image_size = getimagesize($_FILES['avatar']['tmp_name']);
    $owner = $_SESSION['username'];
    $date = mysqli_real_escape_string($conn, $_POST['date_time']);
    if (empty($name) || empty($description) || empty($date)){
      header("Location: ../createevent?error=empty");
      exit();
    }
    else {
      $sql = "INSERT INTO hjuma_events (name, description, category, place, date_time, imagename, image, owner) VALUES (?, ?, ?, ?, ?, ?, '$image', ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"sssssss", $name, $description, $category, $place, $date, $image_name, $owner);
        mysqli_stmt_execute($stmt);
        header("Location: ../events");
      }
    }
  }