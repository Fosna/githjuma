<?php
if (!isset($_POST['joinchallenge-submit'])) {
  exit();
}
elseif (isset($_POST['joinchallenge-submit'])) {
  require 'dbh.scr.php';
  session_start();
  $user_id = $_SESSION['id'];
  $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
  $challenge_status = mysqli_real_escape_string($conn, $_POST['challenge_status']);
  $challenge_password_entered = mysqli_real_escape_string($conn, $_POST['challenge_password_entered']);

  if (!$challenge_password_entered == "") {
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $challenge_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
          while($row = mysqli_fetch_array($result)){
              $challenge_password = $row['challenge_password'];
              $pwdCheck = password_verify($challenge_password_entered, $challenge_password);
              if ($pwdCheck == false) {
                header("Location: ../challenge_info?c=$challenge_id&error=pass");
                exit();
              }else{
                $sql = "INSERT INTO hjuma_joined_challenges (joined_user, joined_challenge) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                  die("sql error");
                }
                else {
                  mysqli_stmt_bind_param($stmt, "ss", $user_id, $challenge_id);
                  mysqli_stmt_execute($stmt);
                  if ($challenge_status == "PENDING"){
                    header("Location: ../challenge_info?c=$challenge_id");
                  }elseif ($challenge_status == "ACTIVE") {
                    header("Location: ../challenge?c=$challenge_id");
                  }
                  exit();
                }
              }
          }
    } 
  }else{
    $sql = "INSERT INTO hjuma_joined_challenges (joined_user, joined_challenge) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      die("sql error");
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $user_id, $challenge_id);
      mysqli_stmt_execute($stmt);
      if ($challenge_status == "PENDING"){
        header("Location: ../challenge_info?c=$challenge_id");
      }elseif ($challenge_status == "ACTIVE") {
        header("Location: ../challenge?c=$challenge_id");
      }
      exit();
    }
  }
}