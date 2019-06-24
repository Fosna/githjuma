<?php
if (!isset($_POST['joinchallenge-submit'])) {
  exit();
}
elseif (isset($_POST['joinchallenge-submit'])) {
  require 'dbh.scr.php';
  session_start();
  $user_id = $_SESSION['id'];
  $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
  $sql = "SELECT * FROM hjuma_users WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL error";
        }else {
          mysqli_stmt_bind_param($stmt, "s", $user_id);
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
                $sql2 = "UPDATE hjuma_users SET $join_to_challenge=? WHERE id=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql2)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"ss",$challenge_id, $user_id);
        mysqli_stmt_execute($stmt);
      }
      header("Location: ../challenge_info?c=$challenge_id");
              }
            }
        }