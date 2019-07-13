<?php 
if (!isset($_POST['delete_challenge-submit'])) {
    exit();
}elseif (isset($_POST['delete_challenge-submit'])) {
  require 'dbh.scr.php';

  $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);

  $sql = "DELETE FROM hjuma_challenges WHERE challenge_id=?;";
  $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      die("sql error");
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $challenge_id);
      mysqli_stmt_execute($stmt);
      $sql = "DELETE FROM hjuma_joined_challenges WHERE joined_challenge=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        die("sql error");
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $challenge_id);
        mysqli_stmt_execute($stmt);
      }
      header("Location: ../main");
      exit();
    }
}