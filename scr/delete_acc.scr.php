<?php
require 'dbh.scr.php';
session_start();
$user_id = $_SESSION['id'];
$sql = "DELETE FROM hjuma_users WHERE id=?;";
  $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      die("sql error");
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
      mysqli_stmt_execute($stmt);
      $sql2 = "DELETE FROM hjuma_joined_challenges WHERE joined_user=?;";
  $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)){
      die("sql error");
    }
    else {
        mysqli_stmt_bind_param($stmt2, "s", $user_id);
      mysqli_stmt_execute($stmt2);
      $sql3 = "DELETE FROM hjuma_joined_groups WHERE joined_user=?;";
  $stmt3 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt3, $sql3)){
      die("sql error");
    }
    else {
        mysqli_stmt_bind_param($stmt3, "s", $user_id);
      mysqli_stmt_execute($stmt3);
      $sql4 = "DELETE FROM hjuma_requested_groups WHERE requested_user=?;";
      $stmt4 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt4, $sql4)){
          die("sql error");
        }
        else {
            mysqli_stmt_bind_param($stmt4, "s", $user_id);
          mysqli_stmt_execute($stmt4);
          session_destroy();
          header("Location: ../hjuma");
      
    }
      
    }
      
    }
}