<?php
if (!isset($_POST['create_challenge-submit'])) {
  exit();
}
elseif (isset($_POST['create_challenge-submit'])) {
  require 'dbh.scr.php';
  session_start();
  $challenge_id = uniqid();
  if (!isset($_SESSION['id'])) {
  $challenge_owner = uniqid();
}else{
  $challenge_owner = $_SESSION['id'];
}
$sql = "SELECT * FROM hjuma_users WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL error";
        }else {
          mysqli_stmt_bind_param($stmt, "s", $challenge_owner);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
              while($row = mysqli_fetch_array($result)){
                if ($row['joinedchallenge_1'] == "") {
                  $join_to_challenge = "joinedchallenge_1";
                }
                elseif ($row['joinedchallenge_2'] == "") {
                  $join_to_challenge = "joinedchallenge_2";
                }
                elseif ($row['joinedchallenge_3'] == "") {
                  $join_to_challenge = "joinedchallenge_3";
                }
                elseif ($row['joinedchallenge_4'] == "") {
                  $join_to_challenge = "joinedchallenge_4";
                }
                elseif ($row['joinedchallenge_5'] == "") {
                  $join_to_challenge = "joinedchallenge_5";
                }
                else {
                  header("Location: ../main");
                  exit();
                }
              }
            }
  /*$dateRaw = mysqli_real_escape_string($conn, $_POST['datetimes']);
  $date = explode("-", $dateRaw);
  $start = $date[0];
  $dead = $date[1];*/

  $title = mysqli_real_escape_string($conn, $_POST['challenge_title']);
  $type = mysqli_real_escape_string($conn, $_POST['challenge_type']);
  $diff = mysqli_real_escape_string($conn, $_POST['challenge_difficulty']);
  $des = mysqli_real_escape_string($conn, $_POST['challenge_description']);
  $lang = mysqli_real_escape_string($conn, $_POST['challenge_prog_language']);
  $dura = mysqli_real_escape_string($conn, $_POST['challenge_duration']);
  $pwd = mysqli_real_escape_string($conn, $_POST['challenge_password']);

  $challenge_title = filter_var($title, FILTER_SANITIZE_STRING);
  $challenge_type = filter_var($type, FILTER_SANITIZE_STRING);
  $challenge_difficulty = filter_var($diff, FILTER_SANITIZE_STRING);
  $challenge_description = filter_var($des, FILTER_SANITIZE_STRING);
  $challenge_prog_language = filter_var($lang, FILTER_SANITIZE_STRING);
  $challenge_duration = filter_var($dura, FILTER_SANITIZE_STRING);
  $challenge_password = filter_var($pwd, FILTER_SANITIZE_STRING);
  $challenge_status = "PENDING";

  if (empty($challenge_title) || empty($challenge_description) /*|| empty($challenge_deadline)*/ ){
    header("Location: ../create_challenge?error=empty");
    exit();
  }
  else {
    if ($challenge_type == "def_challenge"){
      $def_challenge_id = rand(1, 2);
      if ($challenge_difficulty == "Easy"){
        $sql = "SELECT def_challenge_explanation FROM hjuma_def_challenges WHERE def_challenge_id = ? AND def_challenge_difficulty= 'easy';";
      }elseif ($challenge_difficulty == "Medium"){
        $sql = "SELECT def_challenge_explanation FROM hjuma_def_challenges WHERE def_challenge_id = ? AND def_challenge_difficulty= 'medium';";
      }
      elseif ($challenge_difficulty == "Hard"){
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
    $sql2 = "INSERT INTO hjuma_challenges (challenge_id, challenge_owner, challenge_title, challenge_type, challenge_explanation, challenge_difficulty, challenge_description, challenge_prog_language, challenge_duration, challenge_password, challenge_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
      die("SQL error 2");
    }else {
      mysqli_stmt_bind_param($stmt2,"sssssssssss", $challenge_id, $challenge_owner, $challenge_title, $challenge_type, $challenge_explanation, $challenge_difficulty,  $challenge_description, $challenge_prog_language, $challenge_duration, $challenge_password, $challenge_status);
      if (!mysqli_stmt_execute($stmt2)){
        die("SQL error 3");
      }else{

      $sql = "INSERT INTO hjuma_joined_challenges (joined_user, joined_challenge) VALUES (?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        die("sql error");
      }
      else {
        mysqli_stmt_bind_param($stmt, "ss", $challenge_owner, $challenge_id);
        mysqli_stmt_execute($stmt);
        header("Location: ../challenge_info?c=$challenge_id");
        exit();
      }
      $_SESSION['challenge_id'] = $challenge_id;
      header("Location: ../challenge_info?c=$challenge_id");
      exit();
      }
    }
  }
}
else {
  header("Location: ../main");
  exit();
}
