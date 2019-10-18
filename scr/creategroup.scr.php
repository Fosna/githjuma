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
      $description = mysqli_real_escape_string($conn, $_POST['group_description']);
      $prog_language = mysqli_real_escape_string($conn, $_POST['main_prog_language']);
      $sql = "INSERT INTO hjuma_groups (group_id, group_leader, group_name, group_description, main_prog_language) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        die("sql error");
      }
      else {
        mysqli_stmt_bind_param($stmt, "sssss", $group_id, $group_leader, $name, $description, $prog_language);
        mysqli_stmt_execute($stmt);
        $sql2 = "INSERT INTO hjuma_joined_groups (joined_user, joined_group) VALUES (?, ?)";
      $stmt2 = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt2, $sql2)){
        die("sql error2");
      }
      else {
        mysqli_stmt_bind_param($stmt2, "ss", $group_leader, $group_id );
        mysqli_stmt_execute($stmt2);
        header("Location: ../groups");
        exit();
      }      
      }

}
?>