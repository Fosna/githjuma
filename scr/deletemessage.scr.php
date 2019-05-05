<?php
  if (!isset($_POST['deletemessage-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $user = $_SESSION['username'];
    $sender = mysqli_real_escape_string($conn, $_POST['sender']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $sql = "DELETE FROM hjuma_messages WHERE message = ? AND sender_name = ? AND date_time =?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"sss", $message, $sender, $time);
      mysqli_stmt_execute($stmt);
    }
      header("Location: ../group");
}
