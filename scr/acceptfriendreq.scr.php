<?php
  if (!isset($_POST['acceptfriend-submit'])) {
    exit();
  }
  else{
    session_start();
    require 'dbh.scr.php';
    $username = $_SESSION['username'];
    $sender = mysqli_real_escape_string($conn, $_POST['sender']);
    $sql = "INSERT INTO hjuma_friends (user1, user2) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"ss", $sender, $username);
      mysqli_stmt_execute($stmt);
    }
    $sql1 = "DELETE FROM hjuma_friendrequests WHERE receiver=? AND sender=? OR receiver=? AND sender=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"ssss", $sender, $username, $username, $sender );
      mysqli_stmt_execute($stmt);
    }
    header("Location: ../friends");
  }