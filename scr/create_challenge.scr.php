<?php
if (!isset($_POST['create_challenge-submit'])) {
  exit();
}
elseif (isset($_POST['create_challenge-submit'])) {
  require 'dbh.scr.php';

  $challenge_title = mysqli_real_escape_string($conn, $_POST['challenge_title']);
  $challenge_description = mysqli_real_escape_string($conn, $_POST['challenge_description']);
  $challenge_prog_language = mysqli_real_escape_string($conn, $_POST['challenge_prog_language']);
  $challenge_start_date = mysqli_real_escape_string($conn, $_POST['challenge_start_date']);
  $challenge_deadline = mysqli_real_escape_string($conn, $_POST['challenge_deadline']);
  $challenge_password = mysqli_real_escape_string($conn, $_POST['challenge_password']);
  if (empty($challenge_title) || empty($challenge_description) || empty($challenge_prog_language) || empty($challenge_start_date) || empty($challenge_deadline)){
    header("Location: ../create_challenge?error=empty");
    exit();
  }
  else {
    if ($challenge_password === "") {
      $final_password = "";
    }else {
      $final_password = password_hash($challenge_password, PASSWORD_DEFAULT);
    }
    $sql = "INSERT INTO hjuma_challenges (challenge_title, challenge_description, challenge_prog_language, challenge_start_date, challenge_deadline, challenge_password) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"ssssss", $challenge_title, $challenge_description, $challenge_prog_language, $challenge_start_date, $challenge_deadline, $final_password);
      mysqli_stmt_execute($stmt);
      header("Location: ../main");
      exit();
    }
  }
}
else {
  header("Location: ../main");
  exit();
}
