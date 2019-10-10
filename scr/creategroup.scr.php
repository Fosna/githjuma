<?php
if (!isset($_POST['creategroup-submit'])) {
  exit();
}else{
    require 'dbh.scr.php';
    session_start();
    $group_id = uniqid();
    if (!isset($_SESSION['id'])) {
        $group_leader = uniqid();
      }else{
        $group_leader = $_SESSION['id'];
      }
      $name = mysqli_real_escape_string($conn, $_POST['group_name']);
      $sql = "INSERT INTO hjuma_groups (group_id, group_leader, group_name) VALUES (?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        die("sql error");
      }
      else {
        mysqli_stmt_bind_param($stmt, "sss", $group_id, $group_leader, $name);
        mysqli_stmt_execute($stmt);
        header("Location: ../groups");
        exit();
      }

}
?>