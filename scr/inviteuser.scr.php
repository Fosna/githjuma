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

      $sql = "INSERT INTO hjuma_groupinvites (invited_user, group_invite, inviter) VALUES ('$invited_user', '$group','$inviter')";
          if ($conn->query($sql)){
            header("Location: ../group");
            $conn->close();
          }
  }
