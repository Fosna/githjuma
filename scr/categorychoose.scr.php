<?php
  if (!isset($_POST['category-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $sql = "SELECT * FROM hjuma_groups WHERE category=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $category);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    }
    header("Location: ../main?category=$category");
}
