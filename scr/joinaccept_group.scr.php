<?php
if (!isset($_POST['joinaccept_submit'])) {
  exit();
}else{
    require 'dbh.scr.php';
    session_start();
    $user_id = mysqli_real_escape_string($conn, $_POST['user_request_user_id']);
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
    $sql = "INSERT INTO hjuma_joined_groups (joined_user, joined_group) VALUES (?, ?);";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        die("sql error");
      }
      else {
        mysqli_stmt_bind_param($stmt, "ss", $user_id, $group_id);
        mysqli_stmt_execute($stmt);
        $sql1 = "DELETE FROM hjuma_requested_groups WHERE user_id = ? AND group_id = ?";
        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1, $sql1)){
        }
        else {
            mysqli_stmt_bind_param($stmt1, "ss", $user_id, $group_id);
            mysqli_stmt_execute($stmt1);
            header("Location: ../group_info?g=$group_id?success=true");
            exit();
        }
      }
}
?>