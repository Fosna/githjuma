<?php
if (!isset($_POST['deletepost-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $postname = mysqli_real_escape_string($conn, $_POST['postname']);
  $owner = mysqli_real_escape_string($conn, $_POST['postowner']);
  $date = mysqli_real_escape_string($conn, $_POST['date_time']);

  if (!isset($_SESSION['id'])) {
    header("Location: ../login");
  }
  else{
    $sql = "DELETE FROM hjuma_comments WHERE grouppost = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"s", $postname);
      mysqli_stmt_execute($stmt);
    }
    $sql1 = "DELETE FROM hjuma_posts WHERE title = ? AND owner =? AND date_time =?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"sss", $postname, $owner, $date);
      mysqli_stmt_execute($stmt);
    }
      header("Location: ../group");

  }
}
