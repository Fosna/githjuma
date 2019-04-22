<?php
  if (!isset($_POST['category-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $sql = "SELECT * FROM hjuma_groups WHERE category='$category'";
    if ($conn->query($sql)){
      header("Location: ../main?category=$category");
      $conn->close();
    }
}
