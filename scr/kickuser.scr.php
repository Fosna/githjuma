<?php
if (!isset($_POST['kickuser_submit'])) {
    exit();
}else{
    require 'dbh.scr.php';
    session_start();
    $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
    $kicked_user_id = mysqli_real_escape_string($conn, $_POST['kicked_user']);
    $sql = "DELETE  FROM hjuma_joined_challenges WHERE joined_user = ? AND joined_challenge = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "a";
      echo $kicked_user_id;
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $kicked_user_id, $challenge_id);
      mysqli_stmt_execute($stmt);
    }
      header("Location: ../challenge_info?c=$challenge_id");
}