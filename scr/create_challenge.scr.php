<?php
if (!isset($_POST['create_challenge-submit'])) {
  exit();
}
elseif (isset($_POST['create_challenge-submit'])) {
  require 'dbh.scr.php';

  $challenge_title = mysqli_real_escape_string($conn, $_POST['challenge_title']);
  $challenge_type = mysqli_real_escape_string($conn, $_POST['challenge_type']);
  $challenge_difficulty = mysqli_real_escape_string($conn, $_POST['challenge_difficulty']);
  if ($challenge_type == "def_challenge"){
    $def_challenge_id = rand(1, 2);
    if ($challenge_difficulty == "easy"){
    $sql = "SELECT def_challenge_explanation FROM hjuma_def_challenges WHERE def_challenge_id = ? AND def_challenge_difficulty= 'easy';";
    }elseif ($challenge_difficulty == "medium"){
      $sql = "SELECT def_challenge_explanation FROM hjuma_def_challenges WHERE def_challenge_id = ? AND def_challenge_difficulty= 'medium';";
    }
    elseif ($challenge_difficulty == "hard"){
      $sql = "SELECT def_challenge_explanation FROM hjuma_def_challenges WHERE def_challenge_id = ? AND def_challenge_difficulty= 'hard';";
    }
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $def_challenge_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
          while($row = mysqli_fetch_array($result)){
            $challenge_explanation = $row['def_challenge_explanation'];
          }
        }
  }elseif ($challenge_type == "user_challenge"){
    $challenge_explanation = mysqli_real_escape_string($conn, $_POST['challenge_user_explanation']);
  }
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
    $sql = "INSERT INTO hjuma_challenges (challenge_title, challenge_explanation, challenge_difficulty, challenge_description, challenge_prog_language, challenge_start_date, challenge_deadline, challenge_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"ssssssss", $challenge_title, $challenge_explanation, $challenge_difficulty,  $challenge_description, $challenge_prog_language, $challenge_start_date, $challenge_deadline, $final_password);
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
