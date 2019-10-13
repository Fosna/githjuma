<?php
if (!isset($_POST['joinrequest_submit'])) {
  exit();
}else{
    require 'dbh.scr.php';
    session_start();
    $user_id = $_SESSION['id'];
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
    $sql = "INSERT INTO hjuma_requested_groups (user_id, group_id) VALUES (?, ?);";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        die("sql error");
      }
      else {
        mysqli_stmt_bind_param($stmt, "ss", $user_id, $group_id);
        mysqli_stmt_execute($stmt);
        header("Location: ../group_info?g=$group_id?success=true");
        exit();
      }
}
?>