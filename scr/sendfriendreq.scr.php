<?php
  if (!isset($_POST['inviteuser-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $sender = mysqli_real_escape_string($conn, $_POST['sender']);
    $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);

      $sql = "INSERT INTO hjuma_friendrequests (sender, receiver) VALUES (?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"ss", $sender, $receiver);
        mysqli_stmt_execute($stmt);
      }
      header("Location: ../friends");

  }
