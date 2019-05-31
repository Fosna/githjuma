<?php
if (!isset($_POST['create_challenge-submit'])) {
  exit();
}
elseif (isset($_POST['create_challenge-submit'])) {
  require 'dbh.scr.php';

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $prog_language = mysqli_real_escape_string($conn, $_POST['prog_language']);
  $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
  $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);

  if (empty($title) || empty($description) || empty($prog_language) || empty($start_date) || empty($deadline)){
    header("Location: ../create_challenge?error=empty");
    exit();
  }
  else {
    $sql = "INSERT INTO hjuma_challenges (title, description, prog_language, start_date, deadline) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"sssss", $title, $description, $prog_language, $start_date, $deadline);
      mysqli_stmt_execute($stmt);
    }
    header("Location: ../main");

    }
  }
else {
  header("Location: ../main");
  exit();
}
