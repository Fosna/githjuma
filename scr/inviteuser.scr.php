<?php
  if (!isset($_POST['inviteuser-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $group = mysqli_real_escape_string($conn, $_POST['groupname']);
    $inviter = mysqli_real_escape_string($conn, $_POST['inviter']);
    $invited_user = mysqli_real_escape_string($conn, $_POST['invited_user']);

      $sql = "INSERT INTO hjuma_groupinvites (invited_user, group_invite, inviter) VALUES (?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"sss", $invited_user,$group,$inviter );
        mysqli_stmt_execute($stmt);
      }
      header("Location: ../group");

  }
