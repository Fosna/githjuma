<?php
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}
set_error_handler("customError");
if (!isset($_POST['create_challenge-submit'])) {
  exit();
}
elseif (isset($_POST['create_challenge-submit'])) {
  require 'dbh.scr.php';
  
  $challenge_title = mysqli_real_escape_string($conn, $_POST['challenge_title']);
  $challenge_type = mysqli_real_escape_string($conn, $_POST['challenge_type']);
  $challenge_difficulty = mysqli_real_escape_string($conn, $_POST['challenge_difficulty']);
  $challenge_description = mysqli_real_escape_string($conn, $_POST['challenge_description']);
  $challenge_prog_language = mysqli_real_escape_string($conn, $_POST['challenge_prog_language']);
  $challenge_start_date = mysqli_real_escape_string($conn, $_POST['challenge_start_date']);
  $challenge_deadline = mysqli_real_escape_string($conn, $_POST['challenge_deadline']);
  $challenge_password = mysqli_real_escape_string($conn, $_POST['challenge_password']);
  
  ###################
  echo "<hr>";
  echo "Title: <b>", var_dump($challenge_title), "</b>";
  echo "<br>";
  echo "Type: <b>", var_dump($challenge_type), "</b>";
  echo "<br>";
  echo "Difficulty: <b>", var_dump($challenge_difficulty), "</b>";
  echo "<br>";
  echo "Description: <b>", var_dump($challenge_description), "</b>";
  echo "<br>";
  echo "Prog language: <b>", var_dump($challenge_prog_language), "</b>";
  echo "<br>";
  echo "Start date: <b>", var_dump($challenge_start_date), "</b>";
  echo "<br>";
  echo "Deadline: <b>", var_dump($challenge_deadline), "</b>";
  echo "<br>";
  echo "Password: <b>", var_dump($challenge_password), "</b>";
  echo "<hr>";
  ###################

  if (empty($challenge_title) || empty($challenge_description) || empty($challenge_prog_language) || empty($challenge_start_date) || empty($challenge_deadline)){
    header("Location: ../create_challenge?error=empty");
    exit();
  }
  else {
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
        die("SQL error 1");
      }else{
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
    if ($challenge_password === "") {
      $challenge_password = "";
    }else {
      $challenge_password = password_hash($challenge_password, PASSWORD_DEFAULT);
    }
    $sql2 = "INSERT INTO hjuma_challenges (challenge_title, challenge_type, challenge_explanation, challenge_difficulty, challenge_description, challenge_prog_language, challenge_start_date, challenge_deadline, challenge_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
      die("SQL error 2");
    }else {
      mysqli_stmt_bind_param($stmt2,"sssssssss", $challenge_title, $challenge_type, $challenge_explanation, $challenge_difficulty,  $challenge_description, $challenge_prog_language, $challenge_start_date, $challenge_deadline, $challenge_password);
      if (!mysqli_stmt_execute($stmt2)){
        die("SQL error 3");
      }else{
        header("Location: ../challenge");
        exit();
      }
    }
  }
}
else {
  header("Location: ../main");
  exit();
}
